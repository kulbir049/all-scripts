@extends('layouts.app')

@section('content')
<h1>Players</h1>
<a href="{{ route('players.create') }}">Add New Player</a>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            @foreach ($teamsWithPlayers as $teamName => $players)
                <th>{{ $teamName }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
            // Convert Eloquent Collections to arrays and find the max player count
            $teamsArray = $teamsWithPlayers->map(fn($players) => $players->toArray());
            $maxPlayers = max($teamsArray->map(fn($players) => count($players))->toArray());
        @endphp

        @for ($i = 0; $i < $maxPlayers; $i++)
            <tr>
                @foreach ($teamsWithPlayers as $players)
                    <td>
                        @if (isset($players[$i]))
                            {{ $players[$i]->name }}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endfor
    </tbody>
</table>






@endsection