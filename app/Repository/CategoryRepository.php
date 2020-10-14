<?php namespace App\Repository;

use Illuminate\Http\Request;

interface CategoryRepository{
	
	public function all();

    public function store(Request $request);
    
    public function getCategory($id);

    public function UpdateCategory(Request $request);
    
    public function DestroyCategory($id);
    
    public function enable($id);
    
    public function disable($id);

    public function search(Request $request);
}