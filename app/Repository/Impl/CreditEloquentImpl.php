<?php namespace App\Repository\Impl;

use App\Http\Requests\Credit\StoreRequest;
use App\Models\CredtiDetail;
use App\Repository\CreditRepository;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditEloquentImpl implements CreditRepository{
    public function all(){
        return Credit::where('status', 1)
            ->with('user')
            ->with('person')
            ->get();
    }

    public function store(Request $request){
        $credit = Credit::create([
            'people_id' => $request->people_id,
            'user_id' => $request->user_id,
            'take' => $request->take,
            'total' => $request->total,
        ]);
        return $credit;
    }

    public function getCredit(int $credit_id){

        $header = Credit::where('status', 1)
                        ->where('id', $credit_id)
                        ->with('user')
                        ->with('person')
                        ->get();

        $credit_details = CredtiDetail::where('credit_id', $credit_id)
                        ->with('product')
                        ->get();

        return compact('header', 'credit_details');

    }

    public function disableCredit(){
        return 'disableCredit';
    }

    public function searchCredit(){
        return 'searchCredit';
    }
}
