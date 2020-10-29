<?php namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface SaleRepository
{
    public function all(Model $model);

    public function store(Request $request);
    
    public function getSale(int $id);
    
    public function disableSale(int $id);

    public function search(Request $request);

    public function byUser(int $id);

    public function byClient(int $id);
}