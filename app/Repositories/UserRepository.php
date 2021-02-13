<?php


namespace App\Repositories;

use App\Models\Produit;

class ProduitRepository extends BaseRepository
{
    public function __construct(Produit $produit)
    {
        $this->model = $produit;
    }


}