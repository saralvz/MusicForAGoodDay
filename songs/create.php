<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once './config/Database.php';
include_once './class/Songs.php';
 
$database = new Database();
$db = $database->getConnection();
 
$songs = new Songs($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->songName) && !empty($data->artistName) &&
!empty($data->songGender) && !empty($data->youtubeUrl) &&
!empty($data->imgUrl) && !empty($data->listened) && !empty($data->users_id)){    

    $songs->songName = $data->songName;
    $songs->artistName = $data->artistName;
    $songs->songGender = $data->songGender;
    $songs->youtubeUrl = $data->youtubeUrl;	
    $songs->imgUrl = $data->imgUrl; 
    $songs->listened = $data->listened;
    $songs->users_id = $data->users_id;
    
    if($songs->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Song has been created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create song."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create song. Data is incomplete."));
}
?>