<?php
require __DIR__ . '/vendor/autoload.php';

class HandleGoogleSheepAPi {
    protected $spreadsheetId = '1m3BejSAZr0Ahsi9BDXRxcEacLqi8I8_4q8upmAG29vo';
    protected $query_d_project = 'SELECT * FROM creator_tables';

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

    function titleToGoogleSheet(){
        $title = array(
            "ID",
            "full_name",
            "user_name",
            "email",
            "password",
            "birthday",
            "avatar",
            "address",
            "country",
            "score",
            "words",
            "level",
            "api_token",
            "subcriber",
            "follower",
            "role",
            "is__deleted",
            "created_at",
            "updated_at"
        );
        return $title;
    }

    function insertDataToGoogleSheet($data,$positionSheet){
        $client = $this->getClient();
        $rangeInsert = $positionSheet;
        $service = new Google_Service_Sheets($client);
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => $data
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $results = $service->spreadsheets_values->append(
            $this->spreadsheetId,
            $rangeInsert,
            $body,
            $params,
            $insert
        );
        return $results;
    }

    function clearDataFromSheet($sheetId){
        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);
        $request = new \Google_Service_Sheets_UpdateCellsRequest([
            'updateCells' => [ 
                'range' => [
                    'sheetId' => $sheetId 
                ],
                'fields' => "*" 
            ]
          ]);
        $requests[] = $request;
        $requestBody = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest();
        $requestBody->setRequests($requests);
        $response = $service->spreadsheets->batchUpdate($this->spreadsheetId, $requestBody);
        if ($response) {
            printf("Clear data in sheet_id : ".$sheetId." successfully \n");
        }
        return $response;
    }
    
}



