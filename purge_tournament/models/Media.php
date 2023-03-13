<?php

class Media {

    // Attributs

    private ?int $id;
    private string $description;
    private string $type;
    private string $format;
    private string $url;


    // Construct

    public function __construct(string $description, string $type, string $format, string $url) {

        $this->int = NULL;
        $this->description = $description;
        $this->type = $type;
        $this->format = $format;
        $this->url = $url;
    }

    // Getters

    public function getId() : ?int {
        return $this->id;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getType() : string {
        return $this->type;
    }

    public function getFormat() : string {
        return $this->format;
    }

    public function getUrl() : string {
        return $this->url;
    }

    // Setters

    public function setId(int $id) : voic {
        $this->id = $id;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function setType(string $type) : void {
        $this->type = $type;
    }

    public function setFormat(string $format) : void {
        $this->format = $format;
    }

    public function setUrl(string $url) : void {
        $this->url = $url;
    }

}