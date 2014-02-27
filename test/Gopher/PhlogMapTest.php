<?php
namespace Gopher;

use Gopher\Providers\GopherProviders;

class PhlogMapTest extends \PHPUnit_Framework_TestCase
{
    private $_phlogMap;

    public function setUp()
    {
        $this->_phlogMap = new PhlogMap();
    }

    public function testPhlogMapShouldImplementIterator()
    {
        $this->assertInstanceOf('Iterator', $this->_phlogMap);
    }

    public function testNewPhlogMapHasNoEntries()
    {
        $this->assertCount(0, $this->_phlogMap->getEntries());
    }

    public function testAddingPhlogEntry()
    {
        $phlogHeader = new GopherItem('--Phlog Header--');
        $entry = new PhlogEntry($phlogHeader);
        $this->_phlogMap->addEntry($entry);
        $entries = $this->_phlogMap->getEntries();
        $this->assertSame($entry, $entries[0]);
    }

    public function testPhlogMapParsesTitlesCorrectly()
    {
        $entries = $this->getPhlogEntries();
        $this->assertCount(3, $entries);
        $this->assertTitle('--Rogue--', $entries[0]);
        $this->assertTitle('--Infinity Blade III--', $entries[1]);
        $this->assertTitle('--Bitmessage--', $entries[2]);
    }

    public function testPhlogMapParsesFootersCorrectly()
    {
        $entries = $this->getPhlogEntries();
        $this->assertFooter('0006-rogue', $entries[0]);
        $this->assertFooter('0005-infinity-blade-3', $entries[1]);
        $this->assertFooter('0004-bitmessage', $entries[2]);
    }

    public function testPhlogMapParsesDatesCorrectly()
    {
        $entries = $this->getPhlogEntries();
        $this->assertDate('Thursday, September 26th, 2013', $entries[0]);
        $this->assertDate('Monday, September 23th, 2013', $entries[1]);
        $this->assertDate('Thursday, August 29th, 2013', $entries[2]);
    }

    public function testGettingPhlogEntryForFile()
    {
        $gopher = new Gopher(GopherProviders::GOPHER_MAP);
        $this->_phlogMap->parseGopher($gopher);
        $entry = $this->_phlogMap->getEntryForFile('0005-infinity-blade-3');
        $this->assertTitle('--Infinity Blade III--', $entry);

        $entries = $this->_phlogMap->getEntries();
        $this->assertSame($entry, $entries[1]);
    }

    public function testPhlogItemsDoNotHaveBlankLastItem()
    {
        $gopher = new Gopher(GopherProviders::GOPHER_MAP);
        $this->_phlogMap->parseGopher($gopher);
        $entry = $this->_phlogMap->getEntryForFile('0005-infinity-blade-3');
        $this->assertCount(5, $entry->getBodyItems());
    }

    public function testPaginationReturnsOnlySecondItem()
    {
        $this->_phlogMap->parseGopher(new Gopher(GopherProviders::GOPHER_MAP));
        $entries = $this->_phlogMap->getPage(2,1);
        $this->assertCount(1, $entries);
        $this->assertTitle('--Infinity Blade III--', $entries[0]);
    }

    public function testPaginationReturnsOnlyThirdItem()
    {
        $this->_phlogMap->parseGopher(new Gopher(GopherProviders::GOPHER_MAP));
        $entries = $this->_phlogMap->getPage(2,2);
        $this->assertCount(1, $entries);
        $this->assertTitle('--Bitmessage--', $entries[0]);
    }

    /* Custom Assertions */

    private function assertTitle($expectedTitle, $entry)
    {
        $this->assertEquals($expectedTitle, $entry->getTitle()->getText());
    }

    private function assertFooter($filename, $entry)
    {
        $this->assertEquals($this->getPhlogFooter($filename), $entry->getFooter());
    }

    private function assertDate($dateString, $entry)
    {
        $this->assertEquals($dateString, trim($entry->getDate()->getText()));
    }

    /* Helper Functions */

    private function getPhlogEntries()
    {
        $gopher = new Gopher(GopherProviders::GOPHER_MAP);
        $this->_phlogMap->parseGopher($gopher);
        return $this->_phlogMap->getEntries();
    }

    private function getPhlogFooter($filename)
    {
        $footer = new GopherItem('Continued...');
        $footer->setFileUrl($filename);
        return $footer;
    }
}
