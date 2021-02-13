<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Repositories\CategoryRepository;
use App\Repositories\ProduitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProduitController extends Controller
{

    private $produitRepository;
    private $categoryRepository;

    public function __construct(ProduitRepository $produitRepository,
                                CategoryRepository $categoryRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function index()
    {
        $produits = $this->produitRepository->getAll(['category']);
        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll([])->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('produits.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->produitRepository->store($request->all());
        return redirect()->route('admin.produits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        $categories = $this->categoryRepository->getAll([])->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('produits.edit', compact('produit','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        $this->produitRepository->update($produit->getAttribute("id"),$request->all());
        return redirect()->route('admin.produits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $this->produitRepository->destroy($produit->getAttribute("id"));
        return redirect()->route('admin.produits.index');
    }

    public function activate($id)
    {
        $produit = $this->produitRepository->active($id);

        // flashing("Le produit '" . $produit->name . "' a été activée");

        return back();
    }

    public function deactivate($id)
    {

        $produit = $this->produitRepository->deactive($id);

        //flashing("Le produit '" . $produit->name . "' a été desactivée");
        return back();
    }

    public function massDestroy(Request $request)
    {
        if (!Gate::allows('produit_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Produit::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Produit from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('produit_delete')) {
            return abort(401);
        }
        $produit = Produit::onlyTrashed()->findOrFail($id);
        $produit->restore();

        return redirect()->route('admin.produits.index');
    }

    /**
     * Permanently delete Produit from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('produit_delete')) {
            return abort(401);
        }
        $produit = Produit::onlyTrashed()->findOrFail($id);
        $produit->forceDelete();

        return redirect()->route('admin.produits.index');
    }

}
