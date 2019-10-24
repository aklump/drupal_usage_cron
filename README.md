# Usage Cron Drupal Module

## Summary

Fires a hook only when the website is receiving requests at no more often than a specified period of time.

This is in contrast to a system cron which generally runs based on the clock, regardless if the site is being used.  This module was built specifically to allow for backups of the database during development, but only if the site was being used to minimize the backup process and storage.

This module differs from the Automated Cron module (which also gets trigger by HTTP requests) in that it does not fire `hook_cron`, but rather `hook_usage_cron` and therefor allows for a different set of tasks to be scheduled to run.

This module does not affect or interact with the normal cron jobs.

## Configuration

1. Give permissions to all roles you wish to trigger usage cron jobs at _/admin/people/permissions_.  Without permission, no matter the interval, the usage cron hook will not fire when that user requests a page.
1. Configure the minimum interval at _/admin/config/system/cron_.
1. Implement _hook_usage_cron_ in your custom module.
