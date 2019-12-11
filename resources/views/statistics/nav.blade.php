<div class="btn-group mb-2" role="group" aria-label="Statistics nav">
    @if (Route::is('statistics'))
        <a href="{{ url('/statistics') }}" role="button" class="btn btn-secondary btn-group-lg active">Main</a>
    @else
        <a href="{{ url('/statistics') }}" role="button" class="btn btn-secondary btn-group-lg">Main</a>
    @endif

    @if (Route::is('statistics_day'))
        <a href="{{ url('/statistics/day') }}" role="button" class="btn btn-secondary btn-group-lg active">Today</a>
    @else
        <a href="{{ url('/statistics/day') }}" role="button" class="btn btn-secondary btn-group-lg">Today</a>
    @endif

    @if (Route::is('statistics_week'))
        <a href="{{ url('/statistics/week') }}" role="button" class="btn btn-secondary btn-group-lg active">This week</a>
    @else
        <a href="{{ url('/statistics/week') }}" role="button" class="btn btn-secondary btn-group-lg">This week</a>
    @endif

    @if (Route::is('statistics_month'))
        <a href="{{ url('/statistics/month') }}" role="button" class="btn btn-secondary btn-group-lg active">This month</a>
    @else
        <a href="{{ url('/statistics/month') }}" role="button" class="btn btn-secondary btn-group-lg">This month</a>
    @endif
</div>