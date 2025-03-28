@extends('layouts.app')

@section('title', 'Today Match')

@section('content')
<div class="container">
    <h2 class="mb-4">Select Teams for Today's Match</h2>

    <form method="GET" action="{{ route('today.match') }}">
        <div class="row mb-3">
            <div class="col-md-5">
                <label for="team1" class="form-label">Team 1</label>
                <select class="form-control" name="team1" id="team1" required>
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ $team1 == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <label for="team2" class="form-label">Team 2</label>
                <select class="form-control" name="team2" id="team2" required>
                    <option value="">Select Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ $team2 == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Show Players</button>
            </div>
        </div>
    </form>

    @if($players1 && $players2)
    <h3 class="mt-4 text-center">Today's Match: <span class="text-primary">{{ $team1 ? $teams->find($team1)?->name : '' }}</span> vs <span class="text-danger">{{ $team2 ? $teams->find($team2)?->name : '' }}</span></h3>

    <div class="row mt-4">
        <div class="col-md-6">
            <h4 class="text-primary">{{ $team1 ? $teams->find($team1)?->name : '' }}</h4>
            <ul class="list-group">
                @foreach($players1 as $player)
                    <li class="list-group-item">{{ $player->name }} - {{ $player->role }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h4 class="text-danger">{{ $team2 ? $teams->find($team2)?->name : '' }}</h4>
            <ul class="list-group">
                @foreach($players2 as $player)
                    <li class="list-group-item">{{ $player->name }} - {{ $player->role }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
