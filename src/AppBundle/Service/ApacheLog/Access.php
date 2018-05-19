<?php

namespace AppBundle\Service\ApacheLog;

use AppBundle\Entity\AccessLog;

/**
 * Class Access
 * @package AppBundle\Service\ApacheLog
 */
class Access
{
    /** @var string */
    protected $defaultFormat = '%h %l %u %t "%r" %>s %b';

    /** @var string */
    protected $pcreFormat;

    /** @var array */
    protected $patterns = array(
        '%%' => '(?P<percent>\%)',
        '%a' => '(?P<remoteIp>)',
        '%A' => '(?P<localIp>)',
        '%h' => '(?P<host>[a-zA-Z0-9\-\._:]+)',
        '%l' => '(?P<logname>(?:-|[\w-]+))',
        '%m' => '(?P<requestMethod>OPTIONS|GET|HEAD|POST|PUT|DELETE|TRACE|CONNECT|PATCH|PROPFIND)',
        '%p' => '(?P<port>\d+)',
        '%r' => '(?P<request>(?:(?:[A-Z]+) .+? HTTP/1.(?:0|1))|-|)',
        '%t' => '\[(?P<time>\d{2}/(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)/\d{4}:\d{2}:\d{2}:\d{2} (?:-|\+)\d{4})\]',
        '%u' => '(?P<user>(?:-|[\w-]+))',
        '%U' => '(?P<URL>.+?)',
        '%v' => '(?P<serverName>([a-zA-Z0-9]+)([a-z0-9.-]*))',
        '%V' => '(?P<canonicalServerName>([a-zA-Z0-9]+)([a-z0-9.-]*))',
        '%>s' => '(?P<status>\d{3}|-)',
        '%b' => '(?P<responseBytes>(\d+|-))',
        '%T' => '(?P<requestTime>(\d+\.?\d*))',
        '%O' => '(?P<sentBytes>[0-9]+)',
        '%I' => '(?P<receivedBytes>[0-9]+)',
        '\%\{(?P<name>[a-zA-Z]+)(?P<name2>[-]?)(?P<name3>[a-zA-Z]+)\}i' => '(?P<Header\\1\\3>.*?)',
        '%D' => '(?P<timeServeRequest>[0-9]+)',
    );

    /**
     * @param string $format
     */
    public function __construct($format = null)
    {
        // Set IPv4 & IPv6 recognition patterns
        $ipPatterns = implode('|', array(
            'ipv4' => '(((25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9])\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9]))',
            'ipv6full' => '([0-9A-Fa-f]{1,4}(:[0-9A-Fa-f]{1,4}){7})', // 1:1:1:1:1:1:1:1
            'ipv6null' => '(::)',
            'ipv6leading' => '(:(:[0-9A-Fa-f]{1,4}){1,7})', // ::1:1:1:1:1:1:1
            'ipv6mid' => '(([0-9A-Fa-f]{1,4}:){1,6}(:[0-9A-Fa-f]{1,4}){1,6})', // 1:1:1::1:1:1
            'ipv6trailing' => '(([0-9A-Fa-f]{1,4}:){1,7}:)', // 1:1:1:1:1:1:1::
        ));
        $this->patterns['%a'] = '(?P<remoteIp>' . $ipPatterns . ')';
        $this->patterns['%A'] = '(?P<localIp>' . $ipPatterns . ')';
        $this->setFormat($format ?: $this->getDefaultFormat());
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format)
    {
        $expr = "#^{$format}$#";
        foreach ($this->patterns as $pattern => $replace) {
            $expr = preg_replace("/{$pattern}/", $replace, $expr);
        }
        $this->pcreFormat = $expr;
    }

    /**
     * @return string
     */
    public function getDefaultFormat(): string
    {
        return $this->defaultFormat;
    }

    /**
     * @param string $placeholder
     * @param string $pattern
     */
    public function addPattern($placeholder, $pattern)
    {
        $this->patterns[$placeholder] = $pattern;
    }

    /**
     * @param $line
     * @return AccessLog
     * @throws \Exception
     */
    public function parse($line)
    {
        if (!preg_match($this->pcreFormat, $line, $matches)) {
            throw new \Exception('Format not match');
        }
        $entity = new AccessLog();
        $entity
            ->setHost($matches['host'])
            ->setLogName($matches['logname'])
            ->setUser($matches['user'])
            ->setTime($matches['time'])
            ->setRequest($matches['request'])
            ->setStatus($matches['status'])
            ->setResponseBytes($matches['responseBytes'])
        ;
        return $entity;
    }

    /**
     * @return string
     */
    public function getPCRE()
    {
        return (string)$this->pcreFormat;
    }
}