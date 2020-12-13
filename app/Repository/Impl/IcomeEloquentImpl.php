<?php namespace App\Repository\Impl;

use App\Models\Income;
use App\Models\IncomeDetail;
use App\Repository\IcomeRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IcomeEloquentImpl implements IcomeRepository
{
    public function all(Model $model)
    {
        return $model::with('user')
                    ->orderBy('id', 'desc')
                    ->get();
    }

    public function store(Request $request)
    {
        dd($request->user());
        // TODO -> verify pw
        try {
            DB::beginTransaction();

            $income = new Income();
            $income->user_id = Auth::user();
            $income->number = "I-".strtoupper(Str::random(4)).date('ym');
            $income->total = $request->total;
            $income->updated_at = $request->updated_at;
            $income->save();

            $details = $request->products;

            foreach ($details as $key => $item) {
                $incDet = new IncomeDetail();
                $incDet->income_id = $income->id;
                $incDet->product_id = $item['product_id'];
                $incDet->quantity = $item['quantity'];
                $incDet->price = $item['price'];
                $incDet->sub_total = $item['sub_total'];
                $incDet->save();
            }

            if (ProductEloquentImpl::income($details)) {
                DB::commit();
                return $income;
            }
            throw new Exception("Error Processing Request", 1);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }

    public function getIncome($id)
    {

        return IncomeDetail::with('product:id,name,description')
                        ->where('income_id',$id)
                        ->get();
    }

    public function disableIncome(Request $request,$id)
    {
        $details = IncomeDetail::where('income_id', $id)->get(['product_id','quantity']);
        // dd($details);
        try{
            DB::beginTransaction();
            $income = Income::findOrFail($id);
            $income->state = false;
            $income->save();
            if (ProductEloquentImpl::cancelOperation($details,'product_id','quantity')) {
                DB::commit();
                return $income;
            }
            throw new Exception("Error Processing Request", 1);
        } catch(\Throwable $th){
            DB::rollBack();
            dd($th);
        }
    }


    public function search(Request $request)
    {
        $query = (string)$request->route('query');
        return Income::where('number', 'like', "%$query%")
                    ->Orwhere('total', 'like', "%$query%")
                    ->get();
    }

}
