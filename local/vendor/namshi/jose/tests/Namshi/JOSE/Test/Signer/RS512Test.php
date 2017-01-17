<?php

namespace Namshi\JOSE\Test\Signer;

use \PHPUnit_Framework_TestCase as TestCase;
use Namshi\JOSE\Signer\RS512;

class RS512Test extends TestCase
{
    public function setup()
    {
        $this->privateKey   = openssl_pkey_get_private(SSL_KEYS_PATH . "private.key", 'tests');
        $this->public       = openssl_pkey_get_public(SSL_KEYS_PATH . "public.key");
        $this->signer       = new RS512;
    }

    public function testVerificationWorksProperly()
    {
        $encrypted = $this->signer->sign('aaa', $this->privateKey);
        $this->assertInternalType('bool', $this->signer->verify($this->public, $encrypted, 'aaa'));
        $this->assertTrue($this->signer->verify($this->public, $encrypted, 'aaa'));
    }

    public function testSigningWorksProperly()
    {
        $this->assertInternalType('string', $this->signer->sign('aaa', $this->privateKey));
    }
}