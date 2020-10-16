<?php namespace App\Repository;

use App\Http\Requests\Credit\StoreRequest;
use Illuminate\Http\Request;

interface CreditRepository{
    public function all();

    public function store(Request $request);

    public function getCredit(int $credit_id);

    public function disableCredit();

    public function searchCredit();
}
