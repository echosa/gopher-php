<?php
namespace Gopher;

use Gopher\GopherFile;
use Gopher\Exception\FileNotReadableException;

class PhlogMapFile extends PhlogMap
{
    public function __construct($file)
    {
        $this->parseFile($file);
    }
    
    public function parseFile($file)
    {
        if (!is_readable($file)) {
            throw new FileNotReadableException();
        }
        
        $this->parseGopher(new GopherFile($file));
    }
}