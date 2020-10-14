<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Repository\PersonRepository;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    private $repository;

    public function __construct(PersonRepository $repository)
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
        return response()->json($this->repository->getPerson($id));
    }
    
    public function update(StorePersonRequest $request)
    {
        return response()->json($this->repository->updatePerson($request));
    }
    
    public function destroy($id)
    {
        return response()->json($this->repository->destroyPerson($id));
    }

    public function enablePerson($id)
    {
        return response()->json($this->repository->enablePerson($id));
    }

    public function disablePerson($id)
    {
        return response()->json($this->repository->disablePerson($id));
    }

    public function search(Request $request)
    {
        return response()->json($this->repository->search($request));
    }
}
