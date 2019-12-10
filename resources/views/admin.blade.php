@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Statistics of the current day</div>

                <div class="card-body">
                    {{ $statistics->day->total }}
                    {{ $statistics->day->happy }}
                    {{ $statistics->day->unemotional }}
                    {{ $statistics->day->unhappy }}
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Statistics of the current week</div>

                <div class="card-body">
                    {{ $statistics->week->total }}
                    {{ $statistics->week->happy }}
                    {{ $statistics->week->unemotional }}
                    {{ $statistics->week->unhappy }}
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Statistics of the current month</div>

                <div class="card-body">
                    {{ $statistics->month->total }}
                    {{ $statistics->month->happy }}
                    {{ $statistics->month->unemotional }}
                    {{ $statistics->month->unhappy }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
