Sops PHP wrapper libary
==============

`SOPS <https://https://github.com/getsops/sops>`_ is an editor of encrypted files that supports YAML, JSON, ENV, INI and BINARY formats and encrypts with AWS KMS, GCP KMS, Azure Key Vault, age, and PGP.

This repository provides a SOPS wrapper PHP library for PHP applications.

## Installation
```
composer require linkorb/sops-php
```

## Example
```php
use linkORB\Shipyard\Sops as SopsWrapper;

// encrypt a file using a encryption method
$sops = new SopsWrapper();
$data = $sops->encrypt($key, $filepath, $method);

// encrypt a file using a encryption method
$sops = new SopsWrapper();
$data = $sops->decrypt($filepath);


```
## CLI usage

You can use the `bin/sops-php` CLI application to run commands for encryption/decryption.

The application needs a couple of configuration directives to work:

* install SOPS (https://github.com/getsops/sops)
* age or other encryption tool + key

### Example commands

    # encryption
    php bin/sops-php sops:encrypt -k age1tjzcc45rq3rlnt0hd6a77w9p90pdzmq3df7pdgtkrhynyxs25y2qltryk0 -m age  composer.json

    #decryption
    php bin/sops-php sops:decrypt composer.sops.json
