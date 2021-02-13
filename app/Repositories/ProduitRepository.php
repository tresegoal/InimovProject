<?php


namespace App\Repositories;

use App\Models\Produit;

class ProduitRepository extends BaseRepository
{
    public function __construct(Produit $produit)
    {
        $this->model = $produit;
    }

    public function getAllProductByCategory($id) {

        return $this->getAll(['images'])->where('active',1)->where('category_id',$id);
    }

    public function findProductByMC($chaine)
    {

        return $this->model->with(['images', 'category'])
            ->where('name', 'like', "%$chaine%")->get();
    }

}