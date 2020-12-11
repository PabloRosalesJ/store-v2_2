<?php namespace App\Repository\Impl;

use App\Models\Income;
use App\Models\IncomeDetail;
use App\Repository\IcomeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            //DB::beginTransaction();
            
            $income = new Income();
            $income->user_id = $request->user_id;
            $income->number = $request->number;
            $income->total = $request->total;
            //$income->save();

            $details = $request->details;

            foreach ($details as $key => $item) {
                $detail = new IncomeDetail();
                //$detail->income_id = $income->id;
                $detail->product_id = $item['product_id'];
                $detail->quantity = $item['quantity'];
                $detail->price = $item['price'];
                //$detail->save();
            }
            return [$income,$detail];
            //DB::commit();
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
    
    public function disableIncome($id)
    {
        $income = Income::findOrFail($id);
        $income->state = false;
        return $income->save();
    }


    public function search(Request $request)
    {
        $query = (string)$request->route('query');
        return Income::where('number', 'like', "%$query%")
                    ->Orwhere('total', 'like', "%$query%")
                    ->get();
    }

}