<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Agent;
use App\Models\Compaign;
use App\Models\CompaignAgent;
use App\Models\CompaignAgentCustomer;
use Auth, Mail, Carbon\Carbon;
use App\Mail\SendMail;

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

    public function test_mail()
    {
        $testMailData = [
            'title' => 'Test Email From AllPHPTricks.com',
            'body' => 'This is the body of test email.'
        ];

        Mail::to('bazkhalidbaz.ak@gmail.com')->send(new SendMail($testMailData));

        dd('Success! Email has been sent successfully.');
    }

    public function index(Request $request)
    {

        return view('home');
    }

    public function agentDashboard()
    {
        $campaigns = CompaignAgent::where('agent_id', Auth::user()->agent->id)->where('status', 1)->get();
        $model = CompaignAgentCustomer::class;
        return view('agents.dashboard', compact('campaigns', 'model'));
    }
}
