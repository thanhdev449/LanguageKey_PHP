<?php

include_once './HandleGoogleSheepAPi.php';
include_once './db/db_connect.php';

class ProjectSheet extends HandleGoogleSheepAPi {
    private $sheetId = 1087512596;
    private $positionSheet = "sheet2";

    public function __construct()
    {
        $this->clearDataFromSheet($this->sheetId);
    }

    public function UploadDataToGoogleSheet(){
        $a_title = $this->titleToGoogleSheet();
        $this->insertDataToGoogleSheet([$a_title],$this->positionSheet);
        $db = DB::getInstance();
        $req = $db->query($this->query_d_project);
        $a_data = $req->fetchAll();
        $a_data_res = array();
        foreach ($a_data as $key => $value) {
            $a_data_one = array();
            $a_data_one = [
                $value['id'],
                $value['full_name'],
                $value['user_name'],
                $value['email'],
                $value['password'],
                $value['birthday'] == null ? '' : $value['birthday'],
                $value['avatar'] == null ? '' : $value['avatar'],
                $value['address'] == null ? '' :  $value['address'],
                $value['country'] == null ? '' :  $value['country'],
                $value['score'] == null ? '' :  $value['score'],
                $value['words'] == null ? '' :  $value['words'],
                $value['level'] == null ? '' :  $value['level'],
                $value['api_token'] == null ? '' :  $value['api_token'],
                $value['subcriber'] == null ? '' :  $value['subcriber'],
                $value['follower'] == null ? '' :  $value['follower'],
                $value['role'] == null ? '' :  $value['role'],
                $value['is_deleted'] == null ? '' :  $value['is_deleted'],
                $value['created_at'] == null ? '' :  $value['created_at'],
                $value['updated_at'] == null ? '' :  $value['updated_at'],
            ];
            $a_data_res[] = $a_data_one;
        }
        $resultsInsert = $this->insertDataToGoogleSheet($a_data_res,$this->positionSheet);
        $rowsAdded = $resultsInsert->updates->updatedRows;
        if ($resultsInsert) {
            printf("Uploaded ".$rowsAdded. " rows done \n");
        }
    } 
}
$project_table = new ProjectSheet();
$project_table->UploadDataToGoogleSheet();
?>

