@extends('layouts.admin.default')

@section('title')
    Connexion    
@endsection

@section('content')
    <h1>Connexion</h1>
    <div>
        <form action="{{route('auth.login')}}" method="POST">
            @csrf
            <input type="text" name="email" id="email" placeholder="email">
            <input type="password" name="password" id="password" placeholder="password">
            <button type="submit">Connexion</button>
        </form>
    </div>
@endsection