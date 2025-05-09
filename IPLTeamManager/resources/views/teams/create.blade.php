@extends('layouts.app')

@section('content')
    <h1>Add New Team</h1>
    <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Team Name">
        <button type="submit">Save</button>
    </form>
@endsection