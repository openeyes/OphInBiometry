<?php

/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
class ApiController extends BaseApiController {
	public $services = array(
		'iol' => 'IOLService',
	);

	public function actionCreate() {

		$resource = $_GET['resource'];
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(404, $this->status_codes[404]);
		}
		$contents = file_get_contents("php://input");
		$json = json_decode($contents, true);



		if (!is_array($json)) {
			// error parsing json - 400 error:
			return $this->sendResponse(400, $this->status_codes[400]);
		}


		$results=OphiniolmasterIolreading::model()->findAll("iol_poll_id = '" . $json['iol_poll_id']."'");



		if(!empty($results)) {
		return $this->sendResponse(302,  $this->status_codes[302]);
		}



		$reading = new OphiniolmasterIolreading();
		//$reading->created_date=$json['created_date'];
		$reading->first_name=$json['first_name'];
		$reading->last_name=$json['last_name'];
		$reading->patient_id=$json['patient_id'];
		$reading->patients_birth_date=$json['patients_birth_date'];
		$reading->iol_poll_id=$json['iol_poll_id'];
		$reading->iol_machine_id=$json['iol_machine_id'];
		$reading->patient_id=(int)$json['patient_id'];

		$reading->data=Serialize($json);




		if ($reading->save()) {
			return $this->sendResponse(201, $this->status_codes[201]);
		} else {
			return $this->sendResponse(200, var_dump($reading->getErrors()));
		}
	}

	public function actionRead() {
		$resource = $_GET['resource'];
		$id = $_GET['id'];
		if (!$service = $this->getService($resource)) {
			return $this->sendResponse(400);
		}
		if ($resource_object = $service->findById($id)) {
			$fhirMarshal = new FhirMarshal();
			$data = $fhirMarshal->marshal($resource_object, 'json');
			return $this->sendResponse(200, (string) $data);
		} else {
			// TODO - deleted resources should return 410:
			return $this->sendResponse(404);
		}
	}


}
