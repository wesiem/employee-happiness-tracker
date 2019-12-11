@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('statistics.nav')

            <div class="card">
                <div class="card-header">Statistics <strong>{{ $title }}</strong></div>

                <div class="card-body">
                    <p>Employees were on average {{ $data->average }} {{ $title }} ({{ $data->average_percent }}%).</p>

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
        </div>
    </div>
</div>
@endsection
