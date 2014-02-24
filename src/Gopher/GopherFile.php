<?php
namespace Gopher;

use Gopher\Exception\FileNotReadableException;

class GopherFile extends Gopher
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
        
        $this->parse(file_get_contents($file));
    }
}