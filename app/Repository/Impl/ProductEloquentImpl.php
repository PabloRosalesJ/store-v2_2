<?php namespace App\Repository\Impl;

use App\Repository\ProductRepository;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SaleDetails;

class ProductEloquentImpl implements ProductRepository
{
    public function all()
    {   
        $products = Product::all();
        return $products;
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->all())->save();
        return $product;
    }
    
    public function getProduct(Request $request, $id)
    {
        // Data for products->details->latest_shops_list
        // [Ex]: api/product/(n_p)/show?limit=(n)
        if ($request->has('limit')) {
            return SaleDetails::where('product_id', $id)
                                ->orderBy('id', 'desc')
                                ->limit((int) $request->limit)
                                ->with('sale:id,people_id,user_id')
                                ->get();
        }
        return Product::with(['category:id,name', 'provider:provider_id,provider_name'])
                        ->findOrFail($id);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->route('id'));
        $product->fill($request->all())->save();
        return $product;
    }
    
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
    
    public function enableProduct($id)
    {
        $product = Product::findOrFail(request()->route('id'));
        $product->status = 1;
        $product->save();
        return $product;
    }
    
    public function disableProduct($id)
    {
        $product = Product::findOrFail(request()->route('id'));
        $product->status = 0;
        $product->save();
        return $product;
    }

    public function search(Request $request)
    {
        $product = null;
        
        if ($request->has('name')) {
            $product = Product::where('name','like' ,'%'.$request->name.'%')
                                ->where('status', true)
                                ->get();
        }
        if ($request->has('bar_code')) {
            $product = Product::where('bar_code','like' ,'%'.$request->bar_code.'%')
                                ->where('status', true)
                                ->get();
        }
        if ($request->has('unit_price')) {
            $product = Product::where('unit_price','like' ,'%'.$request->unit_price.'%')
                                ->where('status', true)
                                ->get();
        }
        
        return $product;
    }

    public static function inSale(array $cart)
    {
        $count = 0;
        foreach ($cart as $key => $item) {
            if (in_array('take', $item)) {                
                $product = Product::findOrFail($item['id']);
                $product->stock -= $item['picesSelected'];
                $product->save();
            }
            $count ++;
        }

        if (count($cart) === $count) {
            return true;
        }
        return false;
    }
}