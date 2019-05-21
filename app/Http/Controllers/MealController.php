<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Http\Request;
use App\Meal;

class MealController extends Controller
{
    protected $meals;

    public function __construct(Request $request, Meal $model){
        if( $request->exists('diff_time'))
            $this->meals = $model::withTrashed()->get();
        else
            $this->meals = $model::all();
    }

    public function index(Request $request){
        app()->setLocale($request->get('lang'));
        $meals = $this->meals;

        if($request->exists('category'))
            $meals = $this->filterByCategory($meals, $request);

        if($request->exists('tags')) {
            $tags = explode(',', $request->get('tags'));
            $meals = $this->filterByTags($meals, $tags);
        }

        if($request->exists('diff_time')) {
            $timestamp = $request->get('diff_time');
            $meals = $this->filterByTimestamp($meals, $timestamp);
            $meals = $this->declareStatus($meals, $timestamp);
        }

        if($request->exists('with')){
            $extra = explode(',', $request->get('with'));
            $this->loadRelations($meals, $extra);
        }

        $data = $this->processData($meals, $request);

        return '<pre>'.json_encode( $data, JSON_PRETTY_PRINT).'</pre>';
    }



    public function loadRelations(Collection $collection, Array $relations){
        foreach($relations as $relation){
            try {
                $collection->load($relation);
            }catch(RelationNotFoundException $e){}
        }
    }

    public function processData(Collection $collection, Request $request){
        $meta = Array();
        $links = Array();

        $meta['currentPage'] = $request->exists('page')? (int)$request->get('page') : 1;
        $meta['totalItems'] = (int)$collection->count();
        $meta['itemsPerPage'] = $request->exists('per_page')? (int)$request->get('per_page'): 10;
        $meta['totalPages'] = max( ceil($meta['totalItems']/$meta['itemsPerPage']), 1);

        $links['self'] = urldecode( $request->fullUrl());
        $links['prev'] = ($meta['currentPage'] > 1) ?
            preg_replace('(&page=\d)', '&page='.($meta['currentPage'] - 1), $links['self']): null;
        $links['next'] = ($meta['currentPage'] < $meta['totalPages']) ?
            preg_replace('(&page=\d)', '&page='.($meta['currentPage'] + 1), $links['self']): null;

        $collection = $collection->forPage($meta['currentPage'], $meta['itemsPerPage']);

        $data = Array(
            'meta' => $meta,
            'data' => $collection,
            'links' => $links
        );

        return $data;
    }

    public function declareStatus(Collection $collection, $timestamp, $status = 'status'){
        $collection = $collection->each(function ($item) use ($timestamp, $status) {
            if( $item->deleted_at && $item->deleted_at->timestamp > $timestamp)
                $item[$status] = 'deleted';
            elseif( $item->updated_at != $item->created_at && $item->updated_at->timestamp > $timestamp )
                $item[$status] = 'updated';
            elseif( $item->created_at->timestamp > $timestamp )
                $item[$status] = 'created';
        });

        return $collection;
    }

    protected function filterByCategory(Collection $collection, Request $request){
        $category = $request->get('category');
        if(strtolower($category) == 'null')
            $collection = $collection->where('category_id', '=', null);
        elseif(strtolower($category) == '!null')
            $collection = $collection->where('category_id', '!=', null);
        else
            $collection = $collection->where('category_id', $request->get('category'));

        return $collection;
    }

    protected function filterByTags(Collection $collection, Array $seek_tags){
        $collection = $collection->filter(function($item) use($seek_tags) {
            foreach($seek_tags as $seek_tag_id){
                $found = false;
                foreach($item->tags as $tag){
                    $found = $found ||( $seek_tag_id == $tag->id);
                }
                if(!$found)
                    return false;
            }
            return true;
        });

        return $collection;
    }

    protected function filterByTimestamp(Collection $collection, $timestamp ){
        $collection = $collection->filter(function ($item) use ($timestamp) {
            return ($item->created_at->timestamp > $timestamp
                || $item->updated_at->timestamp > $timestamp
                || ($item->deleted_at? $item->deleted_at->timestamp > $timestamp : false));
        });

        return $collection;
    }

}
