@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('statistics.nav')

            <div class="card">
                <div class="card-header">Statistics</div>

                <div class="card-body">
                    <p>Choose the desired statistics view:</p>
                    <ul>
                        <li><a href="{{ url('/statistics/day') }}">Today</a></li>
                        <li><a href="{{ url('/statistics/week') }}">This week</a></li>
                        <li><a href="{{ url('/statistics/month') }}">This month</a></li>
                    </ul>
                </div>
            </div>

            
            <div class="input-group mb-3 mt-3">
              <div class="input-group-prepend">
                <span class="input-group-text">YOUR API TOKEN</span>
              </div>
              <input type="text" class="form-control" value="{{ $api_token }}" readonly>
            </div>
        </div>
    </div>
</div>
@endsection
