<?php
require __DIR__ . '/vendor/autoload.php';

class HandleGoogleSheepAPi {
    private $spreadsheetId = '1m3BejSAZr0Ahsi9BDXRxcEacLqi8I8_4q8upmAG29vo';

    function __construct(){
        if (php_sapi_name() != 'cli') {
            throw new Exception('This application must be run on the command line.');
        }
    }

    function getClient()
    {
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig(__DIR__.'/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    function readDataFromGoogleSheet($service,$rangeRead){
        $response = $service->spreadsheets_values->get($this->spreadsheetId, $rangeRead);
        $values = $response->getValues();
        if (empty($values)) {
            print "No data found.\n";
        } else {
            print "Name, Major, address:\n";
            foreach ($values as $row) {
                printf("%s, %s, %s\n", $row[2],$row[1],$row[0]);
            }
        }
    }

    function writeDataToGoogleSheet($service,$rangeWrite){
        $data = [
            [
            '6',
            'nguyenvanB', 
            'nguyenvanB@gmail.com',
            'nhatrang13232131'
            ]
        ];
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => $data
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $results = $service->spreadsheets_values->update(
            $this->spreadsheetId,
            $rangeWrite,
            $body,
            $params
        );
    }
    
}

$googleSheet = new HandleGoogleSheepAPi();
$client = $googleSheet->getClient();
$service = new Google_Service_Sheets($client);
$rangeWrite = 'sheet1!A2:D2';
$googleSheet->writeDataToGoogleSheet($service,$rangeWrite);
$rangeRead = 'sheet1!B2:D9';
$googleSheet->readDataFromGoogleSheet($service,$rangeRead);


