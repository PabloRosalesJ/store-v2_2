<?php namespace App\Repository;

use App\Http\Requests\Credit\StoreRequest;
use Illuminate\Http\Request;

interface CreditRepository{
    public function all();

    public function store(Request $request);

    public function getCredit(int $credit_id);

    public function getSingleCredit(int $id);

    public function getCreditByClient(int $credit_id);

    public function getCreditByUser(int $credit_id);

    public function disableCredit(Request $request, int $credit_id);

    public function searchCredit(Request $request);
}
