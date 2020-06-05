<?php

declare(strict_types=1);

namespace Arg2009\Selectel;

use Arg2009\Selectel\Entities\AuthenticateEntity;
use Arg2009\Selectel\Entities\Http\Request\AuthenticateRequestEntity as AuthenticateRequestEntity;
use Arg2009\Selectel\Entities\Http\Response\ResolveInfoEntity;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    const SELECTEL_RESOLVE_URI = 'https://api.selvpc.ru/info/v2/resolve';
    const SELECTEL_AUTHENTICATE_URI = 'https://api.selvpc.ru/identity/v3/auth/tokens';
    const SELECTEL_K8S_CLUSTERS_URI = 'https://ru-2.mks.selcloud.ru/v1/clusters';

    const X_AUTH_TOKEN_HEADER = 'X-Auth-Token';
    const X_SUBJECT_TOKEN_HEADER = 'X-Subject-Token';

    private $guzzleClient;
    private $authToken;

    public function __construct()
    {
        $this->guzzleClient = new GuzzleClient();
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
            ->get(self::SELECTEL_RESOLVE_URI . '/' . $externalPanelCname)
            ->getBody()
            ->getContents()
        );
    }

    public function k8sDownloadKubeConfig(string $clusterId, string $savePath = './config-k8s-selectel')
    {
        $this->guzzleClient->get(
            self::SELECTEL_K8S_CLUSTERS_URI . "/$clusterId/kubeconfig",
            [
                'sink' => $savePath,
                'headers' => $this->getAuthenticationHeaders()
            ]
        );
    }

    /**
     * Retrieves an authentication token to interact with the Selectel API.
     *
     * @param AuthenticateEntity $entity
     */
    public function authenticate(AuthenticateEntity $entity)
    {
        $requestEntity = new AuthenticateRequestEntity(
            $entity->username,
            $entity->password,
            $entity->domainId,
            $entity->projectId
        );

        $response = $this->guzzleClient
            ->post(
                self::SELECTEL_AUTHENTICATE_URI,
                [
                    'body' => '' . $requestEntity
                ]
            );

        $this->authToken = $response->getHeader(self::X_SUBJECT_TOKEN_HEADER);
    }

    /**
     * Revokes an the access token.
     */
    public function unAuthenticate(): void
    {
        $response = $this->guzzleClient->delete(
            self::SELECTEL_AUTHENTICATE_URI,
            [
                'headers'  => array_merge(
                    $this->getAuthenticationHeaders(),
                    [self::X_SUBJECT_TOKEN_HEADER => $this->authToken]
                )
            ]
        );
    }

    /**
     * Returns the headers required to make authenticated requests.
     *
     * @return array
     */
    private function getAuthenticationHeaders()
    {
        return [
            self::X_AUTH_TOKEN_HEADER => $this->authToken
        ];
    }
}

