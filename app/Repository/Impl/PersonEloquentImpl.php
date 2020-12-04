<?php namespace App\Repository\Impl;

use App\Models\Person;
use App\Models\Provider;
use App\Models\User;
use App\Repository\PersonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $person->fill($request
            ->only(['name', 'l_name', 's_name', 'address', 'phone', 'email']))
            ->save();
        return $person;
    }
    
    public function destroyPerson($id)
    {
        $person = $this->getPerson($id);
        $user = User::find($person->id);
        $provider = Provider::find($person->id);

        DB::beginTransaction();
        try {
            
            if ($user !== null) {
                $user->delete();
            }
            if ($provider !== null) {
                $provider->delete();
            }

            $person->delete();

            DB::commit();
            
            return compact('person', 'user', 'provider');

        } catch (\Throwable $th) {
            DB::rollBack();
            return "[Error]: ".$th;
        }
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

        $person = Person::where('status', true)
        ->where('name','like' ,'%'.$query_search.'%')
        ->orWhere('l_name','like' ,'%'.$query_search.'%')
        ->orWhere('s_name','like' ,'%'.$query_search.'%')
        // ->orWhere('address','like' ,'%'.$query_search.'%')
        // ->orWhere('phone','like' ,'%'.$query_search.'%')
        // ->orWhere('email','like' ,'%'.$query_search.'%')
        ->get();

        return $person;
    }
}
