<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{

    protected $model ;

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
        return User::class;
    }

    public function allUsers()
    {
        $colums = ['id', 'name', 'email', 'avatar'];
        $res = $this->model::select($colums)
            ->orderBy('id', 'desc')
            ->toBase()
            ->get();
        return $res;
    }
}
