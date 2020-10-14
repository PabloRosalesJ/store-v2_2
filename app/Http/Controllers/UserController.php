<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->middleware('OnlyAjaxRequest');
        $this->repository = $repository;
    }
    
    public function index()
    {
        return response()->json($this->repository->all());
    }
    
    public function store(StoreUserRequest $request)
    {
        return response()->json($this->repository->store($request));
    }
    
    public function show($id)
    {
        return response()->json($this->repository->getUser($id));
    }
    
    public function update(UpdateUserRequest $request)
    {
        return response()->json($this->repository->updateUser($request));
    }
    
    public function destroy($id)
    {
        return response()->json($this->repository->destroyUser($id));
    }

    public function search(Request $request)
    {
        return response()->json($this->repository->search($request));
    }
}
