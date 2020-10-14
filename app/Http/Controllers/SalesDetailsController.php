<?php

namespace App\Http\Controllers;

use App\Repository\SaleRepository;
use App\sales_details;
use Illuminate\Http\Request;

class SalesDetailsController extends Controller
{
    private $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->middleware('OnlyAjaxReqest');
        $this->repository = $repository;
    }
    
    public function index()
    {
        $this->repository;
    }

    public function create()
    {
        $this->repository;
    }

    public function store(Request $request)
    {
        $this->repository;
    }

    public function show(sales_details $sales_details)
    {
        $this->repository;
    }
    
    public function update(Request $request, sales_details $sales_details)
    {
        $this->repository;
    }

    public function destroy(sales_details $sales_details)
    {
        $this->repository;
    }
}
