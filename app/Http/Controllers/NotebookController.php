<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use App\Lib\TranslitStr;
use Illuminate\Http\Request;
use App\Http\Resources\NotebookResource;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return NotebookResource::collection(
            auth()->user()->notebooks()->orderBy('created_at', 'desc')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100|min:2',
        ]);
        $nb = new Notebook();
        $nb->title = $request->title;
        $nb->alias = TranslitStr::convert($request->title);
        $nb->user_id = auth()->id();
        $nb->save();
        return new NotebookResource($nb);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function show(Notebook $notebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Notebook $notebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'title' => 'required|string|max:100',
        ]);
        $n = Notebook::findOrFail($request->id);
        if ((int)$n->user_id !== auth()->id()){
            abort(418);
        } else {
            $n->title = $request->title;
            $n->alias = TranslitStr::convert( $request->title);
            $n->save();
            return new NotebookResource($n);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);
        $n = Notebook::findOrFail($request->id);
        if ((int)$n->user_id !== auth()->id()){
            abort(418);
        } else {
            $nid = (int)$n->id;
            $n->delete();
            return response()->json(['deletedId'=>$nid]);
        }
    }
}
