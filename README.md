# HTTP Strict Transport Security

The only purpose of this [Nextcloud] application is to add the
[Strict-Transport-Security] header to installations which don't support header
configuration via a server configuration file (e.g. `.htaccess`).

# How to install
1. Download this archive, extract it to `apps/` and enable it **or** install via
   app store
2. Visit your page via **https**
3. Your done

If you like, you can verify that everything is working as expected with the
[Security Header Scan]

# Configuration
You can change the HSTS header with the following Nextcloud system options (add
it to `config/config.php`)

- `hsts.maxAge` (number) expire time in seconds; default=15768000
- `hsts.includeSubDomains` (boolean) apply HSTS rule to all subdomains; default=false
- `hsts.preload` (boolean) add domain to Google preload list; default=false

[Nextcloud]: https://nextcloud.com
[Strict-Transport-Security]: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security
[Security Header Scan]: https://securityheaders.com