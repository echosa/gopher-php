<?php
namespace Gopher;

use Gopher\Providers\GopherProviders;

class GopherTest extends \PHPUnit_Framework_TestCase
{
    private $gopher;

    public function setUp()
    {
        $this->gopher = new Gopher(GopherProviders::GOPHER_MAP);
    }

    public function testGopherMapIsParsedCorrectly()
    {
        $this->assertCount(18, $this->gopher->getItems());
        $this->assertEquals('--Rogue--', $this->gopher->getItem(0)->getText());
        $this->assertEquals('--Infinity Blade III--', $this->gopher->getItem(5)->getText());
        $this->assertEquals('--Bitmessage--', $this->gopher->getItem(14)->getText());
    }

    /**
     * @dataProvider Gopher\Providers\GopherProviders::itemUrlProvider
     */
    public function testFileLinksAreParsedCorrectly($item, $url)
    {
        $item = $this->gopher->getItem($item);
        $this->assertEquals('Continued...', $item->getText());
        $this->assertEquals(GopherItem::FILE, $item->getUrlType());
        $this->assertEquals($url, $item->getUrl());
    }
}
