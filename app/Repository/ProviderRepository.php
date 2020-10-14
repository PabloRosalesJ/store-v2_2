<?php namespace App\Repository;

use Illuminate\Http\Request;

interface ProviderRepository
{
    public function all();

    public function store(Request $request);
    
    public function getProvider($id);

    public function updateProvider(Request $request);
    
    public function destroyProvider($id);

    public function search(Request $request);
}