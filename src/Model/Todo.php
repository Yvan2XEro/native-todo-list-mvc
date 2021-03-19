<?php

namespace App\Model;

use App\Utils\CustomTools\ArrayTools;

class Todo extends AbstractEntity{

    public const UNFINISHED = 'UNFINISHED';
    public const FINISHED   = 'FINISHED';

    private $id;
    private $userId;
    private $title;
    private $statut=self::UNFINISHED;
    private $createdAt;

    public function __construct()
    {
        if(!$this->createdAt)
            $this->setCreatedAt(new \DateTime());
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        if($id)
            $this->id = $id;

        return $this;
    }

    public function completed():bool
    {
        return $this->statut == self::FINISHED;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        if($title)
            $this->title = $title;

        return $this;
    }

    /**
     * Get the value of statut
     * @return bool
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut(string $statut)
    {
        if($statut==self::FINISHED || $statut==self::UNFINISHED)
            $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId(int $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt->format('Y-m-d H:i:s');

        return $this;
    }

    public function normalize(bool $purged=false):array
    {
        $t =[];
        foreach ($this as $key => $value) {
            $t[$key]    = $value;
            if($key == 'statut' && null == $value)
                $t[$key]=0;
        }
        if(!$purged)
            return $t;
        return ArrayTools::purge($t);
    }

    public function toggleStatut():self
    {
        if($this->completed())
            return $this->setStatut(self::UNFINISHED);
        return $this->setStatut(self::FINISHED);
    }
}