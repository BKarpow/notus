<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Notebook;
use \Transliteration;
/**
 * Class NotebookRepository.
 */
class NotebookRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->model();
    }

    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Notebook::class;
    }

    public function getById($id, array $columns = ['*'])
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function getNotebooksForUser():mixed
    {
        $colums = '*';
        $result = Auth::user()
            ->notebooks($colums)
            ->select($colums)
            ->orderBy('created_at', 'desc')
            ->get();
        return $result;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createNewItem(array $data)
    {
        $nb = new $this->model;
        $nb->user_id = Auth::id();
        $nb->title = $data['title'];
        $nb->alias = Transliteration::ukToEng($data['title']);
        $nb->save();
        return $nb;
    }

    public function updateItem(array $data)
    {
        $user = Auth::user();
        $notebook = $this->getById((int)$data['id']);
        if ($user->can('update', $notebook)) {
            $notebook->title = $data['title'];
            $notebook->alias = Transliteration::ukToEng( $data['title']);
            $notebook->save();
            return $notebook;
        }
        abort(418);
    }

    /**
     * Delete item and return id deleted
     * @param $id
     * @return int
     */
    public function deleteByIdAndReturn($id)
    {
        $user = Auth::user();
        $n = $this->getById($id);
        if ($user->can('delete', $n)) {
            $id = (int)$n->id;
            $n->delete();
            return $id;
        } else {
            abort(418);
        }
    }
}
