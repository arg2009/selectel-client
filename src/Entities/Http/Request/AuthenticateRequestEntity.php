<?php

namespace Arg2009\Selectel\Entities\Http\Request;

/**
 * Class AuthenticateRequestEntity
 * @package Arg2009\Selectel\Entities\Http\Request
 *
 * Sample Request Payload:
{
  "auth": {
    "identity": {
      "methods": [
        "password"
      ],
      "password": {
        "user": {
          "domain": {
            "id": "Domain ID"
          },
          "name": "username",
          "password": "password"
        }
      }
    },
    "scope": {
      "project": {
        "domain": {
          "id": "Domain ID"
        },
        "id": "Project ID"
      }
    }
  }
}
 */
class AuthenticateRequestEntity extends AbstractRequestEntity
{
    protected $username;
    protected $password;
    protected $domainId;
    protected $projectId;

    public function __construct(string $username, string $password, string $domainId, string $projectId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->domainId = $domainId;
        $this->projectId = $projectId;
    }

    public function __toString(): string
    {
        $data = [
            'auth' => [
                'identity' => [
                    'methods' => ['password'],
                    'password' => [
                        'user' => [
                            'domain' => [
                                'id' => $this->domainId
                            ],
                            'name' => $this->username,
                            'password' => $this->password,
                        ],
                    ],
                ],
                'scope' => [
                    'project' => [
                        'domain' => [
                            'id' => $this->domainId
                        ],
                        'id' => $this->projectId,
                    ],
                ],
            ],
        ];

        return json_encode($data);
    }
}
