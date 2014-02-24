<?php
namespace Gopher\Exception;

class FileNotReadableException extends \Exception
{
    protected $message = 'The given file does not exist or is not readable.';
}