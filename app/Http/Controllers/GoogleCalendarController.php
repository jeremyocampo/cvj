<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Spatie\GoogleCalendar\GoogleCalendarServiceProvider;
use Spatie\GoogleCalendar;

class GoogleCalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function connect()
    {
            $client = GoogleCalendar::getClient();
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
    }

    public function store()
    {
        $client = GoogleCalendar::getClient();
        $authCode = request('code');
        // Load previously authorized credentials from a file.
        // $credentialsPath = storage_path('keys/client_secret_generated.json');--------------------------< i changed this
        $credentialsPath = storage_path('app\google-calendar\service-account-credentials.json');
        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        // Store the credentials to disk.
        if (!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0700, true);
        }
        file_put_contents($credentialsPath, json_encode($accessToken));
        return redirect('/google-calendar')->with('message', 'Credentials saved');
    }

    public function getResources()
    {
            // Get the authorized client object and fetch the resources.
            $client = GoogleCalendar::oauth();
            return GoogleCalendar::getResources($client);

    }

    public function getClient()
    {
            $client = new Google_Client();
                $client->setApplicationName(config('app.name'));
            $client->setScopes(Google_Service_Directory::CALENDAR_READONLY);
               $client->setAuthConfig(storage_path('keys/service-account-credentials_old.json'));
               $client->setAccessType('offline');
               return $client;
    }
    
    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    public function oauth()
    {
            $client = $this->getClient();
    
            // Load previously authorized credentials from a file.
            $credentialsPath = storage_path('keys/client_secret_generated.json');
            if (!file_exists($credentialsPath)) {
                return false;
            }
    
            $accessToken = json_decode(file_get_contents($credentialsPath), true);
            $client->setAccessToken($accessToken);
    
            // Refresh the token if it's expired.
            if ($client->isAccessTokenExpired()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
            }
            return $client;
    
     }

     function getResource($client)
    {
        $service = new Google_Service_Calendar($client);

        // On the user's calenda print the next 10 events .
        $calendarId = 'primary';
        $optParams = array(
        'maxResults' => 10,
        'orderBy' => 'startTime',
        'singleEvents' => true,
        'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();

        if (empty($events)) {
            print "No upcoming events found.\n";
        } else {
                print "Upcoming events:\n";
                foreach ($events as $event) {
                    $start = $event->start->dateTime;
                    if (empty($start)) {
                        $start = $event->start->date;
                    }
                    printf("%s (%s)\n", $event->getSummary(), $start);
            }
        }
    }

}
