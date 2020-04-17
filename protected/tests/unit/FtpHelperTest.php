<?php

/**
 * Class FtpHelperTest
 *
 * @author White Label
 */
class FtpHelperTest extends CDbTestCase
{
    function testGetListOfFilesWithSizes() {
        $array = FtpHelper::getListOfFilesWithSizes('user99', 'WhiteLabel');

        $this->assertTrue(count($array) > 0);
    }
}