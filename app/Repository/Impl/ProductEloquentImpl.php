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
        $query_search = (string)$request->route('query');
        
        $product = Product::where('name','like' ,'%'.$query_search.'%')
                            ->orWhere('description','like' ,'%'.$query_search.'%')
                            ->orWhere('bar_code','like' ,'%'.$query_search.'%')
                            ->orWhere('buy_price','like' ,'%'.$query_search.'%')
                            ->orWhere('unit_price','like' ,'%'.$query_search.'%')
                            ->orWhere('wholesale_price','like' ,'%'.$query_search.'%')
                            ->get();
        
        return $product;
    }
}