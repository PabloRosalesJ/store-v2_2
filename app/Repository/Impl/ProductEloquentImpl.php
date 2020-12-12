<?php namespace App\Repository\Impl;

use App\Repository\ProductRepository;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SaleDetails;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class ProductEloquentImpl implements ProductRepository
{
    public function all()
    {   
        $products = Product::orderBy('id', 'desc')->get();
        return $products;
    }

    public function store(Request $request)
    {
        $image = '';
        
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public');
        }

        if($request->bar_code === null){
            $barcode = "P-".strtoupper(Str::random(4)).strtoupper(substr($request->name, 0, 3));
        } else {
            $barcode = $request->bar_code;
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->provider_id = $request->provider_id;
        $product->bar_code = $barcode;
        $product->name = $request->name;
        $product->description = $request->desc_category;
        $product->image = $image;
        $product->buy_price = $request->buy_price;
        $product->unit_price = $request->unit_price;
        $product->wholesale_price = $request->wholesale_price;
        $product->stock = $request->stock;
        $product->status = $request->status ? 1 : 0;
        $product->save();
        
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
        $product = Product::with(['category:id,name', 'provider:provider_id,provider_name'])
                        ->findOrFail($id);
        $image = Storage::url($product->image);

        return compact('product', 'image');
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
        $product[0]->image = Storage::url($product[0]->image);
        
        return $product;
    }

    public static function inSale(array $cart)
    {
        $count = 0;
        foreach ($cart as $key => $item) {   
            $product = Product::findOrFail($item['id']);
            $product->stock -= $item['picesSelected'];
            $product->save();
            $count ++;
        }

        if (count($cart) === $count) {
            return true;
        }
        return false;
    }

    public static function inCredit(array $cart) : bool{
        $count = 0;
        foreach ($cart as $key => $item) {   
            if ($item['take']) {
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

    public static function income(array $cart) : bool
    {
        $count = 0;
        foreach ($cart as $key => $item) {   
            $product = Product::findOrFail($item['product_id']);
            $product->stock += $item['quantity'];
            $product->buy_price = $item['price'];
            $product->save();
            $count ++;
        }

        if (count($cart) === $count) {
            return true;
        }
        return false;
    }

    public static function cancelOperation(Collection $productList, string $product_flag, string $pz_flag) : bool
    {
        $count = 0;
        foreach ($productList as $key => $item) {   
            $product = Product::findOrFail($item["$product_flag"]);
            $product->stock -= $item["$pz_flag"];
            $product->save();
            $count ++;
        }

        if (count($productList) === $count) {
            return true;
        }
        return false;
    }
}