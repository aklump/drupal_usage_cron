<?php
/**
 * @file
 * Defines the API functions provided by the usage_cron module.
 */

/**
 * Perform periodic actions at intervals but only under usage.
 *
 * Modules that require some commands to be executed periodically but only when
 * the site is being used can implement hook_usage_cron(). The engine will then
 * call the hook no more often than the configured period, and only if the site
 * is receiving HTTP requests.. Typical tasks managed by hook_usage_cron() are
 * database backups which need to be regular but not mindlessly automatic.
 *
 * Short-running or non-resource-intensive tasks can be executed directly in
 * the hook_usage_cron() implementation.
 *
 * Long-running tasks and tasks that could time out, such as retrieving remote
 * data, sending email, and intensive file tasks, should use the queue API
 * instead of executing the tasks directly. To do this, first define one or
 * more queues via a \Drupal\Core\Annotation\QueueWorker plugin. Then, add
 * items that need to be processed to the defined queues.
 */
function hook_usage_cron() {

}
