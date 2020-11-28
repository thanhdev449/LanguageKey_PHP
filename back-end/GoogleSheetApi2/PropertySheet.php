<?php

require  './HandleGoogleSheepAPi.php';
require  './db/db_connect.php';

class PropertySheet extends HandleGoogleSheepAPi {
    private $sheetId = 1184084367;
    private $positionSheet = "Master";
    private $query_d_property = 'SELECT
    dprop.property_id,
    dprop.project_id,
    dprop.area_num_id,
    dprop.open_type,
    dprop.start_time,
    dprop.grand_shop_id,
    mbr.brand_name,
    dprop.contracts_flag,
    dprop.brand_category,
    dprop.link_text,
    dprop.link_url,
    dprop.sale_icon_category,
    dprop.partition_name,
    dprop.project_no,
    dprop.property_no,
    dprop.property_text,
    dprop.keyword,
    dprop.price,
    dprop.trade_type,
    dprop.style_text,
    dprop.floor_plan,
    dprop.site_area,
    dprop.check_setback_area,
    dprop.setback_area,
    dprop.floor_area,
    dprop.b1f_area,
    dprop.1f_area,
    dprop.2f_area,
    dprop.3f_area,
    dprop.pf_area,
    dprop.address1,
    dprop.address2,
    dprop.category_id1,
    dprop.line_id1,
    dprop.station_id1,
    dprop.time1,
    dprop.category_id2,
    dprop.line_id2,
    dprop.station_id2,
    dprop.time2,
    dprop.category_id3,
    dprop.line_id3,
    dprop.station_id3,
    dprop.time3,
    dprop.elem_school,
    dprop.junior_high_school,
    dprop.driveway,
    dprop.structure,
    dprop.land_category,
    dprop.use_district,
    dprop.use_district_others,
    dprop.buil_coverage,
    dprop.vol_coverage,
    dprop.check,
    dprop.device_memo,
    dprop.road_memo,
    dprop.comp_date_memo,
    dprop.in_date,
    dprop.loan_bank,
    dprop.dev_area,
    dprop.dev_number,
    dprop.exp_date_memo,
    dprop.remarks,
    dprop.mainimage,
    dprop.floor_map,
    dprop.floor_map_txt,
    dprop.reason,
    dprop.project_id1,
    dprop.property_id1,
    dprop.project_id2,
    dprop.property_id2,
    dprop.project_id3,
    dprop.property_id3,
    dprop.floor_plan_file,
    dprop.floor_plan_file_del,
    dprop.perth_file,
    dprop.perth_file_del,
    dprop.equipment_file,
    dprop.equipment_file_del,
    dprop.sample_file,
    dprop.sample_file_del,
    dprop.alert_flg,
    dprop.upd_flg,
    dprop.del,
    dprop.upd,
    dprop.class_id1,
    dprop.class_id2,
    dprop.class_id3,
    dprop.disp_num,
    dprop.alert_send_date,
    rfac.infra_memo,
    rfac.infra_memo2,
    rfac.latitude,
    rfac.longitude,
    mar01.area01_name,
    mar02.area02_name,
    CONCAT(IF(INSTR(mar01.area01_name,"名古屋")>0,SUBSTRING(mar01.area01_name,1,4),""),mar02.area02_name,"　",dproj.project_name)AS project_name
    FROM d_project AS dproj
    INNER JOIN (
            SELECT `project_id`, MAX(`rev_id`) AS max_rev_id
            FROM d_project
            WHERE `del`=0 AND `flow_status` = 20
            GROUP BY `project_id` ) AS damy
        ON dproj.`project_id`=damy.`project_id`
        AND dproj.`rev_id`=damy.`max_rev_id`
    INNER JOIN m_area01 as mar01
    ON mar01.area01_id = dproj.area01_id
    INNER JOIN m_area02 as mar02
    ON mar02.area02_id = dproj.area02_id
    INNER JOIN d_property AS dprop
    ON dproj.project_id = dprop.project_id
    INNER JOIN m_brand AS mbr
    ON mbr.brand_id = dprop.brand_id
    AND mbr.grand_shop_id = dprop.grand_shop_id
    INNER JOIN m_grand_shop AS mgs
    ON dprop.grand_shop_id = mgs.grand_shop_id
    INNER JOIN r_facility AS rfac
    ON dprop.property_id = rfac.property_id
    AND rfac.project_id = dproj.project_id
    AND rfac.class_id = 2 
    AND rfac.del = 0
    WHERE dprop.brand_category IN (10,11,12,20,30,40)
        AND dprop.start_time <= NOW()
        AND dproj.`del`=0 AND dprop.`del`=0
        AND dproj.disp_flag = 1
        AND (dproj.flow_status = 20 OR dproj.rev_id > 1)        
        AND dprop.open_type = 1
        AND dprop.brand_id=1
        AND dprop.grand_shop_id=2
        AND dproj.grand_shop_id IN (2,1000000107,1000000089,1000000051,1000000059,1000000006,7)
        AND dproj.disp_date <= NOW() 
        AND dproj.`wf_public` = 1  
        ORDER BY dproj.upd DESC, dproj.`project_id`';

