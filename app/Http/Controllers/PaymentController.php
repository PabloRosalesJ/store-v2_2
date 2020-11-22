<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Repository\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $repository;
    public function __construct(PaymentRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    }

    public function index()
    {
       return response()->json($this->repository->all());
    }

    public function store(Request $request)
    {
        return response()->json($this->repository);
    }

    public function show(Payment $payment)
    {
        return response()->json($this->repository);
    }

    public function getPaymentByClient(int $client_id)
    {
        return response()->json($this->repository->getPaymentByClient($client_id));
    }

    public function getPaymentByUser(int $user_id)
    {
        return response()->json($this->repository->getPaymentByUser($user_id));
    }

    public function update(Request $request, Payment $payment)
    {
        return response()->json($this->repository);
    }

    public function disable(Request $request, int $payment_id)
    {
        return response()->json($this->repository->disablePayment($request, $payment_id));
    }
}
