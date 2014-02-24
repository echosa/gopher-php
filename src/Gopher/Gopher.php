<?php
namespace Gopher;

use Gopher\Exception\FileNotReadableException;

class Gopher
{
    private $items = array();

    public function __construct($text = null)
    {
        if (!is_null($text)) {
            $this->parse($text);
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getItem($index)
    {
        return $this->items[$index];
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
                default:
                    $item->setText($line);
                    break;
                }
            }
            $this->items[] = $item;
        }
    }

}
