# HTTP Strict Transport Security
![GitHub All Releases](https://img.shields.io/github/downloads/sualko/cloud_hsts/total.svg)
[![GitHub license](https://img.shields.io/github/license/sualko/cloud_piwik.svg)](https://github.com/sualko/cloud_piwik/blob/master/LICENSE)

The only purpose of this [Nextcloud] application is to add the
[Strict-Transport-Security] header to installations which do not support header
configuration via a server configuration file (e.g. `.htaccess`).

# How to install
1. Download this archive, extract it to `apps/` and enable it **or** install via
   app store
2. Visit your page via **https**
3. You're done

If you like, you can verify that everything is working as expected with the
[Security Header Scan].

# Configuration
You can change the HSTS header with the following Nextcloud system options (add
them to `config/config.php`)

- `hsts.maxAge` (number) expiry time in seconds; default=15768000 (half a year)
- `hsts.includeSubDomains` (boolean) apply HSTS rule to all subdomains as well; default=false
- `hsts.preload` (boolean) allow adding the domain to the [HSTS preload list]; default=false

[Nextcloud]: https://nextcloud.com
[Strict-Transport-Security]: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security
[Security Header Scan]: https://securityheaders.com
[HSTS preload list]: https://hstspreload.org
