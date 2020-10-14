<?php namespace App\Repository;

use Illuminate\Http\Request;

interface CrudRepository
{
    public function all();

    public function store(Request $request);
    
    public function findOne($id);

    public function update(Request $request);
    
    public function destroy($id);
    
    public function enable($id);
    
    public function disable($id);

    public function search(Request $request);
}