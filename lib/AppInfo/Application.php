<?php

declare(strict_types=1);

namespace OCA\HstsHeader\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;

class Application extends App implements IBootstrap
{
    public function __construct()
    {
        parent::__construct('hstsheader');
    }

    public function register(IRegistrationContext $context): void
    {
        // Nothing to do
    }

    public function boot(IBootContext $context): void
    {
        if (!$this->isModHeadersAvailable() && $this->isHTTPS()) {
            $maxAge = \OC::$server->getConfig()->getSystemValue('hsts.maxAge', 15768000);
            $includeSubDomains = \OC::$server->getConfig()->getSystemValue('hsts.includeSubDomains', false) ? '; includeSubDomains' : '';
            $preload = \OC::$server->getConfig()->getSystemValue('hsts.preload', false) ? '; preload' : '';

            header("Strict-Transport-Security: max-age=${maxAge}${includeSubDomains}${preload}");
        }
    }

    private function isModHeadersAvailable()
    {
        return getenv('modHeadersAvailable') === 'true';
    }

    private function isHTTPS()
    {
        $direct = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1);
        $proxy = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https';

        return $direct || $proxy;
    }
}
