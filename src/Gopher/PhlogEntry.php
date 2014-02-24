<?php
namespace Gopher;

use Gopher\Exception\NotPhlogHeaderException;

class PhlogEntry
{
    private $title;
    private $footer;
    private $date;
    private $bodyItems = array();

    public function __construct(GopherItem $title)
    {
        if (!$title->isPhlogHeader()) {
            throw new NotPhlogHeaderException();
        }

        $this->title = $title;
    }

    public function addBodyItem(GopherItem $item)
    {
        $this->bodyItems[] = $item;
    }

    public function getBodyItems()
    {
        return $this->bodyItems;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setFooter(GopherItem $footer)
    {
        $this->footer = $footer;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(GopherItem $date)
    {
        $this->date = $date;
    }
}