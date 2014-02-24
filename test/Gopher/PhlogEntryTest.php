<?php
namespace Gopher;

use Gopher\Exception\NotPhlogHeaderException;

class PhlogEntryTest extends \PHPUnit_Framework_TestCase
{
    private $phlogEntry;
    private $title;

    public function setUp()
    {
        $this->title = new GopherItem('--Test Phlog Entry--');
        $this->phlogEntry = new PhlogEntry($this->title);
    }

    /**
     * @expectedException Gopher\Exception\NotPhlogHeaderException
     */
    public function testNonGopherItemTitleThrowsException()
    {
        $gopherItem = new GopherItem('foo');
        $phlogEntry = new PhlogEntry($gopherItem);
    }

    public function testNewPhlogEntryHasNoBodyItems()
    {
        $this->assertCount(0, $this->phlogEntry->getBodyItems());
    }

    public function testAddBodyItemToPhlogEntry()
    {
        $gopherItem = new GopherItem('foobar');
        $this->phlogEntry->addBodyItem($gopherItem);
        $items = $this->phlogEntry->getBodyItems();
        $this->assertSame($gopherItem, $items[0]);
    }
}