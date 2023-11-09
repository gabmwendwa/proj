<?php
require_once '/var/www/html/project/core/init.php';
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(!$country_page = Input::get('country')){
	echo json_encode(array("message"=>"You need to provide a country first."));
}
else {
	$country_page = strtolower($country_page);
	$country_page = ucfirst($country_page);
	
	$prf = new Project();
	$obj = new Project();
	$obid = ($obj->find('country_table', $country_page, 'country')) ? $obj->data()->id : "-1";

	$prfr = $prf->find_all('project_table', 'country_id', $obid);
	
	$read_arr = array();
	$read_arr['data'] = array();
	
	if($prfr) {
		foreach($prfr as $pr){
			$project_ref;$country;$implementing_office;$project_title;$grant_amount;$dates_from_gcf;
			$duration;$start_date;$end_date;$readiness_or_nap;$first_disbursement_amount;$type_of_readiness;$status;
			if($obj->find('project_ref_table', $pr->project_ref_id)){
				$project_ref = $obj->data()->project_ref;
				$project_title = $obj->data()->project_title;
				$grant_amount = $obj->data()->grant_amount;
				$dates_from_gcf = $obj->data()->dates_from_gcf;
				$duration = $obj->data()->duration;
				$start_date = $obj->data()->start_date;
				$end_date = $obj->data()->end_date;
				$first_disbursement_amount = $obj->data()->first_disbursement_amount;
				
			}						
			if($obj->find('country_table', $pr->country_id)) {
				$country = $obj->data()->country;
			}
			if($obj->find('implementing_office_table', $pr->implementing_office_id)) {
				$implementing_office = $obj->data()->implementing_office;
			}
			if($obj->find('readiness_or_nap_table', $pr->readiness_or_nap_id)) {
				$readiness_or_nap = $obj->data()->readiness_or_nap;
			}
			if($obj->find('type_of_readiness_table', $pr->type_of_readiness_id)) {
				$type_of_readiness = $obj->data()->type_of_readiness;
			}
			if($obj->find('status_table', $pr->status_id)) {
				$status = $obj->data()->status;
			}

			$item = array(
				'project_ref' => $project_ref,
				'country' => $country,
				'implementing_office' => $implementing_office,
				'project_title' => $project_title,
				'grant_amount' => $grant_amount,
				'dates_from_gcf' => $dates_from_gcf,
				'start_date' => $start_date,
				'duration' => $duration,
				'end_date' => $end_date,
				'readiness_or_nap' => $readiness_or_nap,
				'type_of_readiness' => $type_of_readiness,
				'first_disbursement_amount' => $first_disbursement_amount,
				'status' => $status
			);
			
			// Push Data
			array_push($read_arr['data'], $item);
		}
		//convert to json and output
		echo json_encode($read_arr);
	}
	else {
		// No data
		echo json_encode(array("message"=>"No data."));
	}
}
?>