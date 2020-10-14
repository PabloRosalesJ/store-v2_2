<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Repository\IcomeRepository;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    private $repository;

    public function __construct(IcomeRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    }
    
    public function index()
    {
        return response()->json( [ 'incomes' => $this->repository->all( new Income() ) ] );
    }
    
    public function store(Request $request)
    {
        return response()->json($this->repository->store($request));
    }
    
    public function show($id)
    {
        return response()->json($this->repository->getIncome($id));
    }
    
    public function disable($id)
    {
        return response()->json($this->repository->disableIncome($id));
    }
    
    public function search(REquest $request)
    {
        return response()->json($this->repository->search($request));
    }
}
