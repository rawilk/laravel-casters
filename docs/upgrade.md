---
title: Upgrade Guide
sort: 4
---

## From v2 to v3

### PHP Version
v3 now requires PHP 8.1 or greater, so your environment will need to be at least that version.

### Laravel Version
v3 now requires Laravel 9.0 or greater, so you will need to ensure your project is upgraded to at least version 9.0.

### Encrypted Cast
v3 Dropped the Encrypted cast in favor of using the encryption casts that come with Laravel now. You will need to make sure you changed any references from `Encrypted::class` to `'encrypted'` in your models.
