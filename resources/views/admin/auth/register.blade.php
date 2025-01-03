@extends('layouts.admin.default')

@section('title')
    Enregistrement utilisateur
@endsection

@section('content')
    <h1>Enregistrement</h1>
    <div>
        <form action="{{route('auth.register')}}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="name">
            <input type="text" name="email" id="email" placeholder="email">
            <input type="password" name="password" id="password" placeholder="password">
            <button type="submit">Enregistrer</button>
        </form>
    </div>
@endsection