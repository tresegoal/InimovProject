<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
       $this->model = $category;
    }

    public function getAllActiveCategories() {
        return $this->getAll(['produits'])->where('active',1);
    }

    public function getCategoriesWithoutImage() {
        return $this->model->doesntHave('image')->get();
    }

}