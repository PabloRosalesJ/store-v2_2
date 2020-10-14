<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Provider;
use App\Repository\ProviderRepository;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ProviderController extends Controller
{
    private $repository;

    public function __construct(ProviderRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    }
    
    public function index()
    {
        return response()->json($this->repository->all());
    }
    
    public function store(StorePersonRequest $request)
    {
        return response()->json($this->repository->store($request));
    }
    
    public function show($id)
    {
        return response()->json($this->repository->getProvider($id));
    }

    public function update(StorePersonRequest $request)
    {
        return response()->json($this->repository->updateProvider($request));
    }
    
    public function destroy($id)
    {
        return response()->json($this->repository->destroyProvider($id));
    }

    public function search(Request $request)
    {
        return response()->json($this->repository->search($request));
    }
    
}
