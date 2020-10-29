<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Repository\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    }
    
    public function index()
    {
        return response()->json($this->repository->all(new Sale()));
    }

    public function store(Request $request)
    {
        return response()->json( $this->repository->store($request));
    }
    
    public function show(int $id)
    {
        return response()->json( $this->repository->getSale($id));
    }
    
    public function disable(int $id)
    {
        return response()->json( $this->repository->disableSale($id));
    }
    
    public function search(Request $request)
    {
        return response()->json( $this->repository->search($request));
    }

    public function byClient(int $id)
    {
        return response()->json($this->repository->byClient($id));
    }
    
    public function byUser(int $id)
    {
        return response()->json($this->repository->byUser($id));
    }
}
