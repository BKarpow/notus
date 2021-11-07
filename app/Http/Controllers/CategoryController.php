<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Notebook;
use \Transliteration;

class CategoryController extends Controller
{

    /**
     * Api Meta info
     *
     * @param App\Models\Notebook $nb
     * @return array
     */
    private function metaInfo(Notebook $nb):array
    {
        return ['meta' => [
                    'notebook' => [
                        'title' => $nb->title,
                        'id' => (int)$nb->id,
                    ],
                    'user' => [
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'id' => auth()->id(),
                    ]
                ]
             ];
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $request->validate([
            'notebookId' => 'required|numeric'
        ]);
        $nb = auth()->user()->notebooks()->findOrFail($request->notebookId);
        return (new CategoryCollection(
            $nb->categories()->orderBy('created_at', 'desc')->get()
        ))->additional($this->metaInfo($nb));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'notebookId' => 'required|numeric',
            'title' => 'required|string|max:100',
        ]);
        // Is User have this notebook
        auth()->user()->notebooks()->findOrFail($request->notebookId);
        $c = new Category();
        $c->title = $request->title;
        $c->alias = Transliteration::ukToEng($request->title);
        $c->notebook_id = (int)$request->notebookId;
        $c->save();
        return new CategoryResource($c);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     */
    public function update(Request $request)
    {
        $request->validate([
            'notebookId' => 'required|numeric',
            'id' => 'required|numeric',
            'title' => 'required|string|max:100',
        ]);
        $c = Category::findOrFail($request->id);
        // Is User have this notebook
        auth()->user()->notebooks()->findOrFail($request->notebookId);
        if ($c->notebook_id != $request->notebookId){
            abort(403);
        }
        $c->title = $request->title;
        $c->alias = Transliteration::ukToEng($request->title);
        $c->save();
        return new CategoryResource($c);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'notebookId' => 'required|numeric',
            'id' => 'required|numeric',
        ]);
        // Is User have this notebook
        auth()->user()->notebooks()->findOrFail($request->notebookId);
        $c = Category::findOrFail($request->id);
        // Is User have this notebook
        auth()->user()->notebooks()->findOrFail($request->notebookId);
        if ($c->notebook_id != $request->notebookId){
            abort(403);
        }
        $id = (int) $c->id;
        $c->delete();
        return response()->json(['deletedId' => $id], Response::HTTP_OK);
    }
}
