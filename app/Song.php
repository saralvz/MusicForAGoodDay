<?php

class Song{
    // public string $id;
    public string $name;
    public string $artist;
    public string $gender;
    public string $img;
    public string $youtube;
    // public string $coder;

    public function __construct(string $name, string $artist, string $gender, string $img, string $youtube)
    {
        // $this->id = $id;
        $this->name = $name;
        $this->artist = $artist;
        $this->gender = $gender;
        $this->img = $img;
        $this->youtube = $youtube;
        // $this->coder = $coder;
    }
}

$song = new Song ("Thank you, next", "Ariana Grande", "pop", "https://e00-elmundo.uecdn.es/assets/multimedia/imagenes/2018/11/06/15415072469377.jpg", "https://www.youtube.com/watch?v=gl1aHhXnN1k");





?>