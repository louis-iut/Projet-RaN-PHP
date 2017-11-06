<?php

namespace App\Associations\Entity;

class UserAppleAssociation
{
    protected $id;

    protected $userId;

    protected $appleId;

    public function __construct($id, $userId, $appleId)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->appleId = $appleId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setAppleId($appleId)
    {
        $this->appleId = $appleId;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getAppleId()
    {
        return $this->appleId;
    }
    public function getUserId()
    {
        return $this->userId;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['user_id'] = $this->userId;
        $array['apple_id'] = $this->appleId;

        return $array;
    }
}