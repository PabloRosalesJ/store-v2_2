<?php namespace App\Repository\Impl;

use App\Models\Person;
use App\Repository\PersonRepository;
use Illuminate\Http\Request;

class PersonEloquentImpl implements PersonRepository
{
    public function all()
    {
        return Person:://where('status',1)
                    orderBy('id', 'desc')
                    ->get();
    }

    public function store(Request $request)
    {
        $person = new Person();
        // $person->create(
        //     $request->only(['name', 'l_name', 's_name', 'address', 'phone', 'email'])
        //     )->save();

        $person->fill($request->only(['name', 'l_name', 's_name', 'address', 'phone', 'email']))->save();
        return $person;
    }

    public function getPerson($id)
    {
        return Person::findOrFail($id);
    }

    public function updatePerson(Request $request)
    {
        $person = $this->getPerson($request->route('id'));
        $person->fill($request->all())->save();
        return $person;
    }
    
    public function destroyPerson($id)
    {
        
        $person = $this->getPerson($id);
        return $person->delete();
    }
    
    public function enablePerson($id)
    {
        $person = $this->getPerson($id);
        $person->status = 1;
        $person->save();
        return $person;
    }
    
    public function disablePerson($id)
    {
        $person = $this->getPerson($id);
        $person->status = 0;
        $person->save();
        return $person;
    }

    public function search(Request $request)
    {
        $query_search = (string)$request->route('query');

        $person = Person::where('name','like' ,'%'.$query_search.'%')
        ->orWhere('l_name','like' ,'%'.$query_search.'%')
        ->orWhere('s_name','like' ,'%'.$query_search.'%')
        ->orWhere('address','like' ,'%'.$query_search.'%')
        ->orWhere('phone','like' ,'%'.$query_search.'%')
        ->orWhere('email','like' ,'%'.$query_search.'%')
        ->get();

        return $person;
    }
}
