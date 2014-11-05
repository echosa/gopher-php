<?php
namespace Gopher;

class GopherItem
{
    const FILE = 'file';
    const DIR = 'dir';
    const HTTP = 'http';
    const PHLOG_HEADER_REGEXP = '/^--.*--$/';
    const PHLOG_FOOTER_REGEXP = '/^Continued\.\.\.$/';

    private $_text;
    private $_url;
    private $_urlType;

    public function __construct($text = '' )
    {
        $this->_text = $text;
    }

    public function getText()
    {
        return $this->_text;
    }

    public function setText($text)
    {
        $this->_text = $text;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getUrlType()
    {
        return $this->_urlType;
    }

    public function setFileUrl($url)
    {
        $this->_setUrl($url, self::FILE);
    }

    public function setDirectoryUrl($url)
    {
        $this->_setUrl($url, self::DIR);
    }

    public function setHttpUrl($url)
    {
        $this->_setUrl($url, self::HTTP);
    }

    public function isPhlogHeader()
    {
        return 1 == preg_match(self::PHLOG_HEADER_REGEXP, $this->getText())
            && null == $this->getUrlType();
    }

    public function isPhlogFooter()
    {
        return 1 == preg_match(self::PHLOG_FOOTER_REGEXP, $this->getText())
            && (self::FILE == $this->getUrlType() || self::DIR == $this->getUrlType());
    }

    private function _setUrl($url, $type)
    {
        $this->_url = $url;
        $this->_urlType = $type;
    }
}
