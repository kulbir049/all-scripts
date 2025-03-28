@extends('layouts.app')

@section('content')
    <h1>Edit Player</h1>
    <form action="{{ route('players.update', $player->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $player->name }}">
        <select name="team_id">
            @foreach($teams as $team)
                <option value="{{ $team->id }}" {{ $player->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
            @endforeach
        </select>
        <button type="submit">Update</button>
    </form>
@endsection

