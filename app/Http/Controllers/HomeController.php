<?php

namespace App\Http\Controllers;


use App\Repositories\CategoryRepository;
use App\Repositories\ProduitRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $categoryRepository;
    private $produitRepository;


    public function __construct(CategoryRepository $categoryRepository,
                                ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {

        $cats = $this->categoryRepository->getAllActiveCategories();

        return view('welcome',compact('cats'));
    }

    public function showProduct($id) {
        $produits = $this->produitRepository->getAllProductByCategory($id);
        $categorie = $this->categoryRepository->findOne($id);

        return view('products',compact('produits','categorie'));
    }

    public function lists() {

        $produits = $this->produitRepository->getAll(['category']);
        $categories = $this->categoryRepository->getAll([]);

        return view('productList',compact('produits','categories'));
    }
    public function news() {

    }
    public function contact() {

    }
}
