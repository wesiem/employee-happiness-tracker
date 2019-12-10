@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Statistics <strong>{{ $title }}</strong></div>

                <div class="card-body">
                    <canvas id="votes_chart" width="400" height="150"></canvas>

                    <table class="table stats-table">
                        <thead>
                            <tr>
                                <th scope="col">Emotion</th>
                                <th scope="col">Emoji</th>
                                <th scope="col">Votes</th>
                                <th scope="col">Percent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Unhappy</th>
                                <th>:-(</th>
                                <td>{{ $data->unhappy }} / {{ $data->total }}</td>
                                <td>{{ $data->unhappy_percent }}%</td>
                            </tr>
                            <tr>
                                <th scope="row">Unemotional</th>
                                <th>:-|</th>
                                <td>{{ $data->unemotional }} / {{ $data->total }}</td>
                                <td>{{ $data->unemotional_percent }}%</td>
                            </tr>
                            <tr>
                                <th scope="row">Happy</th>
                                <th>:-)</th>
                                <td>{{ $data->happy }} / {{ $data->total }}</td>
                                <td>{{ $data->happy_percent }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="btn-group mt-2" role="group" aria-label="Statistics nav">
                <a href="{{ url('/statistics') }}" role="button" class="btn btn-secondary btn-group-lg">Main</a>
                <a href="{{ url('/statistics/day') }}" role="button" class="btn btn-secondary btn-group-lg">Today</a>
                <a href="{{ url('/statistics/week') }}" role="button" class="btn btn-secondary btn-group-lg">This week</a>
                <a href="{{ url('/statistics/month') }}" role="button" class="btn btn-secondary btn-group-lg">This month</a>
            </div>
        </div>
    </div>
</div>
@endsection
