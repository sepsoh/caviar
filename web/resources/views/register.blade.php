@extends('layouts.master')
@section('content')
    <h1>Caviar Register Page</h1>
    <form action="{{url()->full()}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <button type="submit">Register</button>
    </form>
    <a href="/login">Login</a>
    <a href="/">Home</a>

@endsection
