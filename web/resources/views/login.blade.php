@extends('layouts.master')

@section('content')
    <h1>Caviar Login Page</h1>
    <form method="POST" action="{{url()->full()}}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <a href="/register">Register</a>
    <a href="/">Home</a>
@endsection
