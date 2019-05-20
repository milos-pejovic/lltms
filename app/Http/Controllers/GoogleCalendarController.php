<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_EventReminders;

class GoogleCalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setIncludeGrantedScopes(true);
        $client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEvent()
    {   
        session_start();   
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $data = \Session::get('data');
            $service = new Google_Service_Calendar($this->client);
            
            //TODO Finish creating event
            
            $event = new Google_Service_Calendar_Event();
            $event->setAttendees($data['email']);
            $event->setOriginalStartTime(new Google_Service_Calendar_EventDateTime());
            $event->setReminders(new Google_Service_Calendar_EventReminders());

            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event);
            
        } else {
            return redirect()->route('oauthCallback');
        }

    }

    public function oauth()
    {
        session_start();
        $rurl = action('GoogleCalendarController@oauth');
        $rurl = str_replace('http:', 'https:', $rurl);
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            return redirect()->route('cal');
        }
    }
}
