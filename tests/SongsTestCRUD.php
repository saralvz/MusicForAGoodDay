<?php

include "./config/DatabaseTest.php";

use PHPUnit\Framework\TestCase;

class SongsTestCRUD extends TestCase
{
    private $songsTable = "songs";


    private $conn;

    public function setUp(): void
    {
        $database = new DatabaseTest();
        $this->conn = $database->getConnection();
    }


    public function testCreate()
    {


        $arrayIntro = [
            "songName" => "Respira",
            "artistName" => "Natalia Doco",
            "songGender" => "Pop",
            "youtubeUrl" => "https://music.youtube.com/watch?v=ax8QspqTVUo",
            "imgUrl" => "https://music.youtube.com/watch?v=ax8QspqTVUo",
            "listened" => 0,
            "users_id" => 1
        ];
        $stmt = $this->conn->prepare("
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

    public function testRead()
    {


        $query = "SELECT * FROM " . $this->songsTable . " WHERE songName='Respira'";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();

        $this->assertEquals("Respira", $row["songName"]);
        $this->assertEquals("Natalia Doco", $row["artistName"]);
        $this->assertEquals("Pop", $row["songGender"]);
        $this->assertEquals("https://music.youtube.com/watch?v=ax8QspqTVUo", $row["youtubeUrl"]);
        $this->assertEquals("https://music.youtube.com/watch?v=ax8QspqTVUo", $row["imgUrl"]);
        $this->assertEquals(0, $row["listened"]);
        $this->assertEquals(1, $row["users_id"]);
    }

    public function testUpdate()
    {


        $query = "UPDATE " . $this->songsTable . " SET listened=1 WHERE songName='Respira'";
        $result = $this->conn->query($query);
        $this->assertTrue($result);

        $query = "SELECT * FROM " . $this->songsTable . " WHERE songName='Respira'";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();

        $this->assertEquals("Respira", $row["songName"]);
        $this->assertEquals("Natalia Doco", $row["artistName"]);
        $this->assertEquals("Pop", $row["songGender"]);
        $this->assertEquals("https://music.youtube.com/watch?v=ax8QspqTVUo", $row["youtubeUrl"]);
        $this->assertEquals("https://music.youtube.com/watch?v=ax8QspqTVUo", $row["imgUrl"]);
        $this->assertEquals(1, $row["listened"]);
        $this->assertEquals(1, $row["users_id"]);
    }

    public function testDelete()
    {



        $query = "DELETE FROM " . $this->songsTable . " WHERE songName='Respira'";
        $result = $this->conn->query($query);
        $this->assertTrue($result);

        $query = "SELECT * FROM " . $this->songsTable . " WHERE songName='Respira'";
        $result = $this->conn->query($query);
        $this->assertEquals(0, $result->num_rows);
    }
}
