<?php namespace App\Repository\Impl;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryEloquentImpl implements CategoryRepository
{
    public function all()
    {
        $categories = Category::all();
        return $categories;
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->all())->save();
        return $category;      
    }
    
    public function getCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::findOrFail(request()->route('id'));
        $category->fill($request->all())->save();
        return $category;
    }
    
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }

    public function enable($id)
    {
        $category = Category::findOrFail($id);
        $category->status = 1;
        $category->save();
        return $category;
    } 
    public function disable($id)
    {
        $category = Category::findOrFail($id);
        $category->status = 0;
        $category->save();
        return $category;
    }

    public function search(Request $request)
    {
        $query_search = (string)$request->route('query');
        
        $product = Category::where('name','like' ,'%'.$query_search.'%')
                            ->orWhere('description','like' ,'%'.$query_search.'%')
                            ->get();
        
        return $product;
    }
}