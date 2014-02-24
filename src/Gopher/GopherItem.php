<?php
namespace Gopher;

class GopherItem
{
    const FILE = 'file';
    const DIR = 'dir';
    const PHLOG_HEADER_REGEXP = '/^--.*--$/';
    const PHLOG_FOOTER_REGEXP = '/^Continued\.\.\.$/';

    private $text;
    private $url;
    private $urlType;

    public function __construct($text = '' )
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getUrlType()
    {
        return $this->urlType;
    }

    public function setFileUrl($url)
    {
        $this->setUrl($url, self::FILE);
    }

    public function setDirectoryUrl($url)
    {
        $this->setUrl($url, self::DIR);
    }

    public function isPhlogHeader()
    {
        return 1 == preg_match(self::PHLOG_HEADER_REGEXP, $this->getText())
            && null == $this->getUrlType();
    }

    public function isPhlogFooter()
    {
        return 1 == preg_match(self::PHLOG_FOOTER_REGEXP, $this->getText())
            && self::FILE == $this->getUrlType();
    }

    private function setUrl($url, $type)
    {
        $this->url = $url;
        $this->urlType = $type;
    }
}
