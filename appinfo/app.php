<?php

function isModHeadersAvailable() {
  return getenv('modHeadersAvailable') === 'true';
}

function isHTTPS() {
  $direct = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1);
  $proxy = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https';

  return $direct || $proxy;
}

if (!isModHeadersAvailable() && isHTTPS()) {
  $maxAge = \OC::$server->getConfig()->getSystemValue('hsts.maxAge', 15768000);
  $includeSubDomains = \OC::$server->getConfig()->getSystemValue('hsts.includeSubDomains', false) ? '; includeSubDomains' : '';
  $preload = \OC::$server->getConfig()->getSystemValue('hsts.preload', false) ? '; preload' : '';

  header("Strict-Transport-Security: max-age=${maxAge}${includeSubDomains}${preload}");
}
