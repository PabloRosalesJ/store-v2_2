<?php namespace App\Repository\Impl;

use App\Models\Person;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class USerEloquentImpl implements UserRepository
{
    public function all()
    {
        return User::where('status', 1)->get();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $person = new Person();
            $user   = new User();

            $person->fill($request->all())->save();

            $user->id       = $person->id;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->save();

            DB::commit();
            return [$person, $user];

        } catch (\Throwable $th) {
            DB::rollBack();
            return ["Error can't save this record." => $th];
        }
    }
    
    public function getUser($id)
    {
        $user = User::findOrFail($id);
        $user->person;
        return $user;
    }

    public function updateUser(Request $request)
    {
        $id = request()->route('id');
        DB::beginTransaction();
        try {
            $person   = Person::findOrFail($id);
            $user = User::findOrFail($id);

            $person->fill($request->all())->save();

            $user->id       = $person->id;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->save();

            DB::commit();
            return [$person, $user];

        } catch (\Throwable $th) {
            DB::rollBack();
            return ["Error" => $th];
        }
    }
    
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $person = Person::find($id);
        $person->delete();
        return $user->delete();
    }

    public function search(Request $request)
    {
        $query_search = (string)$request->route('query');

        $provider = User::where('username','like' ,'%'.$query_search.'%')->get();

        return $provider;
    }
}
