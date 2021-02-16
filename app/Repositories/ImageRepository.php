<?php


namespace App\Repositories;

use App\Models\Image;

class ImageRepository extends BaseRepository
{
    public function __construct(Image $image)
    {
        $this->model = $image;
    }


    public function getImageWithoutCategoriesAndProduct() {
        return $this->model->doesntHave('category')->doesntHave('produit')->get();
    }

}