<?php namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface SaleRepository
{
    public function all(Model $model);

    public function store(Request $request);
    
    public function getSale(int $id);
    
    public function disableSale(Request $request, int $id);

    public function search(Request $request);

    public function byUser(Request $request,int $id);

    public function byClient(Request $request,int $id);
}