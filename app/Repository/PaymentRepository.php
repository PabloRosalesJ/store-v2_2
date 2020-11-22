<?php


namespace App\Repository;


use Illuminate\Http\Request;

interface PaymentRepository
{
    public function all();

    public function store(Request $request);

    public function getPayment(int $payment_id);

    public function getSinglePayment(int $id);

    public function getPaymentByClient(int $client_id);

    public function getPaymentByUser(int $user_id);

    public function disablePayment(Request $request, int $payment_ids);

    public function searchPayment(Request $request);
}
