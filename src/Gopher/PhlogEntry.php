<?php
namespace Gopher;

use Gopher\Exception\NotPhlogHeaderException;

class PhlogEntry
{
    private $_title;
    private $_footer;
    private $_date;
    private $_bodyItems = array();

    public function __construct(GopherItem $title)
    {
        if (!$title->isPhlogHeader()) {
            throw new NotPhlogHeaderException();
        }

        $this->_title = $title;
    }

    public function addBodyItem(GopherItem $item)
    {
        $this->_bodyItems[] = $item;
    }

    public function getBodyItems()
    {
        return $this->_bodyItems;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getFooter()
    {
        return $this->_footer;
    }

    public function setFooter(GopherItem $footer)
    {
        $this->_footer = $footer;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function setDate(GopherItem $date)
    {
        $this->_date = $date;
    }
}