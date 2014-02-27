<?php
namespace Gopher;

class PhlogMap implements \Iterator
{
    private $_entries = array();
    private $_position = 0;

    public function __construct(Gopher $gopher = null)
    {
        if (!is_null($gopher)) {
            $this->parseGopher($gopher);
        }
    }

    public function getEntries()
    {
        return $this->_entries;
    }

    public function addEntry(PhlogEntry $entry)
    {
        $this->_entries[] = $entry;
    }

    public function parseGopher(Gopher $gopher)
    {
        $nextItemIsDate = false;
        foreach ($gopher->getItems() as $item) {
            if ($nextItemIsDate) {
                $entry->setDate($item);
                $nextItemIsDate = false;
            } elseif ($item->isPhlogHeader()) {
                $entry = new PhlogEntry($item);
                $nextItemIsDate = true;
            } elseif ($item->isPhlogFooter()) {
                $entry->setFooter($item);
                $this->addEntry($entry);
                unset($entry);
            } elseif (isset($entry)) {
                // only add item if not a trailing blank line
                $entry->addBodyItem($item);
            }
        }
    }

    public function getEntryForFile($file)
    {
        foreach ($this->getEntries() as $entry) {
            if ($file == $entry->getFooter()->getUrl()) {
                return $entry;
            }
        }
    }
    
    public function getPage($page, $entriesPerPage = 10)
    {
        $start = ($page - 1) * $entriesPerPage;
        return array_slice($this->_entries, $start, $entriesPerPage);
    }

    public function current()
    {
        return $this->_entries[$this->_position];
    }

    public function next()
    {
        ++$this->_position;
    }

    public function rewind()
    {
        $this->_position = 0;
    }

    public function key()
    {
        return $this->_position;
    }

    public function valid()
    {
        return isset($this->_entries[$this->_position]);
    }
}
