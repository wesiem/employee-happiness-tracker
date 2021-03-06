<?php

namespace App\Http\Controllers;

use App\Mood;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $api_token = Auth::user()->api_token;

        return view('statistics.main', [
            'api_token' => $api_token
        ]);
    }

    /**
     * Statistics day view
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function day()
    {
        $data = $this->get_statistics_data("day");

        return view('statistics.details', [
            'title' => 'today',
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
        $data = $this->get_statistics_data("week");

        return view('statistics.details', [
            'title' => 'this week',
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
        $data = $this->get_statistics_data("month");

        return view('statistics.details', [
            'title' => 'this month',
            'data' => $data
        ]);
    }

    /**
     * Gets statistics data based on the requested period
     */
    private function get_statistics_data($period = false)
    {
        $data = new \stdClass();

        if ($period == "day") {
            // get all votes for today
            $votes = Vote::whereDate('datetime', date('Y-m-d'))
                            ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                            ->get();

            // prepare statistics for day, week & month
            $data = $this->prepare_statistics($votes);
        } else if ($period == "week") {
            // get all votes for this week
            $start_of_week = (date('D') != 'Mon') ? date('Y-m-d 00:00:00', strtotime('last Monday')) : date('Y-m-d 00:00:00');

            $now = date('Y-m-d H:m:s');

            $votes = Vote::whereBetween('datetime', [$start_of_week, $now])
                        ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                        ->get();

            // prepare statistics for day, week & month
            $data = $this->prepare_statistics($votes);
        } else if ($period == "month") {
            // get all votes for this month
            $start_of_month = date('Y-m-01');

            $now = date('Y-m-d H:m:s');

            $votes = Vote::whereBetween('datetime', [$start_of_month, $now])
                            ->leftJoin('moods', 'votes.mood_id', '=', 'moods.id')
                            ->get();

            // prepare statistics for day, week & month
            $data = $this->prepare_statistics($votes);
        }

        return $data;
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
        $statistics->average = "";

        // init percentages
        $statistics->happy_percent = 0;
        $statistics->unemotional_percent = 0;
        $statistics->unhappy_percent = 0;
        $statistics->average_percent = 0;

        // add total votes count
        $statistics->total = count($votes);

        // count all moods
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
        if ($statistics->total > 0) {
            $statistics->happy_percent = round(($statistics->happy / $statistics->total) * 100);
            $statistics->unemotional_percent = round(($statistics->unemotional / $statistics->total) * 100);
            $statistics->unhappy_percent = round(($statistics->unhappy / $statistics->total) * 100);

            // find the mood with the most votes
            $statistics->average_percent = max($statistics->happy_percent, $statistics->unemotional_percent, $statistics->unhappy_percent);

            switch ($statistics->average_percent) {
                case $statistics->happy_percent:
                    $statistics->average = "happy";
                    break;
                case $statistics->unemotional_percent:
                    $statistics->average = "unemotional";
                    break;
                case $statistics->unhappy_percent:
                    $statistics->average = "unhappy";
                    break;
            }
        }

        return $statistics;
    }

    /**
     * API Statistics day
     *
     * @return Statistics data
     */
    public function api_day()
    {
        $data = $this->get_statistics_data("day");

        return json_encode($data);
    }

    /**
     * API Statistics week
     *
     * @return Statistics data
     */
    public function api_week()
    {
        $data = $this->get_statistics_data("week");

        return json_encode($data);
    }

    /**
     * API Statistics month
     *
     * @return Statistics data
     */
    public function api_month()
    {
        $data = $this->get_statistics_data("month");

        return json_encode($data);
    }
}
