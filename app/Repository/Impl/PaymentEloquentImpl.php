<?php


namespace App\Repository\Impl;


use App\Models\Payment;
use App\Repository\PaymentRepository;
use Illuminate\Http\Request;

class PaymentEloquentImpl implements PaymentRepository
{

    public function all()
    {
        return Payment::with(['client:id,name,l_name,s_name','user:id,username'])
                    ->orderBy('id', 'desc')
                    ->get();
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function getPayment(int $payment_id)
    {
        return Payment::findOrFail($payment_id);
    }

    public function getSinglePayment(int $id)
    {
        // TODO: Implement getSinglePayment() method.
    }

    public function getPaymentByClient(int $client_id)
    {
        return Payment::where('client_id', $client_id)
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->withTrashed()
                        ->get();
    }

    public function getPaymentByUser(int $user_id)
    {
        return Payment::where('user_id', $user_id)
                        ->with('client')
                        ->orderBy('created_at', 'desc')
                        ->withTrashed()
                        ->get();
    }

    public function disablePayment(Request $request, int $payment_id)
    {
        if ($request->pw === "12312300") {

            $payment = $this->getPayment($payment_id);
            $payment->delete();

            return \response()->json('Ok', 200);
        }
        \abort(403);

    }

    public function searchPayment(Request $request)
    {
        // TODO: Implement searchPayment() method.
    }
}
