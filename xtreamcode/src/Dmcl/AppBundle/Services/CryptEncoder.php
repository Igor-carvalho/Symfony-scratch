<?php

namespace Dmcl\AppBundle\Services;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * Description of CryptEncoder
 *
 * @author softwarega@nauta.cu
 */
class CryptEncoder implements PasswordEncoderInterface
{
    public function encodePassword($password, $salt = "xtreamcodes", $rounds = 20000)
    {
        if ($salt == ""){
            $salt = substr(bin2hex(openssl_random_pseudo_bytes(16)),0,16);
        }

        $hash = crypt($password, sprintf('$6$rounds=%d$%s$', $rounds, $salt));
        
        return $hash;
    }
 
    public function isPasswordValid($encoded, $password, $salt)
    {
        return $encoded === $this->encodePassword($password, "xtreamcodes");
    }

}
