<?php

namespace ctf\Models;


class Scoreboard
{

    private $nome;
    private $score;
    private $avatar;

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