<?php

/**
 * Class FtpHelperTest
 *
 * @author White Label
 */
class FtpHelperTest extends CDbTestCase
{
    function testGetListOfFilesWithSizes() {
        $array = FtpHelper::getListOfFilesWithSizes('demo', 'password');

        $this->assertTrue(count($array) > 0);
    }
}
