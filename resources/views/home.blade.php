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

                    <div class="btn-group" role="group" aria-label="Basic example">
						<a href="{{ url('/vote/unhappy') }}" role="button" class="btn btn-danger btn-group-lg">Unhappy :-(</a>
						<a href="{{ url('/vote/unemotional') }}" role="button" class="btn btn-secondary btn-group-lg">Unemotional :-|</a>
						<a href="{{ url('/vote/happy') }}" role="button" class="btn btn-success btn-group-lg">Happy :-)</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
