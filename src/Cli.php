<?php

declare(strict_types=1);

namespace Arg2009\Selectel;

use Arg2009\Selectel\Entities\Http\Response\ResolveInfoEntity;
use GuzzleHttp\Client;

class Cli
{
    const SELECTEL_RESOLVE_URI = "https://api.selvpc.ru/info/v2/resolve/";

    private $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new Client();
    }

    /**
     * Resolves details about the project associated to the given External Panel CNAME.
     *
     * Important information retrieved:
     * - project_id
     * - domain_id
     *
     * @param string $externalPanelCname The CNAME to access the project's external panel E.g. XXXXXX.selvpc.ru
     * @return ResolveInfoEntity
     */
    public function resolveInfo(string $externalPanelCname): ResolveInfoEntity
    {
        return new ResolveInfoEntity(
            $this->guzzleClient
            ->get(self::SELECTEL_RESOLVE_URI . $externalPanelCname)
            ->getBody()
            ->getContents()
        );
    }
}

