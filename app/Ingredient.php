<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot'];

    public function meals(){
        return $this->belongsToMany(Meal::class);
    }
}
