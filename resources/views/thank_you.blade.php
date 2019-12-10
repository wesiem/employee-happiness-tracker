@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thank you!</div>

                <div class="card-body">
                	<p>
	                    Your vote has been registered. We highly appreciate your feedback, thank you!
	                </p>
                    <p>
                        <a href="{{ url('/') }}">New vote</a> or wait a few seconds.
                        @auth
                            <a href="{{ url('/admin') }}">View statistics.</a>
                        @endauth
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script> setTimeout(function(){window.location='{{ url('/') }}'}, 5000); </script>