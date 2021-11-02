<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DateFormat;

class Notebook extends Model
{
    use HasFactory, DateFormat;


    /**
     * Relation user
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Relation for category
     * 
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'notebook_id', 'id');
    }
}

    

