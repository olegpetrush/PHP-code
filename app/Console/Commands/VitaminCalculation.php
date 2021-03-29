<?php

namespace App\Console\Commands;

use App\Models\Ingredient;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class VitaminCalculation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calc:vitamins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calc vitamins weight.';

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
        /*
         * Vitamin A: 1 IU = 0.3 mcg RAE
            Vitamin D: 1 IU = 0.025 mcg
            Vitamin E: 1 IU = 0.67 mg alpha-tocopherol (natural)
            Vitamin E: 1 IU = 0.9 / 2 mg alpha-tocopherol (synthetic)
            For Vitamin E, it is OK to use the first conversion formula for all cases at this time.
         */
        $this->info('Convert Vitamins weight..');
        $index = 0;
        $query = Ingredient::query()
            ->where('amount_serving_unit', '=', 'IU')
            ->where(function ($q) {
                $q->where('dietary_ingredient_synonym_source', 'LIKE',
                    '%Vitamin A%')
                    ->orWhere('dietary_ingredient_synonym_source', 'LIKE',
                        '%Vitamin D%')
                    ->orWhere('dietary_ingredient_synonym_source', 'LIKE',
                        '%Vitamin E%');
            });
        dump($query->toSql());
        $total = $query->count();
        $query
            ->cursor()
            ->each(function ($ingredient) use (&$index, $total) {
                /** @var Ingredient $ingredient */
                $index++;
                $this->info($index.'/'.$total.' Process: '
                    .$ingredient->dietary_ingredient_synonym_source);
                if (Str::contains(Str::lower($ingredient->dietary_ingredient_synonym_source),
                    ['vitamin a'])
                ) {
                    if ( ! empty($ingredient->amount_per_serving)) {
                        $ingredient->new_amount_per_serving
                            = (float) $ingredient->amount_per_serving * 0.3;
                    } else {
                        $ingredient->new_amount_per_serving = 0;
                    }
                    $ingredient->new_amount_serving_unit = 'mcg';
                    $ingredient->save();
                } elseif (Str::contains(Str::lower($ingredient->dietary_ingredient_synonym_source),
                    ['vitamin d'])
                ) {
                    if ( ! empty($ingredient->amount_per_serving)) {
                        $ingredient->new_amount_per_serving
                            = (float) $ingredient->amount_per_serving * 0.025;
                    } else {
                        $ingredient->new_amount_per_serving = 0;
                    }
                    $ingredient->new_amount_serving_unit = 'mcg';
                    $ingredient->save();
                } elseif (Str::contains(Str::lower($ingredient->dietary_ingredient_synonym_source),
                    ['vitamin e'])
                ) {
                    if ( ! empty($ingredient->amount_per_serving)) {
                        $ingredient->new_amount_per_serving
                            = (float) $ingredient->amount_per_serving * 0.67;
                    } else {
                        $ingredient->new_amount_per_serving = 0;
                    }
                    $ingredient->new_amount_serving_unit = 'mg';
                    $ingredient->save();
                }
            });
        return 0;
    }
}
