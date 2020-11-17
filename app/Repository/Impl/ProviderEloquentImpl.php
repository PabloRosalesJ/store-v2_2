<?php namespace App\Repository\Impl;

use App\Models\Person;
use App\Models\Provider;
use App\Repository\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProviderEloquentImpl implements ProviderRepository
{
    public function all()
    {
        return Provider::with('person:id,name,l_name,s_name,phone,address,created_at')->get();
    }

    public function store(Request $request)
    {
        // Validating provider_name
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        //saving provider
        DB::beginTransaction();
        try {
            $person   = new Person();
            $provider = new Provider();

            $person->fill($request->all())->save();

            $provider->provider_id   = $person->id;
            $provider->provider_name = $request->provider_name;
            $provider->save();

            DB::commit();
            return [$person, $provider];

        } catch (\Throwable $th) {
            DB::rollBack();
            return ["Error can't save this record." => $th];
        }
    }

    public function getProvider($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->person;
        return $provider;
    }

    public function updateProvider(Request $request)
    {
        // Validating provider_name
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        //updating provider
        DB::beginTransaction();
        try {
            $provider = $this->getProvider($request->route('id'));
            $person   = Person::findOrFail($request->route('id'));

            $person->fill($request->all())->save();
            
            $provider->provider_name = $request->provider_name;
            $provider->save();

            DB::commit();
            return [$person, $provider];

        } catch (\Throwable $th) {
            DB::rollBack();
            return ["Error" => $th];
        }
    }
    
    public function destroyProvider($id)
    {
        $provider = $this->getProvider($id);
        $person = Person::find($id);
        $person->delete();
        return $provider->delete();
    }
    

    public function search(Request $request)
    {
        $query_search = (string)$request->route('query');

        $provider = Provider::where('contact_name','like' ,'%'.$query_search.'%')
        ->orWhere('address','like' ,'%'.$query_search.'%')
        ->orWhere('provider_name','like' ,'%'.$query_search.'%')
        ->get();

        return $provider;
    }
    
}
