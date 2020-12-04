<?php namespace App\Repository\Impl;

use App\Models\CredtiDetail;
use App\Repository\CreditRepository;
use App\Models\Credit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class CreditEloquentImpl implements CreditRepository{
    public function all(){
        return Credit::where('status', 1)
            ->with(['user:id,username', 'person:id,name,l_name,s_name'])
            ->get();
    }

    public function store(Request $request){

        return $request->all();
        // if ($request->take === 1){
        //     // TODO
        // }

        // $credit = Credit::create([
        //     'people_id' => $request->people_id,
        //     'user_id' => $request->user_id,
        //     'take' => $request->take,
        //     'total' => $request->total,
        // ]);

        // return $credit;

    }

    public function getCredit(int $credit_id){

        $header = Credit::where('status', 1)
                        ->where('id', $credit_id)
                        ->with('user')
                        ->with('person:id,name,l_name,s_name')
                        ->get();

        $credit_details = CredtiDetail::where('credit_id', $credit_id)
                        // ->select(['product_id','pices', 'cost', 'sub_total'])
                        ->with('product:id,name')
                        ->get();

        return compact('header', 'credit_details');

    }

    public function getSingleCredit(int $credit_id){
        // return $id;
        return CredtiDetail::where('credit_id', $credit_id)
        // ->select(['product_id','pices', 'cost', 'sub_total'])
        ->with('product:id,name')
        ->get();
    }

    public function getCreditByClient(int $credit_id){
        return Credit::where('people_id', $credit_id)
                        // ->where('status', 1)
                        ->with(['user:id,username'])
                        ->get();
    }

    public function getCreditByUser(int $credit_id){
        return Credit::where('user_id', $credit_id)
                        // ->where('status', 1)
                        ->with(['person:id,name,l_name,s_name'])
                        ->get();
    }

    public function disableCredit(Request $request, int $credit_id){

        if ($request->pw === "12312300") {
            $credit  = Credit::findOrFail($credit_id);
            $credit->status = false;
            $credit->save();

            return response('Ok',200);
        }
        return \abort(403);
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
