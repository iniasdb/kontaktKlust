<?php

class Task {
    private $title;
    private $desc;
    private $points;
    private $dateAdded;

    function __construct($title, $desc, $points) {
        $this->title = $title;
        $this->desc = $desc;
        $this->points = $points;
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