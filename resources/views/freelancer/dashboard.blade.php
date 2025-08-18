@extends('layouts.app')

@auth
<div class="container">
    <h1>Freelancer Dashboard</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endauth


