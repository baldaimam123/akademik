@extends('layout')

@section('title', 'Edit tugas')

@section('content')
    <div>
    <h2>Selamat datang, {{ session('user')->name }}</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>
@endsection