    public function __construct()
    {
        $this->clearDataFromSheet($this->sheetId);
    }

    public function fGetFeatureOfPropertyDetail($property_id){
		$feature_str = '';
		$sql = '
		SELECT 
			mfea.feature_id,
			mfea.feature_type,
			mfea.feature_name
		FROM r_feature AS rfea 
		INNER JOIN (
			SELECT `class_id`, `property_id`, MAX(`rev_id`) AS max_rev_id 
			FROM r_feature 
			WHERE `del`=0
			AND `class_id`="'.intval(1).'"
			AND `property_id`="'.intval($property_id).'"
			GROUP BY `property_id` ) AS damy
		ON rfea.`class_id`=damy.`class_id`
		AND rfea.`property_id`=damy.`property_id`
		AND rfea.`rev_id`=damy.`max_rev_id`
		INNER JOIN m_feature AS mfea
		ON rfea.feature_type = mfea.feature_type
		AND rfea.feature_id = mfea.feature_id
		WHERE rfea.`property_id`="'.intval($property_id).'"
		AND rfea.`class_id`="'.intval(1).'"
		AND rfea.`del`=0';
        $obj = DB::getInstance()->query($sql);
        $a_data_res = $obj->fetchAll();
		foreach($a_data_res as $key => $value){
            $feature_str .= "\n".$value['feature_name'];
        }
		return $feature_str;
    }
    
    public function setNameBrandCategory($brand_id){
        $brand_name = '';
        switch ($brand_id) {
            case 10:
                $brand_name = "新築分譲";
                break;
            case 11:
                $brand_name = "建築土地分譲";
                break;
            case 12:
                $brand_name = "土地分譲";
                break;
            case 40:
                $brand_name = "仲介物件";
                break;
            default:
                $brand_name = "";
                break;
        }
        return $brand_name;
    }

    public function fGetArea03nameById($arr_id){
        $str_content = "";
        $sql = '
        SELECT
            area03.area03_name
        FROM m_area03 AS area03
        WHERE area03.area03_id = '.($arr_id).' 
        AND area03.del=0';
        $obj = DB::getInstance()->query($sql);
        $a_data_res = $obj->fetchAll();
        foreach($a_data_res as $key => $value){
            $str_content .= "\n".$value['area03_name'];
        }
        return $str_content;
    }

    public function getLineName($category_id,$line_id){
        $line_name = "";
        $sql = '
        SELECT msl.line_name 
        FROM  m_station_line AS msl
        WHERE msl.category_id = '.$category_id.'
        AND msl.line_id = '.$line_id;
        $obj = DB::getInstance()->query($sql);
        $a_data_res = $obj->fetchAll();
        foreach($a_data_res as $key => $value){
            $line_name .= "\n".$value['line_name'];
        }
        return  $line_name;
    }


    public function getStationName($category_id,$line_id,$station_id){
        $station_name = "";
        $sql = '
        SELECT mst.station_name 
        FROM  m_station_name AS mst
        WHERE mst.category_id = '.$category_id.'
        AND mst.line_id = '.$line_id.'
        AND mst.station_id = '.$station_id;
        $obj = DB::getInstance()->query($sql);
        $a_data_res = $obj->fetchAll();
        foreach($a_data_res as $key => $value){
            $station_name .= "\n".$value['station_name'];
        }
        return  $station_name;
    }

