<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository){
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    }
    
    public function index()
    {
        return response()->json($this->repository->all());
    }
    
    public function store(StoreProductRequest $request)
    {
        return response()->json($this->repository->store($request));
    }
    
    public function show(Request $request,$id)
    {
        return response()->json($this->repository->getProduct($request, $id));
    }
    
    public function update(Request $request)
    {
        return response()->json($this->repository->updateProduct($request));
    }
    
    public function destroy($id)
    {
        return response()->json($this->repository->destroyProduct($id));
    }

    public function enableProduct($id)
    {
        return response()->json($this->repository->enableProduct($id));
    }

    public function disableProduct($id)
    {
        return response()->json($this->repository->disableProduct($id));
    }

    public function search(Request $request)
    {
        return response()->json($this->repository->search($request));
    }
}
