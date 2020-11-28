<?php
require 'vendor/google/apiclient/src/Google/autoload.php'; 
require 'vendor/google/apiclient/src/Google/Client.php';

class HandleGoogleSheepAPi {
    protected $spreadsheetId = '1t8yx5A31AxFWSyXPddgF1-xLTkVVbLmFbcMvYuKs6pU';
    private   $client_id = '643429703884-563rg4htnn3kr4bmapd5hgpnddngnnec.apps.googleusercontent.com';
    private   $client_secret = 'YO0pbCFp_uWE2WTlPVJsGjFY';
    private   $redirect_uri = 'urn:ietf:wg:oauth:2.0:oob';
    private   $auth_code = '4/3QF55pIE8z5QYcUktyGdciHyh-iSkVT_WCO4KLE0MNqqfl79VYfKwfg';

    function __construct(){
        if (php_sapi_name() != 'cli') {
            throw new Exception('This application must be run on the command line.');
        }
    }

    function getClient()
    {
        $client = new Google_Client();
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setRedirectUri($this->redirect_uri);
        $client->addScope("https://www.googleapis.com/auth/spreadsheets");
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $accessToken = '';
        $service = new Google_Service_Sheets($client);
        if ($client->authenticate($this->auth_code)) {
            $accessToken = $client->getAccessToken();
        }
        if ($accessToken != '') {
            $client->setAccessToken($accessToken);
        }else{
            $authUrl = $client->createAuthUrl();
            `open '$authUrl'`;
            echo "\nPlease enter the auth code:\n";
            $authCode = trim(fgets(STDIN));
            $accessToken = $client->authenticate($authCode);
            $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . '.accessToken';
            file_put_contents($file, $accessToken);
        }
        return $client;
        // $client = new \Google_Client();
        // $client->setApplicationName('Google Sheets API PHP Quickstart');
        // $client->setScopes(array(\Google_Service_Sheets::SPREADSHEETS));
        // $client->setAuthConfig(file_get_contents(__DIR__.'/credentials.json'));
        // $client->setAccessType('offline');
        // $client->setPrompt('select_account consent');
    }

    function readDataFromGoogleSheet($service,$rangeRead)
    {
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

    function uploadTitleOfProject()
    {
        $title = array(
            'project_id',
            'rev_id',
            'disp_date',
            'grand_shop_id',
            'shop_id',
            'area01_name',
            'area02_name',
            'project_name',
            'project_memo',
            'area_num',
            'project_no',
            'main_image',
            'area_image',
            'address',
            'category_id1',
            'line_id1',
            'station_id1',
            'time1',
            'category_id2',
            'line_id2',
            'station_id2',
            'time2',
            'category_id3',
            'line_id3',
            'station_id3',
            'time3',
            'elem_school',
            'junior_high_school',
            'driveway',
            'structure',
            'land_category',
            'use_district',
            'use_district_others',
            'buil_coverage',
            'vol_coverage',
            'check',
            'device_memo',
            'road_memo',
            'comp_date_memo',
            'in_date',
            'loan_bank',
            'remarks',
            'reason',
            'disp_flag',
            'save_flag',
            'flow_back',
            'flow_delete',
            'flow_status',
            'recog_memo',
            'entry_grand_shop_id',
            'entry_shop_id',
            'entry_mus_id',
            'rec_grand_shop_id',
            'rec_shop_id',
            'rec_mus_id',
            'entry_time',
            'rec_time',
            'del',
            'upd'
        );
        return $title;
    }

    function uploadTitleOfProperty()
    {
        $title = array(
            'property_id',
            'project_id',
            'project_name',
            'area01_name',
            'area02_name',
            'area_num_id',
            'open_type',
            'start_time',
            'grand_shop_id',
            'brand_name',
            'contracts_flag',
            'brand_category',
            'link_text',
            'link_url',
            'sale_icon_category',
            'partition_name',
            'project_no',
            'property_no',
            'property_text',
            'keyword',
            'price',
            'trade_type',
            'style_text',
            'floor_plan',
            'site_area',
            'check_setback_area',
            'setback_area',
            'floor_area',
            'b1f_area',
            '1f_area',
            '2f_area',
            '3f_area',
            'pf_area',
            'address1',
            'address2',
            'category_id1',
            'line_name1',
            'station_name1',
            'time1',
            'category_id2',
            'line_name2',
            'station_name2',
            'time2',
            'category_id3',
            'line_name3',
            'station_name3',
            'time3',
            'elem_school',
            'junior_high_school',
            'driveway',
            'structure',
            'land_category',
            'use_district',
            'use_district_others',
            'buil_coverage',
            'vol_coverage',
            'check',
            'device_memo',
            'road_memo',
            'comp_date_memo',
            'in_date',
            'loan_bank',
            'dev_area',
            'dev_number',
            'exp_date_memo',
            'remarks',
            'mainimage',
            'floor_map',
            'floor_map_txt',
            'reason',
            'project_id1',
            'property_id1',
            'project_id2',
            'property_id2',
            'project_id3',
            'property_id3',
            'floor_plan_file',
            'floor_plan_file_del',
            'perth_file',
            'perth_file_del',
            'equipment_file',
            'equipment_file_del',
            'sample_file',
            'sample_file_del',
            'alert_flg',
            'upd_flg',
            'del',
            'upd',
            'class_id1',
            'class_id2',
            'class_id3',
            'disp_num',
            'alert_send_date',
            'train_line',
            'completed_flag',
            'property_detail',
            'url_main_photo',
            'longitude',
            'latitude',
            '駅徒歩15分以内',
            '駅徒歩5分以内',
            '小学校徒歩10分以内',
            '中学校徒歩10分以内',
            '保育園・幼稚園徒歩10分以内',
            'スーパー徒歩10分以内',
            'コンビニ徒歩5分以内',
            '角地',
            '南向き'
        );
        return $title;
    }

    function insertDataToGoogleSheet($data,$positionSheet)
    {
        $client = $this->getClient();
        $rangeInsert = $positionSheet;
        $service = new Google_Service_Sheets($client);
        $body = new \Google_Service_Sheets_ValueRange(array(
            'values' => $data
        ));
        $params = array(
            'valueInputOption' => 'RAW'
        );
        $insert = array(
            "insertDataOption" => "INSERT_ROWS"
        );
        $results = $service->spreadsheets_values->append(
            $this->spreadsheetId,
            $rangeInsert,
            $body,
            $params,
            $insert
        );
        return $results;
    }

    function clearDataFromSheet($sheetId)
    {
        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);
        $request = new \Google_Service_Sheets_UpdateCellsRequest(array(
            'updateCells' => array( 
                'range' => array(
                    'sheetId' => $sheetId 
                ),
                'fields' => "*" 
            )
        ));
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



