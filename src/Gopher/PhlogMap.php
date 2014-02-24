<?php
namespace Gopher;

class PhlogMap
{
    private $entries = array();

    public function __construct(Gopher $gopher = null)
    {
        if (!is_null($gopher)) {
            $this->parseGopher($gopher);
        }
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function addEntry(PhlogEntry $entry)
    {
        $this->entries[] = $entry;
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
        return array_slice($this->entries, $start, $entriesPerPage);
    }
}