    public function UploadDataToGoogleSheet(){
        $a_title = array();
        $a_title[] = $this->uploadTitleOfProperty();
        $this->insertDataToGoogleSheet($a_title,$this->positionSheet);
        $db = DB::getInstance();
        $req = $db->query($this->query_d_property);
        $a_data = $req->fetchAll();
        $a_data_sum = array();
        $infra_memo = "";
        $infra_memo2 = "";
        $str_feature = "";
        foreach ($a_data as $key => $value) {
            $infra_memo = $value['infra_memo'] == null ? '' : $value['infra_memo'];
            $infra_memo2 = $value['infra_memo2'] == null ? '' : $value['infra_memo2'];
            $str_feature = $this->fGetFeatureOfPropertyDetail($value['property_id']);
            $a_data_one = array (
                $value['property_id'] == null ? '' : $value['property_id'],
                $value['project_id'] == null ? '' : $value['project_id'],
                $value['project_name'] == null ? '' : $value['project_name'],
                $value['area01_name'] == null ? '' : $value['area01_name'],
                $value['area02_name'] == null ? '' : $value['area02_name'],
                $value['area_num_id'] == null ? '' : $value['area_num_id'],
                $value['open_type'] == null ? '' : $value['open_type'],
                $value['start_time'] == null ? '' : $value['start_time'],
                $value['grand_shop_id'] == null ? '' : $value['grand_shop_id'],
                $value['brand_name'] == null ? '' : $value['brand_name'],
                $value['contracts_flag'] == null ? '' : $value['contracts_flag'],
                $value['brand_category'] == null ? '' : $this->setNameBrandCategory($value['brand_category']),
                $value['link_text'] == null ? '' : $value['link_text'],
                $value['link_url'] == null ? '' : $value['link_url'],
                $value['sale_icon_category'] == null ? '' : $value['sale_icon_category'],
                $value['partition_name'] == null ? '' : $value['partition_name'],
                $value['project_no'] == null ? '' : $value['project_no'],
                $value['property_no'] == null ? '' : $value['property_no'],
                $value['property_text'] == null ? '' : $value['property_text'],
                $value['keyword'] == null ? '' : $value['keyword'],
                $value['price'] == null ? '' : $value['price'],
                $value['trade_type'] == null ? '' : $value['trade_type'],
                $value['style_text'] == null ? '' : $value['style_text'],
                $value['floor_plan'] == null ? '' : $value['floor_plan'],
                $value['site_area'] == null ? '' : $value['site_area'],
                $value['check_setback_area'] == null ? '' : $value['check_setback_area'],
                $value['setback_area'] == null ? '' : $value['setback_area'],
                $value['floor_area'] == null ? '' : $value['floor_area'],
                $value['b1f_area'] == null ? '' : $value['b1f_area'],
                $value['1f_area'] == null ? '' : $value['1f_area'],
                $value['2f_area'] == null ? '' : $value['2f_area'],
                $value['3f_area'] == null ? '' : $value['3f_area'],
                $value['pf_area'] == null ? '' : $value['pf_area'],
                $value['address1'] == null ? '' : $value['address1'],
                $value['address2'] == null ? '' : $value['address2'],
                $value['category_id1'] == null ? '' : $value['category_id1'],
                $value['line_id1'] == null ? '' : $this->getLineName($value['category_id1'],$value['line_id1']),
                $value['station_id1'] == null ? '' : $this->getStationName($value['category_id1'],$value['line_id1'],$value['station_id1']),
                $value['time1'] == null ? '' : $value['time1'],
                $value['category_id2'] == null ? '' : $value['category_id2'],
                $value['line_id2'] == null ? '' : $this->getLineName($value['category_id2'],$value['line_id2']),
                $value['station_id2'] == null ? '' : $this->getStationName($value['category_id2'],$value['line_id2'],$value['station_id2']),
                $value['time2'] == null ? '' : $value['time2'],
                $value['category_id3'] == null ? '' : $value['category_id3'],
                $value['line_id3'] == null ? '' : $this->getLineName($value['category_id3'],$value['line_id3']),
                $value['station_id3'] == null ? '' : $this->getStationName($value['category_id3'],$value['line_id3'],$value['station_id3']),
                $value['time3'] == null ? '' : $value['time3'],
                $value['elem_school'] == null ? '' : $this->fGetArea03nameById($value['elem_school']),
                $value['junior_high_school'] == null ? '' : $this->fGetArea03nameById($value['junior_high_school']),
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
                $value['dev_area'] == null ? '' : $value['dev_area'],
                $value['dev_number'] == null ? '' : $value['dev_number'],
                $value['exp_date_memo'] == null ? '' : $value['exp_date_memo'],
                $value['remarks'] == null ? '' : $value['remarks'],
                $value['mainimage'] == null ? '' : $value['mainimage'],
                $value['floor_map'] == null ? '' : $value['floor_map'],
                $value['floor_map_txt'] == null ? '' : $value['floor_map_txt'],
                $value['reason'] == null ? '' : $value['reason'],
                $value['project_id1'] == null ? '' : $value['project_id1'],
                $value['property_id1'] == null ? '' : $value['property_id1'],
                $value['project_id2'] == null ? '' : $value['project_id2'],
                $value['property_id2'] == null ? '' : $value['property_id2'],
                $value['project_id3'] == null ? '' : $value['project_id3'],
                $value['property_id3'] == null ? '' : $value['property_id3'],
                $value['floor_plan_file'] == null ? '' : $value['floor_plan_file'],
                $value['floor_plan_file_del'] == null ? '' : $value['floor_plan_file_del'],
                $value['perth_file'] == null ? '' : $value['perth_file'],
                $value['perth_file_del'] == null ? '' : $value['perth_file_del'],
                $value['equipment_file'] == null ? '' : $value['equipment_file'],
                $value['equipment_file_del'] == null ? '' : $value['equipment_file_del'],
                $value['sample_file'] == null ? '' : $value['sample_file'],
                $value['sample_file_del'] == null ? '' : $value['sample_file_del'],
                $value['alert_flg'] == null ? '' : $value['alert_flg'],
                $value['upd_flg'] == null ? '' : $value['upd_flg'],
                $value['del'] == null ? '' : $value['del'],
                $value['upd'] == null ? '' : $value['upd'],
                $value['class_id1'] == null ? '' : $value['class_id1'],
                $value['class_id2'] == null ? '' : $value['class_id2'],
                $value['class_id3'] == null ? '' : $value['class_id3'],
                $value['disp_num'] == null ? '' : $value['disp_num'],
                $value['alert_send_date'] == null ? '' : $value['alert_send_date'],
                $infra_memo."\n".$infra_memo2,
                strpos($value['comp_date_memo'],'完成済') == false ? 0 : 1,
                'https://woodfriends.jp/property/detail.php?proj_id='.$value['project_id'].'&prop_id='.$value['property_id'],
                "https://www.sumi-kae.net/common/property/data/image/".$value['mainimage'],
                $value['longitude'] == null ? '' : $value['longitude'],
                $value['latitude'] == null ? '' : $value['latitude'],
                strpos($str_feature,'駅徒歩15分以内') == false ? 0 : 1,
                strpos($str_feature,'駅徒歩5分以内') == false ? 0 : 1,
                strpos($str_feature,'小学校徒歩10分以内') == false ? 0 : 1,
                strpos($str_feature,'中学校徒歩10分以内') == false ? 0 : 1,
                strpos($str_feature,'保育園・幼稚園徒歩10分以内') == false ? 0 : 1,
                strpos($str_feature,'スーパー徒歩10分以内') == false ? 0 : 1,
                strpos($str_feature,'コンビニ徒歩5分以内') == false ? 0 : 1,
                strpos($str_feature,'角地') == false ? 0 : 1,
                strpos($str_feature,'南向き') == false ? 0 : 1,
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
$property_table = new PropertySheet();
$property_table->UploadDataToGoogleSheet();

?>