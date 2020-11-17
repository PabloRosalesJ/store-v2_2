<?php namespace App\Repository\Impl;

use App\Models\Sale;
use App\Models\Person;
use App\Models\SaleDetails;
use App\Models\IncomeDetail;
use App\Repository\SaleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Barryvdh\DomPDF\Facade as PDF;

class SaleEloquentImpl implements SaleRepository
{
    public function all(Model $model)
    {
        return $model::all();
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
        $details = SaleDetails::where('sale_id', '=', $id)
                    ->with('product')
                    ->get();
        return $details;
    }
    
    public function disableSale(Request $request, int $id)
    {
        
        if ($request->pw === "12312300") {
            
            $income = Sale::findOrFail($id);
            $income->status = 0;
            $income->save();

            return \response()->json('Ok', 200);
        }
        \abort(403);
        
    }

    public function search(Request $request)
    {
        $query = (string)$request->route('query');
        return Income::where('number', 'like', "%$query%")
                    ->Orwhere('total', 'like', "%$query%")
                    ->get();
    }

    public function byUser(Request $request, int $id)
    {
        $sales_user = Sale::where('user_id', $id)
                            ->where('status', 1)
                            ->orderBy('created_at', 'desc')
                            ->with('people')
                            ->get();
        return $sales_user;
    }
    
    public function byClient(Request $request, int $id)
    {
        if ($request->has('export')) {
            if ($request->export == 'pdf') {
                $now = Carbon::now();
                $client = Person::findOrFail($id);

                // return view('reports.clients.shops', compact('client', 'now'));
                
                $pdf = PDF::loadView('reports.clients.shops', compact('client', 'now'));
                return $pdf->download('historial-compras-'.$client->FullName.'-'.$now->format("m/d/Y").'.pdf');
            }
        }

        $sales_user = Sale::where('people_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->with('user')
                            ->get();
        
        return \response()->json($sales_user);
    }

}