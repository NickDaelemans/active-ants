<?php

namespace Afosto\ActiveAnts;

class Status {

  public $messageCode;
  public $message;
  public $result;

  /**
   * Get a model
   *
   * @return \self
   */
  public static function load() {
    return new self();
  }

  /**
   * Get the status
   */
  public function __construct() {
    if (!$data = App::getInstance()->cache->getCache('status')) {
      $data = (array) App::getInstance()->client->request('status/get')->message;
      //Cache the settings for 24 hours as Active Ants requires
      App::getInstance()->cache->setCache('status', $data, 60 * 60 * 24);
    }
  }

}
