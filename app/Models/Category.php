<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DateFormat;

class Category extends Model
{
    use HasFactory, DateFormat;

    /**
     * Relation Notebook
     * 
     */
    public function notebook()
    {
        return $this->belongsTo(Notebook::class, 'notebook_id', 'id');
    }
}
