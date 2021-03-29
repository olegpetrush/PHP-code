<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::select('id')->cursor()->each(function($product){
            $image=\App\Models\Image::firstOrNew([
                'image'=>$product->id.'.jpg'
            ]);
            $image->product_id=$product->id;
            $image->save();
        });
    }
}
