<?php namespace App\Repository;

use Illuminate\Http\Request;

interface UserRepository
{
    public function all();

    public function store(Request $request);
    
    public function getUser($id);

    public function updateUser(Request $request);
    
    public function destroyUser($id);

    public function search(Request $request);
}