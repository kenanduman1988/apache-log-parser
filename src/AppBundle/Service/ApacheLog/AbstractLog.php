<?php

namespace AppBundle\Service\ApacheLog;

/**
 * Class AbstractLog
 * @package AppBundle\Service\ApacheLog
 */
abstract class AbstractLog
{
    /** @var string */
    protected $defaultFormat = '%h %l %u %t "%r" %>s %b';

    /** @var string */
    protected $pcreFormat;

    /** @var array */
    protected $patterns = [
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
    ];

    /**
     * @return $this
     */
    public function setIpPatterns()
    {
        // Set IPv4 & IPv6 recognition patterns
        $ipPatterns = \implode('|', [
            'ipv4' => '(((25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9])\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9]))',
            'ipv6full' => '([0-9A-Fa-f]{1,4}(:[0-9A-Fa-f]{1,4}){7})',
            'ipv6null' => '(::)',
            'ipv6leading' => '(:(:[0-9A-Fa-f]{1,4}){1,7})',
            'ipv6mid' => '(([0-9A-Fa-f]{1,4}:){1,6}(:[0-9A-Fa-f]{1,4}){1,6})',
            'ipv6trailing' => '(([0-9A-Fa-f]{1,4}:){1,7}:)',
        ]);
        $this->patterns['%a'] = '(?P<remoteIp>' . $ipPatterns . ')';
        $this->patterns['%A'] = '(?P<localIp>' . $ipPatterns . ')';

        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format = null)
    {
        $format = $format ?? $this->defaultFormat;
        $expr = "#^{$format}$#";
        foreach ($this->patterns as $pattern => $replace) {
            $expr = \preg_replace("/{$pattern}/", $replace, $expr);
        }
        $this->pcreFormat = $expr;

        return $this;
    }

    /**
     * @return string
     */
    public function getPcreFormat(): string
    {
        return $this->pcreFormat;
    }
}