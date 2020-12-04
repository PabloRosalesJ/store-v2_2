<?php namespace App\Repository\Impl;

use App\Models\Sale;
use App\Repository\SaleRepository;
use App\Models\SaleDetails;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Repository\Impl\ProductEloquentImpl;

use Barryvdh\DomPDF\Facade as PDF;
use Exception;

class SaleEloquentImpl implements SaleRepository
{
    public function all(Model $model)
    {
        return $model::orderBy('id', 'desc')
                ->with(['user:id,username', 'people:id,name,l_name,s_name'])->get();
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $sale = new Sale();
            $sale->people_id = $request->client['id'];
            $sale->user_id = 1; // ToRefactor
            $sale->serie = "V-".strtoupper(Str::random(4)).date('ym');
            $sale->total = $request->total;
            $sale->updated_at = null;
            $sale->save();

            $cart = $request->cart;

            foreach ($cart as $key => $item) {
                $detail = new SaleDetails();
                $detail->sale_id = $sale->id;
                $detail->product_id = $item['id'];
                $detail->quantity = $item['picesSelected'];
                $detail->price = $item['unit_price'];
                $detail->discount = 0;
                $detail->sub_total = (float) $item['unit_price'] * (float) $item['picesSelected'];
                $detail->save();
            }
            if (ProductEloquentImpl::inSale($cart)) {
                DB::commit();
                return $sale;
            }
            throw new Exception("Error Processing Request", 1);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
    
    public function getSale($id)
    {
        return SaleDetails::where('sale_id', '=', $id)
                    ->with('product')
                    ->get();
        
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
        return Sale::where('number', 'like', "%$query%")
                    ->Orwhere('total', 'like', "%$query%")
                    ->get();
    }

    public function byUser(Request $request, int $id)
    {
        $sales_user = Sale::where('user_id', $id)
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