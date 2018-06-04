<?php

namespace ctf\Models;

class UserTeamDTO
{
    private $id;
    private $points;
    private $nickname;
    private $challenges;

    public function __construct()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     * @return UserTeamDTO
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     * @return UserTeamDTO
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return UserTeamDTO
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChallenges()
    {
        return $this->challenges;
    }

    /**
     * @param mixed $challenges
     * @return UserTeamDTO
     */
    public function setChallenges($challenges)
    {
        $this->challenges = $challenges;
        return $this;
    }

}