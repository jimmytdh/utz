@extends('layout.app')

@section('content')
    <h2 class="title-header">Hi {{ Auth::user()->name }}, <small class="text-muted">{{ \App\Http\Controllers\ConfigController::greetings() }}!</small></h2>
@endsection