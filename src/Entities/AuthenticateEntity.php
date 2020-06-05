<?php

declare(strict_types=1);

namespace Arg2009\Selectel\Entities;

/**
 * Class AuthenticateEntity
 * @package Arg2009\Selectel\Entities
 *
 * @property-read string username
 * @property-read string password
 * @property-read string domainId
 * @property-read string projectId
 *
 */
class AuthenticateEntity extends AbstractEntity
{
    protected $username;
    protected $password;
    protected $domainId;
    protected $projectId;

    public function __construct(
        string $username,
        string $password,
        string $domainId,
        string $projectId
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->domainId = $domainId;
        $this->projectId = $projectId;
    }
}
