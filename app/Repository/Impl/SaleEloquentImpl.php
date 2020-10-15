<?php namespace App\Repository\Impl;

use App\Models\Sale;
use App\Models\IncomeDetail;
use App\Repository\SaleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SaleEloquentImpl implements SaleRepository
{
    public function all(Model $model)
    {
        return $model::where('status', '1')->get();
    }

    public function store(Request $request)
    {
        return $request->all();
        // try {
        //     //DB::beginTransaction();
            
        //     $income = new Income();
        //     $income->user_id = $request->user_id;
        //     $income->number = $request->number;
        //     $income->total = $request->total;
        //     //$income->save();

        //     $details = $request->details;

        //     foreach ($details as $key => $item) {
        //         $detail = new IncomeDetail();
        //         //$detail->income_id = $income->id;
        //         $detail->product_id = $item['product_id'];
        //         $detail->quantity = $item['quantity'];
        //         $detail->price = $item['price'];
        //         //$detail->save();
        //     }
        //     return [$income,$detail];
        //     //DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     dd($th);
        // }
    }
    
    public function getSale($id)
    {
       $sale_detail = Sale::find($id)
                        ->where('status', 1)
                        ->with('details')->get();
        return $sale_detail;
    }
    
    public function disableSale($id)
    {
        $income = Sale::findOrFail($id);
        $income->status = 0;
        $income->save();

        return \response()->json('Ok', 200);
    }

    public function search(Request $request)
    {
        $query = (string)$request->route('query');
        return Income::where('number', 'like', "%$query%")
                    ->Orwhere('total', 'like', "%$query%")
                    ->get();
    }

}