<?php

/**
 * @author codegidi
 */
class AuthenticationTest extends PHPUnit_Framework_TestCase
{


    public function testIsThereAnySyntaxError()
    {
        $var = new GlobalPay\GlobalPay_Authentication;
        $this->assertTrue(is_object($var));
        unset($var);
    }

    public function testClient()
    {
        $var = new GlobalPay\GlobalPay_Authentication;
        $result = $var->Client("test_client", "secret");
        $this->assertTrue($result);
    }

}