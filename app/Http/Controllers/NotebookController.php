<?php

namespace App\Http\Controllers;

use Transliteration;
use App\Http\Resources\NotebookResource;
use App\Repositories\NotebookRepository;
use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use App\Http\Requests\DeleteNotebookRequest;

class NotebookController extends Controller
{

    /**
     * @var NotebookRepository
     */
    private NotebookRepository $repository;
    public function __construct()
    {
        $this->repository = new NotebookRepository();
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return NotebookResource::collection(
            $this->repository->getNotebooksForUser()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreNotebookRequest $request)
    {
        return new NotebookResource(
            $this->repository->createNewItem($request->toArray())
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     */
    public function update(UpdateNotebookRequest $request)
    {
        return new NotebookResource(
            $this->repository->updateItem($request->toArray())
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function destroy(DeleteNotebookRequest $request)
    {
        return response()->json([
            'deletedId' => $this->repository->deleteByIdAndReturn($request->id)
        ]);
    }
}
