<?php
namespace Gopher;

use Gopher\Providers\GopherProviders;

class GopherTest extends \PHPUnit_Framework_TestCase
{
    private $_gopher;

    public function setUp()
    {
        $this->_gopher = new Gopher(GopherProviders::GOPHER_MAP);
    }

    public function testGopherObjectShouldImplementIterator()
    {
        $this->assertInstanceOf('Iterator', $this->_gopher);
    }

    public function testGopherMapIsParsedCorrectly()
    {
        $this->assertCount(18, $this->_gopher);
        $this->assertEquals('--Rogue--', $this->_gopher->getItem(0)->getText());
        $this->assertEquals('--Infinity Blade III--', $this->_gopher->getItem(5)->getText());
        $this->assertEquals('--Bitmessage--', $this->_gopher->getItem(14)->getText());
    }

    /**
     * @dataProvider Gopher\Providers\GopherProviders::itemUrlProvider
     */
    public function testFileLinksAreParsedCorrectly($item, $url)
    {
        $item = $this->_gopher->getItem($item);
        $this->assertEquals('Continued...', $item->getText());
        $this->assertEquals(GopherItem::FILE, $item->getUrlType());
        $this->assertEquals($url, $item->getUrl());
    }
}
