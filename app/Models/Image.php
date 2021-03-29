<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App\Models
 * @property int $id
 * @property int $product_id
 * @property string $image
 */
class Image extends Model
{
    protected $guarded=['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute($value){
        if(!empty($value)){
            return 'https://dsld.od.nih.gov/dsld/docs/thumbnails/'.$value;
        }
        return $value;
    }
}
