<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\ConsoleColor;
use Illuminate\Console\Command;

class ParseFormulations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:parse_formulations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse formulation column in products table and apply changes to attributes.';

    protected $console = null;

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
    public function handle(ConsoleColor $console)
    {
        ini_set('memory_limit', '512M');
        $this->console = $console;
        $this->console->info('Start parsing formulations...');

        $index = 0;
        $total = Product::count();
        Product::select(['id', 'formulations'])
            ->cursor()
            ->each(function ($product) use (&$index, $total) {
                $index++;
                $attributes
                    = parse_formulation($product->formulations);
                foreach ($attributes as $attribute => $value) {
                    $product->{$attribute} = $value;
                }
                $product->save();
                //dump($product->formulations,$attributes);
                if ($index % 1000 === 0) {
                    $this->console->info('#'.$index.'/'.$total
                        .' product parsed.');
                }
            });

        return 0;
    }
}
