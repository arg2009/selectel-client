<?php

namespace Arg2009\Selectel\Entities\Http\Response;

use Arg2009\Selectel\Entities\AbstractEntity;

/**
 * Class ResolveInfoEntity
 * @package Arg2009\Selectel\Entities\Http\Response
 *
 * @property-read string $projectId
 * @property-read string $domainId
 *
 * Sample $jsonPayload:
{
  "auth_detail": {
    "project_id": "xxx",
    "custom_url": null,
    "domain_id": "xxx",
    "theme": {
      "color": null,
      "logo": null,
      "brand_color": null
    }
  }
}
 *
 */
class ResolveInfoEntity extends AbstractEntity
{
    protected $domainId;
    protected $projectId;

    public function __construct(string $jsonPayload)
    {
        $payload = json_decode($jsonPayload, true);

        $this->projectId = $payload['auth_detail']['project_id'];
        $this->domainId = $payload['auth_detail']['domain_id'];
    }
}
