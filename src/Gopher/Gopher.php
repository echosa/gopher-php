<?php
namespace Gopher;

use Gopher\Exception\FileNotReadableException;

class Gopher implements \Iterator
{
    private $_items = array();
    private $_position = 0;

    public function __construct($text = null)
    {
        if (!is_null($text)) {
            $this->parse($text);
        }
    }

    public function getItems()
    {
        return $this->_items;
    }

    public function getItem($index)
    {
        return $this->_items[$index];
    }

    public function parse($text)
    {
        $textArray = explode("\n", $text);
        foreach ($textArray as $line) {
            $item = new GopherItem();
            if (0 < strlen(trim($line))) {
                switch ($line[0]) {
                case '0':
                    $lineArray = explode("\t", $line);
                    $item->setText(substr($lineArray[0], 1));
                    $item->setFileUrl($lineArray[1]);
                    break;
                case '1':
                    $lineArray = explode("\t", $line);
                    $item->setText(substr($lineArray[0], 1));
                    $item->setDirectoryUrl($lineArray[1]);
                    break;
                case 'h':
                    $urlArray = explode('URL:', $line);
                    if (2 == count($urlArray)) {
                        $lineArray = explode("\t", $line);
                        $item->setText(substr($lineArray[0], 1));
                        $item->setHttpUrl($urlArray[1]);
                    } else {
                        $item->setText($line);
                    }
                    break;
                default:
                    $item->setText($line);
                    break;
                }
            }
            $this->_items[] = $item;
        }
    }

    public function current()
    {
        return $this->_items[$this->_position];
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
        return isset($this->_items[$this->_position]);
    }
}
