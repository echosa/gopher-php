<?php
namespace Gopher;

class GopherItemTest extends \PHPUnit_Framework_TestCase
{
    private $_footerText = 'Continued...';

    public function testSettingFileUrl()
    {
        $filename = 'foo.txt';
        $item = new GopherItem('foo');
        $item->setFileUrl($filename);
        $this->assertEquals($filename, $item->getUrl());
        $this->assertEquals(GopherItem::FILE, $item->getUrlType());
    }

    public function testSettingDirectoryUrl()
    {
        $directory = 'foo';
        $item = new GopherItem('foo');
        $item->setDirectoryUrl($directory);
        $this->assertEquals($directory, $item->getUrl());
        $this->assertEquals(GopherItem::DIR, $item->getUrlType());
    }

    public function testPhlogHeaderIsProperlyIdentified()
    {
        $this->_assertIsPhlogHeader(new GopherItem('--Proper Header--'));
    }

    public function testPhlogHeaderWithoutEndingDashesIsWrong()
    {
        $this->_assertIsNotPhlogHeader(new GopherItem('--No Ending Dashes'));
    }

    public function testPhlogHeaderWithoutStartingDashesIsWrong()
    {
        $this->_assertIsNotPhlogHeader(new GopherItem('No Starting Dashes--'));
    }

    public function testPhlogHeaderWithoutAnyDashesIsWrong()
    {
        $this->_assertIsNotPhlogHeader(new GopherItem('No Dashes At All'));
    }

    public function testPhlogFooterIsProperlyIdentified()
    {
        $footer = new GopherItem($this->_footerText);
        $footer->setFileUrl('foo.txt');
        $this->_assertIsPhlogFooter($footer);
    }

    public function testNonFileItemIsNotAFooter()
    {
        $this->_assertIsNotPhlogFooter(new GopherItem($this->_footerText));
    }

    public function testDirectoryItemIsNotAFooter()
    {
        $footer = new GopherItem($this->_footerText);
        $footer->setDirectoryUrl('foo');
        $this->_assertIsNotPhlogFooter($footer);
    }

    public function testWrongTextIsNotAFooter()
    {
        $footer = new GopherItem($this->_footerText . 'wrong');
        $footer->setFileUrl('foo.txt');
        $this->_assertIsNotPhlogFooter($footer);
    }

    /* Custom Assertions */

    private function _assertIsPhlogHeader(GopherItem $item)
    {
        $this->assertTrue($item->isPhlogHeader());
    }

    private function _assertIsNotPhlogHeader(GopherItem $item)
    {
        $this->assertFalse($item->isPhlogHeader());
    }

    private function _assertIsPhlogFooter(GopherItem $item)
    {
        $this->assertTrue($item->isPhlogFooter());
    }

    private function _assertIsNotPhlogFooter(GopherItem $item)
    {
        $this->assertFalse($item->isPhlogFooter());
    }
}
