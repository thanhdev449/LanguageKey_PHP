<?php

require  './HandleGoogleSheepAPi.php';
require  './db/db_connect.php';

class ProjectSheet extends HandleGoogleSheepAPi {
    private $sheetId = 1087512596;
    private $positionSheet = "d_project";
    private $query_d_project = 'SELECT
    res.*
FROM (SELECT
dproj.project_id,
    dproj.rev_id,
    dproj.disp_date,
    dproj.grand_shop_id,
    dproj.shop_id,
    mar01.area01_name,
    mar02.area02_name,
    dproj.project_name,
    dproj.project_memo,
    dproj.area_num,
    dproj.project_no,
    dproj.main_image,
    dproj.area_image,
    dproj.address,
    dproj.category_id1,
    dproj.line_id1,
    dproj.station_id1,
    dproj.time1,
    dproj.category_id2,
    dproj.line_id2,
    dproj.station_id2,
    dproj.time2,
    dproj.category_id3,
    dproj.line_id3,
    dproj.station_id3,
    dproj.time3,
    dproj.elem_school,
    dproj.junior_high_school,
    dproj.driveway,
    dproj.structure,
    dproj.land_category,
    dproj.use_district,
    dproj.use_district_others,
    dproj.buil_coverage,
    dproj.vol_coverage,
    dproj.check,
    dproj.device_memo,
    dproj.road_memo,
    dproj.comp_date_memo,
    dproj.in_date,
    dproj.loan_bank,
    dproj.remarks,
    dproj.reason,
    dproj.disp_flag,
    dproj.save_flag,
    dproj.flow_back,
    dproj.flow_delete,
    dproj.flow_status,
    dproj.recog_memo,
    dproj.entry_grand_shop_id,
    dproj.entry_shop_id,
    dproj.entry_mus_id,
    dproj.rec_grand_shop_id,
    dproj.rec_shop_id,
    dproj.rec_mus_id,
    dproj.entry_time,
    dproj.rec_time,
    dproj.del,
    dproj.upd

FROM d_project AS dproj
INNER JOIN (
        SELECT `project_id`, MAX(`rev_id`) AS max_rev_id
        FROM d_project
        WHERE `del`=0 AND `flow_status` = 20
        GROUP BY `project_id` ) AS damy
    ON dproj.`project_id`=damy.`project_id`
    AND dproj.`rev_id`=damy.`max_rev_id`INNER JOIN d_property AS dprop
  ON dproj.project_id = dprop.project_id INNER JOIN m_area01 AS mar01
  ON dproj.area01_id = mar01.area01_id
INNER JOIN m_area02 AS mar02
  ON dproj.area02_id = mar02.area02_id
INNER JOIN (
      SELECT project_id, max(price) AS MAX_PRICE, min(price) AS MIN_PRICE,
        max(site_area) AS MAX_SITE_AREA, min(site_area) AS MIN_SITE_AREA,
        max(floor_area) AS MAX_FLOOR_AREA, min(floor_area) AS MIN_FLOOR_AREA
      FROM d_property
      WHERE del = 0 AND open_type = 1 AND start_time <= NOW()
      GROUP BY project_id) AS prop_total
  ON dproj.project_id = prop_total.project_id
WHERE dprop.brand_id=1
    AND dprop.grand_shop_id=2  AND dprop.brand_category IN (10,11,12,20,30,40) AND dprop.start_time <= NOW()
    AND dproj.grand_shop_id IN (2,1000000107,1000000089,1000000051,1000000059,1000000006,7)
    AND dproj.`del`=0 AND dprop.`del`=0
    AND dproj.disp_flag = 1
    AND (dproj.flow_status = 20 OR dproj.rev_id > 1)
    AND dprop.open_type = 1
    AND dproj.disp_date <= NOW() AND dproj.`wf_public` = 1 GROUP BY dproj.`project_id`  ORDER BY dprop.brand_category ASC) AS res
';
    public function __construct()
    {
        $this->clearDataFromSheet($this->sheetId);
    }

