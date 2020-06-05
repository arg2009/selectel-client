#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * This is an example file to
 * demonstrate the use of the client.
 */

// Include composer
include __DIR__ . "/../vendor/autoload.php";

// Imports
use Arg2009\Selectel\Client\Client;
use Arg2009\Selectel\Client\Entities\AuthenticateEntity;

/**
 * Get details from environment variables.
 *
 * Note: Please set these before running this script.
 *
 * e.g.
 * export SELECTEL_USERNAME="my-username";
 * export SELECTEL_PASSWORD="my-password";
 * export SELECTEL_EXTERNAL_PANEL_CNAME="xxxxxx.selvpc.ru";
 * export SELECTEL_K8S_CLUSTER_ID="xxxxxxxx-xxxx-4xxx-xxxx-xxxxxxxxxxxx"
 */
$username = getenv('SELECTEL_USERNAME');
$password = getenv('SELECTEL_PASSWORD');
$externalPanelCname = getenv('SELECTEL_EXTERNAL_PANEL_CNAME');
$k8sClusterId = getenv('SELECTEL_K8S_CLUSTER_ID');

if (!$username || !$password || !$externalPanelCname || !$k8sClusterId) {
    printf("Open this script, set the environment variables above and then rerun.\n");
    exit(1);
}

$cli = new Client();
$resolveInfoEntity = $cli->resolveInfo($externalPanelCname);
$authenticateEntity = new AuthenticateEntity($username,$password, $resolveInfoEntity->domainId, $resolveInfoEntity->projectId);

printf("Login...");
$cli->authenticate($authenticateEntity);
printf("done\n");

printf("Download the kubectl config...");
$cli->k8sDownloadKubeConfig($k8sClusterId, './my-kubectl-config.yml');
printf("done\n");

printf("Logout...");
$cli->unAuthenticate();
printf("done\n");
