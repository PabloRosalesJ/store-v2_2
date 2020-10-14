<?php namespace App\Repository;

use Illuminate\Http\Request;

interface ProductRepository
{
    public function all();

    public function store(Request $request);
    
    public function getProduct($id);

    public function updateProduct(Request $request);
    
    public function destroyProduct($id);
    
    public function enableProduct($id);
    
    public function disableProduct($id);

    public function search(Request $request);

}
