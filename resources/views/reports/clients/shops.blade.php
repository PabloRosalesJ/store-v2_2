@extends('reports.base')

@section('content')

<strong>Lorem, ipsum dolor.</strong>
<p class="m-0 p-0">Dirección: Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
<p class="m-0 p-0">a: {{$now->format("m/d/Y")}}</p>
<br>
<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td><p class="m-0 p-0"> Cliente: {{$client->FullName}} </p></td>
        <td></td>
        <td><p class="m-0 p-0"> Dirección: {{$client->address}}  </p></td>
    </tr>
    <tr>
        <td><p class="m-0 p-0"> Teléfono: {{$client->phone}}  </p></td>
        <td></td>
        <td><p class="m-0 p-0"> desde: {{$client->created_at->format("m/d/Y")}} </p></td>
    </tr>
</table>

<p class="text-center m-0 p-0"><strong>Historial de Compras</strong></p>

<div class="row justify-content-center">
    <table class="table table-sm mt-3" style="width: 700px;">
        <thead>
            <tr class="text-sm">
                <th>Compra</th>
                <th class="text-center">Detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 200px;"></td>
                <td> 
                    <table style="width: 500px;" class="m-0 p-0">
                        <tr class="m-0 p-0">
                            <td class="m-0 p-0">Producto</td>
                            <td class="m-0 p-0">Cantidad</td>
                            <td class="m-0 p-0">Precio</td>
                            <td class="m-0 p-0">Descuento</td>
                            <td class="m-0 p-0">Sub total</td>
                        </tr>
                    </table>
                </td>
            </tr>
            @foreach ($client->shops as $shop)
            <tr>
                <td style="width: 200px;">
                    <strong class="m-0 p-0">Serie:    {{$shop->serie}} </strong> 
                    <p class="m-0 p-0">Fecha:    {{$shop->created_at->format("m/d/Y")}} </p> 
                    <p class="m-0 p-0">Vendedor: {{$shop->user->username}} </p> 
                    <p class="m-0 p-0">Total:    ${{$shop->total}}.00 </p> 
                    Pz: {{$shop->details->count() }} 
                    @if ($shop->status == 0)
                    | <span class="badge badge-pill badge-danger">Cancelado</span>
                    @endif
                </td>
                <td>
                    <table style="width: 500px;"> 
                        @for ($i = 0; $i < $shop->details->count(); $i++)
                        <tr>
                            <td>{{$shop->details[$i]->product[0]->name }}</td>
                            <td>{{$shop->details[$i]->quantity }}pz </td>
                            <td>${{$shop->details[$i]->price }}</td>
                            <td>{{$shop->details[$i]->discount }}</td>
                            <td> = ${{$shop->details[$i]->sub_total }}</td>
                        </tr>
                        @endfor
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection