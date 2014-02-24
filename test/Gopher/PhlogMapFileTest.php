<?php
namespace Gopher;

use Gopher\Exception\FileNotReadableException;

class PhlogMapFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Gopher\Exception\FileNotReadableException
     */
    public function testNonExistingFileThrowsException()
    {
        $phlogMapFile = new PhlogMapFile('foo-does-not-exist');
    }
}