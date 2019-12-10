<?php

namespace App\Http\Controllers;

use App\Mood;
use App\Vote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Vote anonymously
     */
    public function vote($voteslug)
    {
        switch ($voteslug) {
            case "happy":
            case "unemotional":
            case "unhappy":
                // get the id of the mood based on its slug
                $mood = Mood::where('slug', $voteslug)->get();
                $mood_id = $mood[0]->id;

                 // save vote
                if ($mood_id > 0) {
                    $mood = new Vote;
                    $mood->mood_id = $mood_id;
                    $mood->datetime = date("Y-m-d H:i:s");
                    $mood->save();

                    // NOTE: Here the vote could be verified to be sure it has been registered. But for now we'll leave it as it is.

                    // redirect to thank you page
                    return redirect('thank-you');
                }
        }

        // redirect to the homepage
        return redirect('');
    }

    /**
     * Thank you page
     */
    public function thank_you()
    {
        return view('thank_you');
    }
}
