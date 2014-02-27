<?php
namespace Gopher;

use Gopher\Exception\NotPhlogHeaderException;

class PhlogEntryTest extends \PHPUnit_Framework_TestCase
{
    private $_phlogEntry;
    private $_title;

    public function setUp()
    {
        $this->_title = new GopherItem('--Test Phlog Entry--');
        $this->_phlogEntry = new PhlogEntry($this->_title);
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
        $this->assertCount(0, $this->_phlogEntry->getBodyItems());
    }

    public function testAddBodyItemToPhlogEntry()
    {
        $gopherItem = new GopherItem('foobar');
        $this->_phlogEntry->addBodyItem($gopherItem);
        $items = $this->_phlogEntry->getBodyItems();
        $this->assertSame($gopherItem, $items[0]);
    }
}