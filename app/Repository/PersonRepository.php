<?php namespace App\Repository;

use Illuminate\Http\Request;

interface PersonRepository
{
    public function all();

    public function store(Request $request);
    
    public function getPerson($id);

    public function updatePerson(Request $request);
    
    public function destroyPerson($id);
    
    public function enablePerson($id);
    
    public function disablePerson($id);

    public function search(Request $request);
}