<?php


namespace App\Repository\Impl;


use App\Models\Payment;
use App\Repository\PaymentRepository;
use Illuminate\Http\Request;

class PaymentEloquentImpl implements PaymentRepository
{

    public function all()
    {
        return Payment::all();
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function getPayment(int $payment_id)
    {
        // TODO: Implement getPayment() method.
    }

    public function getSinglePayment(int $id)
    {
        // TODO: Implement getSinglePayment() method.
    }

    public function getPaymentByClient(int $client_id)
    {
        return Payment::where('client_id', $client_id)
                        ->with('user')
                        ->get();
    }

    public function getPaymentByUser(int $user_id)
    {
        return Payment::where('user_id', $user_id)
                        ->with('client')
                        ->get();
    }

    public function disablePayment(int $id)
    {
        // TODO: Implement disablePayment() method.
    }

    public function searchPayment(Request $request)
    {
        // TODO: Implement searchPayment() method.
    }
}
