<?php

namespace Drupal\usage_cron\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\State\StateInterface;
use Drupal\usage_cron\UsageCronInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * A subscriber running hook_usage_cron after before a response is sent.
 */
class UsageCronSubscriber implements EventSubscriberInterface {

  /**
   * The cron service.
   *
   * @var \Drupal\Core\CronInterface
   */
  protected $cron;

  /**
   * The cron configuration.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * The state key value store.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * Constructs a new automated cron runner.
   *
   * @param \Drupal\usage_cron\UsageCronInterface $usage_cron
   *   The usage cron service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\State\StateInterface $state
   *   The state key-value store service.
   */
  public function __construct(UsageCronInterface $usage_cron, ConfigFactoryInterface $config_factory, StateInterface $state) {
    $this->cron = $usage_cron;
    $this->config = $config_factory->get('usage_cron.settings');
    $this->state = $state;
  }

  /**
   * Run the automated cron if enabled.
   *
   * @param \Symfony\Component\HttpKernel\Event\KernelEvent $event
   *   The Event to process.
   */
  public function onResponse(KernelEvent $event) {
    $min_interval = $this->config->get('min_interval');
    if ($min_interval > 0 &&
      \Drupal::currentUser()->hasPermission('trigger usage cron')) {
      $cron_next = $this->state->get('usage_cron.last', 0) + $min_interval;
      if ((int) $event->getRequest()->server->get('REQUEST_TIME') > $cron_next) {
        $this->cron->run();
      }
    }
  }

  /**
   * Registers the methods in this class that should be listeners.
   *
   * @return array
   *   An array of event listener definitions.
   */
  public static function getSubscribedEvents() {
    return [KernelEvents::RESPONSE => [['onResponse', 100]]];
  }

}
