# Usage Cron Drupal Module

## Summary

Fires a cron hook only when the website is receiving requests at no more often than a specified period of time.

This is in contrast to a system cron which runs based on the clock, regardless if the site is being used.  This module was built specifically to allow for backups of the database during development, but only if the site is being used.

Differs from the Automated Cron module in that it does not fire `hook_cron` and therefor allows for a different set of tasks.

## Configuration

1. Give permissions to all roles you wish to trigger usage cron jobs at _/admin/people/permissions_.  Without permission, no matter the interval, the usage cron hook will not fire when that user requests a page.
1. Configure the minimum interval at _/admin/config/system/cron_.
1. Implement _hook_usage_cron_ in your custom module.
