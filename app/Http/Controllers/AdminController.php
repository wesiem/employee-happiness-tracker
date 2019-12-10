<?php

namespace App\Http\Controllers;

use App\Mood;
use App\Vote;
use Illuminate\Http\Request;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = date('Y-m-d H:m:s');

        // get all votes for today
        $votes_day = Vote::whereDate('datetime', date('Y-m-d'))
                        ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                        ->get();

        // get all votes for this week
        $start_of_week = (date('D') != 'Mon') ? date('Y-m-d 00:00:00', strtotime('last Monday')) : date('Y-m-d 00:00:00');
        $votes_week = Vote::whereBetween('datetime', [$start_of_week, $now])
                        ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                        ->get();

        // get all votes for this month
        $start_of_month = date('Y-m-01');
        $votes_month = Vote::whereBetween('datetime', [$start_of_month, $now])
                        ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                        ->get();

        // prepare statistics for day, week & month
        $statistics = new \stdClass();
        $statistics->day = $this->prepare_statistics($votes_day);
        $statistics->week = $this->prepare_statistics($votes_week);
        $statistics->month = $this->prepare_statistics($votes_month);

        return view('admin', [
            'statistics' => $statistics
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

        return $statistics;
    }
}
