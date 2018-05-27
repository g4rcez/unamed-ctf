<?php
/**
 * Created by PhpStorm.
 * User: garcez
 * Date: 4/28/18
 * Time: 2:09 AM
 */

namespace ctf\Models;


class UserTeam
{
    private $nickname;
    private $pontos;
    private $id;
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
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPontos()
    {
        return $this->pontos;
    }

    /**
     * @param mixed $pontos
     */
    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
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
     */
    public function setChallenges($challenges)
    {
        $this->challenges = $challenges;
        return $this;
    }

}