<?php

namespace App\Users\Entity;

class User
{
    protected $id;

    protected $nom;

    protected $prenom;

    protected $apple;

    public function __construct($id, $nom, $prenom)
    {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setApple($apple)
    {
        $this->apple = $apple;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getApple()
    {
        return $this->apple;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['prenom'] = $this->prenom;
        $array['apple'] = $this->apple;

        return $array;
    }
}
