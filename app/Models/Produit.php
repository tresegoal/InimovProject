<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','description','priceHT','quantity',
        'tva','active','category_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function first_image() {
        return $this->hasMany(Image::class)->first();
    }

}
