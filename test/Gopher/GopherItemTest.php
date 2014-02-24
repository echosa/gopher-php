<?php
namespace Gopher;

class GopherItemTest extends \PHPUnit_Framework_TestCase
{
    private $footerText = 'Continued...';

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
        $this->assertIsPhlogHeader(new GopherItem('--Proper Header--'));
    }

    public function testPhlogHeaderWithoutEndingDashesIsWrong()
    {
        $this->assertIsNotPhlogHeader(new GopherItem('--No Ending Dashes'));
    }

    public function testPhlogHeaderWithoutStartingDashesIsWrong()
    {
        $this->assertIsNotPhlogHeader(new GopherItem('No Starting Dashes--'));
    }

    public function testPhlogHeaderWithoutAnyDashesIsWrong()
    {
        $this->assertIsNotPhlogHeader(new GopherItem('No Dashes At All'));
    }

    public function testPhlogFooterIsProperlyIdentified()
    {
        $footer = new GopherItem($this->footerText);
        $footer->setFileUrl('foo.txt');
        $this->assertIsPhlogFooter($footer);
    }

    public function testNonFileItemIsNotAFooter()
    {
        $this->assertIsNotPhlogFooter(new GopherItem($this->footerText));
    }

    public function testDirectoryItemIsNotAFooter()
    {
        $footer = new GopherItem($this->footerText);
        $footer->setDirectoryUrl('foo');
        $this->assertIsNotPhlogFooter($footer);
    }

    public function testWrongTextIsNotAFooter()
    {
        $footer = new GopherItem($this->footerText . 'wrong');
        $footer->setFileUrl('foo.txt');
        $this->assertIsNotPhlogFooter($footer);
    }

    /* Custom Assertions */

    private function assertIsPhlogHeader(GopherItem $item)
    {
        $this->assertTrue($item->isPhlogHeader());
    }

    private function assertIsNotPhlogHeader(GopherItem $item)
    {
        $this->assertFalse($item->isPhlogHeader());
    }

    private function assertIsPhlogFooter(GopherItem $item)
    {
        $this->assertTrue($item->isPhlogFooter());
    }

    private function assertIsNotPhlogFooter(GopherItem $item)
    {
        $this->assertFalse($item->isPhlogFooter());
    }
}
