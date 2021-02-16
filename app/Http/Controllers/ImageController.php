<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ProduitRepository;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $imageRepository;
    private $categoryRepository;
    private $produitRepository;

    public function __construct(ImageRepository $imageRepository,CategoryRepository $categoryRepository,
                                ProduitRepository $produitRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->produitRepository = $produitRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = $this->imageRepository->getAll([]);
        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $cats= $this->categoryRepository->getCategoriesWithoutImage()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $produits = $this->produitRepository->getAll([])->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');*/

        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = new Image;

        if($request->file('url')) {
            $fileName = time().'_'.$request->file('url')->getClientOriginalName();
            $filePath = $request->file('url')->storeAs('images', $fileName, 'public');
            $image->alt = time().'_'.$request->file('url')->getClientOriginalName();
            $image->url =  '/storage/'.$filePath;
            $image->save();

            return redirect()->route('admin.images.index')
                ->with('success','File has been uploaded.');
        }
        else {

        return redirect()->route('admin.images.index')
            ->with('error','Form doesn\'t contain file' );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {

        /*$cats= $this->categoryRepository->getCategoriesWithoutImage()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $produits = $this->produitRepository->getAll([])->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');*/

        return view('images.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        if($request->file('url')) {
            $fileName = time().'_'.$request->file('url')->getClientOriginalName();
            $filePath = $request->file('url')->storeAs('images', $fileName, 'public');
            $image->alt = $fileName;
            $image->url =  $filePath;
            $image->save();

        return redirect()->route('admin.images.index')
            ->with('success','File has been uploaded.');
        }
        else {

            return redirect()->route('admin.images.index')
                ->with('error','Form doesn\'t contain file' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $this->imageRepository->destroys($image->getAttribute("id"));
        return redirect()->route('admin.images.index');
    }


    public function massDestroy(Request $request)
    {
        if (!Gate::allows('image_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Image::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Image from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('image_delete')) {
            return abort(401);
        }
        $image = Image::onlyTrashed()->findOrFail($id);
        $image->restore();

        return redirect()->route('admin.images.index');
    }

    /**
     * Permanently delete Image from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('image_delete')) {
            return abort(401);
        }
        $image = Image::onlyTrashed()->findOrFail($id);
        $image->forceDelete();

        return redirect()->route('admin.images.index');
    }

}
