<?php

namespace ctf\Models;


class Scoreboard
{

    private $nome;
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
     * @param mixed $teamId
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return Scoreboard
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
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
     * @return Scoreboard
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
     * @param mixed $nome
     * @return Scoreboard
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
}