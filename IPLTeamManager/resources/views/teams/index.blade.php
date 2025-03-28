@extends('layouts.app')

@section('content')
    <h1>Teams</h1>
    <a href="{{ route('teams.create') }}">Add New Team</a>
    <ul>
        @foreach($teams as $team)
            <li><a href="{{ route('teams.show', $team->id) }}">{{ $team->name }}</a> | 
                <a href="{{ route('teams.edit', $team->id) }}">Edit</a>
                <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection