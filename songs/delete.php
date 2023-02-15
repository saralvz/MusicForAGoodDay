<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../class/Songs.php';

$database = new Database();
$db = $database->getConnection();

$songs = new Songs($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)) {
	$songs->id = $data->id;
	if($songs->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "Song was deleted."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to delete Song."));
	}
} else {
	http_response_code(400);    
  echo json_encode(array("message" => "Unable to delete songs. Data is incomplete."));
}
?>