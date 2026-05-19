---
title: Upgrade Guide
sort: 4
---

## From v3 to v4

### PHP Version

v4 now requires PHP 8.2 or greater, so your environment will need to be at least that version.

### Laravel Version

v4 now requires Laravel 11.0 or greater, so you will need to ensure your project is upgraded to at least version 11.0.

### Password Cast

The Password cast has been removed in favor of using Laravel's `hashed` cast instead.
