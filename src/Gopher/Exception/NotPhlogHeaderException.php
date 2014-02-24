<?php
namespace Gopher\Exception;

class NotPhlogHeaderException extends \Exception
{
    protected $message = 'You must provide a phlog header item.';
}