<?php namespace App\Repository\Impl;

use App\Repository\CrudRepository;
use Illuminate\Http\Request;

class CrudEloquentImpl implements CrudRepository
{
    private $Entity;

    public function __construct($entity)
    {
        $this->Entity = $entity;
    }

    public function all()
    {
        return $this->Entity::where('status',1)->get();
    }

    public function store(Request $request)
    {
        $model = new $this->Entity();
        $model->fill($request->all())->save();
        return $model;
    }

    public function findOne($id)
    {
        return $this->Entity::findOrFail($id);
    }

    public function update(Request $request)
    {
        $model = $this->findOne($request->route('id'));
        $model->fill($request->all())->save();
        return $model;
    }
    
    public function destroy($id)
    {
        
        $model = $this->findOne($id);
        return $model->delete();
    }
    
    public function enable($id)
    {
        $model = $this->findOne($id);
        $model->status = 1;
        $model->save();
        return $model;
    }
    
    public function disable($id)
    {
        $model = $this->findOne($id);
        $model->status = 0;
        $model->save();
        return $model;
    }

    public function search(Request $request)
    {
        $query_search = (string)$request->route('query');

        $model = $this->Entity::where('name','like' ,'%'.$query_search.'%')
        ->get();

        return $model;
    }
}
