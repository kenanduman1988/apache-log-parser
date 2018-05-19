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
     * @ORM\Column(name="server_name", type="string", length=255, nullable=true)
     */
    private $serverName;

    /**
     * @var string
     *
     * @ORM\Column(name="host_name", type="string", length=255, nullable=true)
     */
    private $hostName;

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
     * @ORM\Column(name="request_time", type="string", length=1024, nullable=true)
     */
    private $requestTime;

    /**
     * @var string
     *
     * @ORM\Column(name="request_first_line", type="text", length=65535, nullable=true)
     */
    private $requestFirstLine;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="response_size", type="integer", nullable=false)
     */
    private $responseSize;


}

