@extends('layouts.app')

@section('content')
    <h1>Edit Team</h1>
    <form action="{{ route('teams.update', $team->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $team->name }}">
        <button type="submit">Update</button>
    </form>
@endsection