<?php namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IcomeRepository
{
    public function all(Model $model);

    public function store(Request $request);
    
    public function getIncome(int $id);
    
    public function disableIncome(int $id);

    public function search(Request $request);
}