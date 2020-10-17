<?php namespace App\Repository\Impl;

use App\Models\CredtiDetail;
use App\Repository\CreditRepository;
use App\Models\Credit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditEloquentImpl implements CreditRepository{
    public function all(){

        return Credit::where('status', 1)
            ->with('user')
            ->with('person')
            ->get();
    }

    public function store(Request $request){

        if ($request->take === 1){
            // TODO
        }

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

    public function disableCredit(int $id){

        return $id;

        $credit  = Credit::findOrFail($id);
        $credit->status = false;
        $credit->save();

        return http_response_code(200);

    }

    public function searchCredit(Request $request){

        $start_date = Carbon::parse($request->start_date)->format('Y/m/d');
        $end_date = Carbon::parse($request->end_date)->format('Y/m/d');

        if ($start_date !== $end_date){
            $credits = Credit::whereBetween('created_at', [$start_date, $end_date])
                ->where('total', 'like', '%'.$request->total.'%')
                ->where('user_id', $request->user_id)
                ->where('people_id', $request->person_id)
                ->get();
        } else{

            $credits = Credit::where('total', 'like', '%'.$request->total.'%')
                ->where('total', 'like', '%'.$request->total.'%')
                ->where('user_id', $request->user_id)
                ->where('people_id', $request->person_id)
                ->get();
        }

        return $credits;

    }
}
