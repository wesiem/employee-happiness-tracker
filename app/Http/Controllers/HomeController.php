<?php

namespace App\Http\Controllers;

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
                return redirect('thank-you');

            default:
                return redirect('');
                break;
        }
    }

    /**
     * Thank you page
     */
    public function thank_you()
    {
        return view('thank_you');
    }
}
