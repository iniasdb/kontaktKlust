<?php

class Task {
    private $id;
    private $title;
    private $desc;
    private $points;
    private $dateAdded;

    function __construct($title, $desc, $points, $id = null, $dateAdded = null) {
        $this->title = $title;
        $this->desc = $desc;
        $this->points = $points;
        $this->id = $id;
        $this->dateAdded = $dateAdded;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getPoints() {
        return $this->points;
    }

    public function setPoints($points) {
        $this->points = $points;
    }

    public function getDateAdded() {
        return $this->dateAdded;
    }

    public function setDateAdded($dateAdded) {
        $this->dateAdded = $dateAdded;
    }

}

?>