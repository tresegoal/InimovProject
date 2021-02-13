<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','description','active'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function image() {
        return $this->hasOne(Image::class)->withDefault();
    }

    public function produits() {
        return $this->hasMany(Produit::class);
    }


}
