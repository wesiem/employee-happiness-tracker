@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome!</div>

                <div class="card-body">
                	<p>
	                    We at WeAreHappy want to have an idea of the happiness of our employees.<br />
	                    Please tell us how satisfied you are!
	                </p>

                    <div id="vote-buttons" class="btn-group" role="group" aria-label="Vote buttons">
						<a href="{{ url('/votes/new/unhappy') }}" role="button" class="btn btn-danger btn-group-lg">:-(</a>
						<a href="{{ url('/votes/new/unemotional') }}" role="button" class="btn btn-primary btn-group-lg">:-|</a>
						<a href="{{ url('/votes/new/happy') }}" role="button" class="btn btn-success btn-group-lg">:-)</a>
					</div>

                    @auth
                        <p class="mt-3">
                            <a href="{{ url('/statistics') }}">view statistics</a>
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
