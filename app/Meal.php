<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'category_id', 'translations'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
