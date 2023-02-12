<?php

include "./config/DatabaseTest.php";

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;


class SongsTestCreate extends TestCase
{
    private $songsTable = "songs";
    private $conn;

    public function testCreate()
    {
        $database = new DatabaseTest();

        $conn = $database->getConnection();

        $arrayIntro = [
            "songName" => "Respira",
            "artistName" => "Natalia Doco",
            "songGender" => "Pop",
            "youtubeUrl" => "https://music.youtube.com/watch?v=ax8QspqTVUo",
            "imgUrl" => "https://music.youtube.com/watch?v=ax8QspqTVUo",
            "listened" => 0,
            "users_id" => 1
        ];
        $stmt = $conn->prepare("
        INSERT INTO " . $this->songsTable . "(`songName`, `artistName`, `songGender`, `youtubeUrl`, `imgUrl`, `listened`, `users_id`)
        VALUES(?,?,?,?,?,?,?)");


        $stmt->bind_param(
            "sssssii",
            $arrayIntro['songName'],
            $arrayIntro['artistName'],
            $arrayIntro['songGender'],
            $arrayIntro['youtubeUrl'],
            $arrayIntro['imgUrl'],
            $arrayIntro['listened'],
            $arrayIntro['users_id']
        );


        $result = $stmt->execute();
        $this->assertTrue($result);
    }
}
