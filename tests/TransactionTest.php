<?php

/**
 * @author codegidi
 */
class TransactionTest extends PHPUnit_Framework_TestCase
{


    public function testIsThereAnySyntaxError()
    {
        $var = new GlobalPay\GlobalPay_Authentication;
        $this->assertTrue(is_object($var));
        unset($var);
    }


}