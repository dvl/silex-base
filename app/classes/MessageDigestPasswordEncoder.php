<?php

namespace Classes;

use \Symfony\Component\Security\Core\Encoder as Enc;

class MessageDigestPasswordEncoder extends Enc\BasePasswordEncoder
{
    private $algorithm;
    private $encodeHashAsBase64;
    private $iterations;

    /**
     * Constructor.
     *
     * @param string  $algorithm          The digest algorithm to use
     * @param Boolean $encodeHashAsBase64 Whether to base64 encode the password hash
     * @param integer $iterations         The number of iterations to use to stretch the password hash
     */
    public function __construct($algorithm = 'sha512', $encodeHashAsBase64 = true, $iterations = 5000)
    {
        $this->algorithm = $algorithm;
        $this->encodeHashAsBase64 = $encodeHashAsBase64;
        $this->iterations = $iterations;
    }

    /**
     * {@inheritdoc}
     */
    public function encodePassword($raw, $salt)
    {
        die('bvcv');
        if (!in_array($this->algorithm, hash_algos(), true)) {
            throw new \LogicException(sprintf('The algorithm "%s" is not supported.', $this->algorithm));
        }

        $digest = hash($this->algorithm, $raw);

        return strtoupper($digest);
    }

    /**
     * {@inheritdoc}
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $this->comparePasswords($encoded, $this->encodePassword($raw, $salt));
    }
}
