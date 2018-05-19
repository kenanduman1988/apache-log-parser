<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccessLog
 *
 * @ORM\Table(name="access_log", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class AccessLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255, nullable=true)
     */
    private $host;

    /**
     * @var string
     *
     * @ORM\Column(name="log_name", type="string", length=255, nullable=true)
     */
    private $logName;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255, nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=255, nullable=true)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="request", type="string", length=1024, nullable=true)
     */
    private $request;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="text", length=65535, nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="response_bytes", type="integer", nullable=false)
     */
    private $responseBytes;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AccessLog
     */
    public function setId(int $id): AccessLog
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return AccessLog
     */
    public function setHost(string $host): AccessLog
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogName(): string
    {
        return $this->logName;
    }

    /**
     * @param string $logName
     * @return AccessLog
     */
    public function setLogName(string $logName): AccessLog
    {
        $this->logName = $logName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return AccessLog
     */
    public function setUser(string $user): AccessLog
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     * @return AccessLog
     */
    public function setTime(string $time): AccessLog
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @param string $request
     * @return AccessLog
     */
    public function setRequest(string $request): AccessLog
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return AccessLog
     */
    public function setStatus(string $status): AccessLog
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getResponseBytes(): int
    {
        return $this->responseBytes;
    }

    /**
     * @param int $responseBytes
     * @return AccessLog
     */
    public function setResponseBytes(int $responseBytes): AccessLog
    {
        $this->responseBytes = $responseBytes;
        return $this;
    }
}
