@extends('layouts.app')

@section('content')
    <h1>Add New Player</h1>
    <form action="{{ route('players.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Player Name">
        <select name="team_id">
            @foreach($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
        <button type="submit">Save</button>
    </form>
@endsection

