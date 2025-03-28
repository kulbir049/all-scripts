@extends('layouts.app')

@section('content')
    <h1>{{ $team->name }}</h1>
    <a href="{{ route('teams.index') }}">Back to Teams</a>
@endsection