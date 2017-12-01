<?php

namespace ctf\Models;


class SecurityHash
{

    /**
     * @param $flag
     * @return string
     * Método de crypt com salt baseado nos arquivos de configuração
     * do projeto
     */
    public function hashFlag($flag)
    {
        return base64_encode($flag);
    }

    public function decodeFlag($flag){
        return base64_decode($flag);
    }

    public $pubkey = "AEEAEA";
    public $privkey = 'AEAEAEACSAASDAS';

    public function encrypt($data)
    {
        if (openssl_public_encrypt($data, $encrypted, $this->pubkey))
            return base64_encode($encrypted);
        else
            throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');
        return $data;
    }

    public function decrypt($data)
    {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->privkey))
            return $decrypted;
        return '';
    }

}