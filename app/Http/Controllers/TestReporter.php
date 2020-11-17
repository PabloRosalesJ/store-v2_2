<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class TestReporter extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->has('export')) {
            if ($request->export == 'pdf') { 
                $now = Carbon::now();
                $client = Person::findOrFail($request->client_id);

                // return view('reports.clients.shops', compact('client', 'now'));
                
                $pdf = PDF::loadView('reports.clients.shops', compact('client', 'now'));
                return $pdf->download('historial-compras-'.$client->FullName.'-'.$now->format("m/d/Y").'.pdf');
            }
        } 
    }
}
