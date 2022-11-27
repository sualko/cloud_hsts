<?php

declare(strict_types=1);

namespace OCA\Hsts\AppInfo;

use OCP\IConfig;
use OCP\AppFramework\App;
use OCP\AppFramework\Http\IOutput;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;

class Application extends App implements IBootstrap
{
    public function __construct()
    {
        parent::__construct('hsts');
    }

    public function register(IRegistrationContext $context): void
    {
        // Nothing to do
    }

    public function boot(IBootContext $context): void
    {
        if (!$this->isModHeadersAvailable() && $this->isHTTPS()) {
            $context->injectFn([$this, 'addHstsHeader']);
        }
    }

	public function addHstsHeader(IConfig $config, IOutput $output): void {
        $maxAge = $config->getSystemValue('hsts.maxAge', 15768000);
        $includeSubDomains = $config->getSystemValue('hsts.includeSubDomains', false) ? '; includeSubDomains' : '';
        $preload = $config->getSystemValue('hsts.preload', false) ? '; preload' : '';

        $output->setHeader("Strict-Transport-Security: max-age=${maxAge}${includeSubDomains}${preload}");
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