    public function UploadDataToGoogleSheet(){
        $a_title = array();
        $a_title[] = $this->uploadTitleOfProject();
        $this->insertDataToGoogleSheet($a_title,$this->positionSheet);
        $db = DB::getInstance();
        $req = $db->query($this->query_d_project);
        $a_data = $req->fetchAll();
        $a_data_sum = array();
        foreach ($a_data as $key => $value) {
            $a_data_one = array(
                $value['project_id'] == null ? '' :  $value['project_id'],
                $value['rev_id'] == null ? '' : $value['rev_id'],
                $value['disp_date'] == null ? '' : $value['disp_date'],
                $value['grand_shop_id'] == null ? '' : $value['grand_shop_id'],
                $value['shop_id'] == null ? '' : $value['shop_id'],
                $value['area01_name'] == null ? '' : $value['area01_name'],
                $value['area02_name'] == null ? '' : $value['area02_name'],
                $value['project_name'] == null ? '' : $value['project_name'],
                $value['project_memo'] == null ? '' : $value['project_memo'],
                $value['area_num'] == null ? '' : $value['area_num'],
                $value['project_no'] == null ? '' : $value['project_no'],
                $value['main_image'] == null ? '' : $value['main_image'],
                $value['area_image'] == null ? '' : $value['area_image'],
                $value['address'] == null ? '' : $value['address'],
                $value['category_id1'] == null ? '' : $value['category_id1'],
                $value['line_id1'] == null ? '' : $value['line_id1'],
                $value['station_id1'] == null ? '' : $value['station_id1'],
                $value['time1'] == null ? '' : $value['time1'],
                $value['category_id2'] == null ? '' : $value['category_id2'],
                $value['line_id2'] == null ? '' : $value['line_id2'],
                $value['station_id2'] == null ? '' : $value['station_id2'],
                $value['time2'] == null ? '' : $value['time2'],
                $value['category_id3'] == null ? '' : $value['category_id3'],
                $value['line_id3'] == null ? '' : $value['line_id3'],
                $value['station_id3'] == null ? '' : $value['station_id3'],
                $value['time3'] == null ? '' : $value['time3'],
                $value['elem_school'] == null ? '' : $value['elem_school'],
                $value['junior_high_school'] == null ? '' : $value['junior_high_school'],
                $value['driveway'] == null ? '' : $value['driveway'],
                $value['structure'] == null ? '' : $value['structure'],
                $value['land_category'] == null ? '' : $value['land_category'],
                $value['use_district'] == null ? '' : $value['use_district'],
                $value['use_district_others'] == null ? '' : $value['use_district_others'],
                $value['buil_coverage'] == null ? '' : $value['buil_coverage'],
                $value['vol_coverage'] == null ? '' : $value['vol_coverage'],
                $value['check'] == null ? '' : $value['check'],
                $value['device_memo'] == null ? '' : $value['device_memo'],
                $value['road_memo'] == null ? '' : $value['road_memo'],
                $value['comp_date_memo'] == null ? '' : $value['comp_date_memo'],
                $value['in_date'] == null ? '' : $value['in_date'],
                $value['loan_bank'] == null ? '' : $value['loan_bank'],
                $value['remarks'] == null ? '' : $value['remarks'],
                $value['reason'] == null ? '' : $value['reason'],
                $value['disp_flag'] == null ? '' : $value['disp_flag'],
                $value['save_flag'] == null ? '' : $value['save_flag'],
                $value['flow_back'] == null ? '' : $value['flow_back'],
                $value['flow_delete'] == null ? '' : $value['flow_delete'],
                $value['flow_status'] == null ? '' : $value['flow_status'],
                $value['recog_memo'] == null ? '' : $value['recog_memo'],
                $value['entry_grand_shop_id'] == null ? '' : $value['entry_grand_shop_id'],
                $value['entry_shop_id'] == null ? '' : $value['entry_shop_id'],
                $value['entry_mus_id'] == null ? '' : $value['entry_mus_id'],
                $value['rec_grand_shop_id'] == null ? '' : $value['rec_grand_shop_id'],
                $value['rec_shop_id'] == null ? '' : $value['rec_shop_id'],
                $value['rec_mus_id'] == null ? '' : $value['rec_mus_id'],
                $value['entry_time'] == null ? '' : $value['entry_time'],
                $value['rec_time'] == null ? '' : $value['rec_time'],
                $value['del'] == null ? '' : $value['del'],
                $value['upd'] == null ? '' : $value['upd'],
            );
            $a_data_sum[] = $a_data_one;
        }
        $resultsInsert = $this->insertDataToGoogleSheet($a_data_sum,$this->positionSheet);
        $rowsAdded = $resultsInsert->updates->updatedRows;
        if ($resultsInsert) {
            printf("Uploaded ".$rowsAdded. " rows done \n");
        }
    } 
}
$project_table = new ProjectSheet();
$project_table->UploadDataToGoogleSheet();
?>

