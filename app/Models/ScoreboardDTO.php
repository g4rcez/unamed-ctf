<?php

namespace ctf\Models;


class ScoreboardDTO
{

    private $name;
    private $score;
    private $avatar;
    private $lastChall;
    private $team;

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param $team
     * @return ScoreboardDTO
     */
    public function setTeam($team)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastChall()
    {
        return $this->lastChall;
    }

    /**
     * @param mixed $lastChall
     */
    public function setLastChall($lastChall)
    {
        $this->lastChall = $lastChall;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ScoreboardDTO
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     * @return ScoreboardDTO
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param $avatar
     * @return ScoreboardDTO
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
}