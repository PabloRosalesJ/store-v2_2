@extends('store')

@section('extra_css')
	<link href="{{ asset('css/plugins/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

	<user-list></user-list>

@endsection

@section('extra_js')
	<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/plugins/dataTables.bootstrap4.min.js') }}"></script>

@endsection