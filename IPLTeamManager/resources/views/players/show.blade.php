@extends('layouts.app')

@section('content')
    <h1>{{ $player->name }}</h1>
    <p>Team: {{ $player->team->name }}</p>
    <a href="{{ route('players.index') }}">Back to Players</a>
@endsection
