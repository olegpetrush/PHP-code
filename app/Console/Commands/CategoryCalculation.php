<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CategoryCalculation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calc:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determine category & subcategory';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //ini_set('memory_limit','512M');
        Product::query()->update(['category' => null, 'subcategory' => null]);
        $this->warn('Category & Subcategory has been nulled.');
        // exclude brand=Vitamin World
        //->where('brand','not like','Vitamin World');
        $total = Product::count();
        $categories = Category::with('subcategories')->get();
        $this->info('Found categories: '.$categories->count());
        $index = 0;
        Product::each(function ($product) use (&$index, $total, $categories) {
            /** @var Product $product */
            $index++;
            $this->info('#'.$index.'/'.$total.' process. Name: '
                .$product->product_name.'; Langual Product Type: '
                .$product->langual_product_type);
            /**
             * Instead, we should exclude the brand value from the product_name
             * value when trying to calculate the category and subcategory value.
             * For instance, if the product name is "Vitamin World Niacin 250 mg",
             * and the brand name is "Vitamin World",
             * then the actual product name to be used for calculation should be
             * "Niacin 250 mg". If you can change the code to show me how this
             * is done, I may be able to take it forward.
             */
			
			//need to remove '#' from the product name and brand name
			if (Str::contains(Str::lower($product->product_name), '#')) 
			 	$product->product_name = str_replace("#", "", $product->product_name);
			if (Str::contains(Str::lower($product->brand), '#')) 
			 	$product->brand = str_replace("#", "", $product->brand);
			 
            $formatted_product_name = $product->product_name;
            if (Str::contains(Str::lower($product->product_name),
                    Str::lower($product->brand))
            ) {
                $formatted_product_name
                    = trim(preg_replace('#'.$product->brand.'#siUu', '',
                    $product->product_name));
                $this->warn('formatting: '
                    .$formatted_product_name);
                //dd($formatted_product_name);
            }

			//exclude some invalid values
            if (Str::contains(Str::lower($product->langual_product_type),
                    Str::lower('Non-Nutrient/Non-Botanical'))
            ) {			
				$product->langual_product_type = '';
			}

            $categories->each(function ($category) use (
                $product,
                $formatted_product_name
            ) {
                /** @var Category $category */
                $category_validated = false;
                if ( ! empty($category->keywords)) {
                    $keywords = array_map('strtolower',
                        array_values(array_unique($category->keywords)));
                    if (Str::contains(Str::lower($product->langual_product_type),
                            $keywords)
                        || Str::contains(Str::lower($formatted_product_name),
                            $keywords)
                    ) {
                        $product->category = $category->name;
                        $category_validated = true;
                    }
                }
                if ( ! empty($category->negative_keywords)) {
                    $negative_keywords = array_map('strtolower',
                        array_values(array_unique($category->negative_keywords)));
                    if (Str::contains(Str::lower($product->langual_product_type),
                            $negative_keywords)
                        || Str::contains(Str::lower($formatted_product_name),
                            $negative_keywords)
                    ) {
                        // block negative keywords
                        $product->category = null;
                        $category_validated = false;
                    }
                }
				
				//fix validation error
				if (!$category_validated && Str::contains(Str::lower($category->name), 'probio')) {
					if (Str::contains(Str::lower($product->product_name),
                            'probio')
					) {
                        $product->category = $category->name;
                        $category_validated = true;
					}
				}
				
				/*
                if (empty($category->negative_keywords)
                    && empty($category->keywords)
                ) {
                    // loop through subcategories if category keywords/negative keywords is empty
				*/
				if (true) {
                    $subcategory_validated = false;
                    $category->subcategories->each(
                        function ($subcategory) use (
                            $product,
                            &$subcategory_validated,
                            $formatted_product_name
                        ) {
                            /** @var Subcategory $subcategory */
                            // validate subcategory
                            if ( ! empty($subcategory->keywords)) {
                                $keywords = array_map('strtolower',
                                    array_values(array_unique($subcategory->keywords)));
                                if (Str::contains(Str::lower($product->langual_product_type),
                                        $keywords)
                                    || Str::contains(Str::lower($formatted_product_name),
                                        $keywords)
                                ) {
                                    $product->subcategory = $subcategory->name;
                                    $subcategory_validated = true;
                                }
                            }
                            if ( ! empty($subcategory->negative_keywords)) {
                                $negative_keywords = array_map('strtolower',
                                    array_values(array_unique($subcategory->negative_keywords)));
                                if (Str::contains(Str::lower($product->langual_product_type),
                                        $negative_keywords)
                                    || Str::contains(Str::lower($formatted_product_name),
                                        $negative_keywords)
                                ) {
                                    // block negative keywords
                                    $product->subcategory = null;
                                    $subcategory_validated = false;
                                }
                            }
                            if ($subcategory_validated) {
                                $this->warn('Subcategory validated within loop: '
                                    .$subcategory->name);
                                $product->category
                                    = $subcategory->category->name;
                                $product->subcategory = $subcategory->name;
                                $this->warn('Break subcategory loop.');
                                // break the loop if category/subcategory is set.
                                return false;
                            }
                            return true;
                        });

                    if ($subcategory_validated) {							
                        $this->warn('Subcategory validated: '.$product->category
                            .'/'.$product->subcategory);
                        $this->warn('Break category loop.');
                        // break the loop if category/subcategory is set.
                        return false;
                    }
                } else {
                    if ($category_validated) {
                        $this->warn('Category validated: '.$product->category
                            .'/'.$product->subcategory);
                        // break the loop if category/subcategory is set.
                        return false;
                    }
                }
            });
            if ($product->isDirty()) {
                //dump($product->category,$product->subcategory);
                $product->save();
            }
        });
        return 0;
    }
}
