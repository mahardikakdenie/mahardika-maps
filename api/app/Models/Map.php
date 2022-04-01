<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Map extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeById($query, $id)
    {
        if ($id != null || $id != "") {
            return $query->where('id', $id);
        }

        return $query;
    }
}
