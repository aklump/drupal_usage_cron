<?php

namespace Drupal\usage_cron;

interface UsageCronInterface {

  /**
   * Executes a usage cron run.
   *
   * Do not call this function from a test. Use $this->cronRun() instead.
   *
   * @return bool
   *   TRUE upon success, FALSE otherwise.
   */
  public function run();

}
