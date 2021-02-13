<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'url','alt','category_id','produit_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function produit() {
        return $this->belongsTo(Produit::class)->withDefault();
    }
}
