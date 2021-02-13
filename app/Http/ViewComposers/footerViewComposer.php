<?php


namespace App\Http\ViewComposers;


use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class footerViewComposer
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function compose(View $view) {
        $categories = $this->categoryRepository->getAllActiveCategories();

        $view->with('categories',$categories);
    }
}