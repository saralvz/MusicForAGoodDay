<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Songs.php';

$database = new Database();
$db = $database->getConnection();
 
$songs = new Songs($db);

$songs->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $songs->read();

if($result->num_rows > 0){    
    $songRecords=array();
    $songRecords["songs"]=array(); 
	while ($song = $result->fetch_assoc()) { 	
        extract($song); 
        $songDetails=array(
            "id" => $id,
            "songName" => $songName,
            "artistName" => $artistName,
			"songGender" => $songGender,
            "youtubeUrl" => $youtubeUrl,            
			"imgUrl" => $imgUrl,
            "listened" => $listened	,
            "users_id" => $users_id		
        ); 
       array_push($songRecords["songs"], $songDetails);
    }    
    http_response_code(200);     
    echo json_encode($songRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No song found.")
    );
} 