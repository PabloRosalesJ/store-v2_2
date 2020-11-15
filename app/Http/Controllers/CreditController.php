<?php

namespace App\Http\Controllers;

use App\Http\Requests\Credit\StoreRequest;
use App\Models\Credit;
use App\Repository\CreditRepository;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    private $CreditRepository;

    public function __construct(CreditRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->CreditRepository = $repository;
    }

    public function index()
    {
        return response()->json($this->CreditRepository->all());
    }

    public function store(StoreRequest $request)
    {
        return response()->json($this->CreditRepository->store($request));
    }

    public function client(int $credit_id)
    {
        return response()->json($this->CreditRepository->getCreditByClient($credit_id));
    }

    public function user(int $credit_id)
    {
        return response()->json($this->CreditRepository->getCreditByUser($credit_id));
    }

    public function show(int $credit_id)
    {
        return response()->json($this->CreditRepository->getCredit($credit_id));
    }
    
    public function getSingleCredit(int $credit_id)
    {
        return response()->json($this->CreditRepository->getSingleCredit($credit_id));
    }
    public function disable(Request $request, int $credit_id)
    {
        return response()->json($this->CreditRepository->disableCredit($request, $credit_id));
    }

    public function search(Request $request)
    {
        return response()->json($this->CreditRepository->searchCredit($request));
    }
}
