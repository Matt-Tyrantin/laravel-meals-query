<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot', 'translations'];

    public function meals(){
        return $this->belongsToMany(Meal::class);
    }
}
