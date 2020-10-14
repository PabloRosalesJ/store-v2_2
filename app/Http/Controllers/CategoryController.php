<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    } 
    
    public function index()
    {
        return response()->json($this->repository->all());
    }
    
    public function store(StoreCategoryRequest $request)
    {
        return response()->json($this->repository->store($request));
    }

    public function show($id)
    {
        return response()->json($this->repository->getCategory($id));
    }
    
    public function update(StoreCategoryRequest $request)
    {
        return response()->json($this->repository->updateCategory($request));
    }
    
    public function destroy($id)
    {
        return response()->json($this->repository->destroyCategory($id));
    }

    public function enable($id)
    {
        return response()->json($this->repository->enable($id));
    }

    public function disable($id)
    {
        return response()->json($this->repository->disable($id));
    }

    public function search(Request $request)
    {
        return response()->json($this->repository->search($request));
    }

}
