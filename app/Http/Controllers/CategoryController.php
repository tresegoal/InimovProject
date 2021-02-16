<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $imageRepository;

    public function __construct(CategoryRepository $categoryRepository,ImageRepository $imageRepository)
    {
       $this->categoryRepository = $categoryRepository;
       $this->imageRepository = $imageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->query->has('show_deleted')) {
            if($request->query->get('show_deleted') == 1) {
                $categories = $this->categoryRepository->getDeleteCategories(['image']);
                //dd($categories);
                return view('categories.index', compact('categories'));
            }
            else {
                $categories = $this->categoryRepository->getAll(['image']);

                return view('categories.index', compact('categories'));
            }

        } else {
            $categories = $this->categoryRepository->getAll(['image']);

            return view('categories.index', compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $images = $this->imageRepository->getImageWithoutCategoriesAndProduct();
        return view('categories.create',compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageId = $request->image_id;
        $categorie = $this->categoryRepository->stores($request->except('image_id'));
        $image = $this->imageRepository->findOne($imageId);
        $image->category_id = $categorie->id;
        $image->save();
        return redirect()->route('admin.categories.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = $this->categoryRepository->getCategoriesWithRelations($category->getAttribute('id'),['image']);
        //dd($category);
        $images = $this->imageRepository->getImageWithoutCategoriesAndProduct();
        return view('categories.edit', compact('category','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $lastImgId = $category->image->id;
        $lastImage = $this->imageRepository->findOne($lastImgId);
        //dd($lastImage);
        $lastImage->category_id = null;
        $lastImage->save();

        $this->categoryRepository->updates($category->id,$request->except('image_id'));

        $imageId = $request->image_id;
        $image = $this->imageRepository->findOne($imageId);
        $image->category_id = $category->id;
        $image->save();

        return redirect()->route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->destroys($category->getAttribute("id"));
        return redirect()->route('admin.categories.index');
    }


    public function activate($id)
    {
        $category = $this->categoryRepository->active($id);

       // flashing("La catégorie '" . $category->name . "' a été activée");

        return back();
    }

    public function deactivate($id)
    {

        $category = $this->categoryRepository->deactive($id);

        //flashing("La catégorie '" . $category->name . "' a été desactivée");
        return back();
    }

    public function massDestroy(Request $request)
    {
        /*if (!Gate::allows('booking_delete')) {
            return abort(401);
        }*/
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        /*if (!Gate::allows('booking_delete')) {
            return abort(401);
        }*/
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Permanently delete Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        /*if (!Gate::allows('booking_delete')) {
            return abort(401);
        }*/
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.index');
    }

}
