<?php

namespace App\Http\Controllers;

use App\Mood;
use App\Vote;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Statistics index page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('statistics');
    }

    /**
     * Statistics day view
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function day()
    {
        // get all votes for today
        $votes = Vote::whereDate('datetime', date('Y-m-d'))
                        ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                        ->get();

        // prepare statistics for day, week & month
        $data = $this->prepare_statistics($votes);

        return view('statistics_details', [
            'title' => 'Today',
            'data' => $data
        ]);
    }

    /**
     * Statistics week view
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function week()
    {
        // get all votes for this week
        $start_of_week = (date('D') != 'Mon') ? date('Y-m-d 00:00:00', strtotime('last Monday')) : date('Y-m-d 00:00:00');

        $now = date('Y-m-d H:m:s');

        $votes = Vote::whereBetween('datetime', [$start_of_week, $now])
                    ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                    ->get();

        // prepare statistics for day, week & month
        $data = $this->prepare_statistics($votes);

        return view('statistics_details', [
            'title' => 'This week',
            'data' => $data
        ]);
    }

    /**
     * Statistics month view
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function month()
    {   
        // get all votes for this month
        $start_of_month = date('Y-m-01');

        $now = date('Y-m-d H:m:s');

        $votes = Vote::whereBetween('datetime', [$start_of_month, $now])
                        ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                        ->get();

        // prepare statistics for day, week & month
        $data = $this->prepare_statistics($votes);

        return view('statistics_details', [
            'title' => 'This month',
            'data' => $data
        ]);
    }

    /**
     * Prepares and returns the statistics for the given votes
     *
     * @var Illuminate\Support\Collection $votes
     * @return statistics
     */
    private function prepare_statistics($votes)
    {
        $statistics = new \stdClass();

        // init variables
        $statistics->happy = 0;
        $statistics->unemotional = 0;
        $statistics->unhappy = 0;

        // init percentages
        $statistics->happy_percent = 0;
        $statistics->unemotional_percent = 0;
        $statistics->unhappy_percent = 0;

        // add total votes count
        $statistics->total = count($votes);

        foreach ($votes as $vote) {
            if ($vote->slug == "happy") {
                $statistics->happy++;
            } else if ($vote->slug == "unemotional") {
                $statistics->unemotional++;
            } else if ($vote->slug == "unhappy") {
                $statistics->unhappy++;
            }
        }

        // calculate percentages
        $statistics->happy_percent = round(($statistics->happy / $statistics->total) * 100);
        $statistics->unemotional_percent = round(($statistics->unemotional / $statistics->total) * 100);
        $statistics->unhappy_percent = round(($statistics->unhappy / $statistics->total) * 100);

        return $statistics;
    }
}