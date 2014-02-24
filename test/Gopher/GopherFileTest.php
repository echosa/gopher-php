<?php
namespace Gopher;

use Gopher\Exception\FileNotReadableException;

class GopherFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Gopher\Exception\FileNotReadableException
     */
    public function testNonExistingFileThrowsException()
    {
        $gopherFile = new GopherFile('foo-does-not-exist');
    }
}