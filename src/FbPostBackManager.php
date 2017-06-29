<?php

namespace Nuntius;
use FacebookMessengerSendApi\SendAPI;

/**
 * Get te correct task which matches to the user input.
 */
class FbPostBackManager {

  /**
   * List of FB postbacks.
   *
   * @var FacebookPostBackInterface[]
   */
  protected $postBacks;

  /**
   * The send API object.
   *
   * @var SendAPI
   */
  protected $facebookSendAPI;

  /**
   * Constructing the tasks manager.
   *
   * @param SendAPI $facebook_send_api
   *   Facebook send API.
   * @param NuntiusConfig $config
   *   The config service.
   */
  function __construct(SendAPI $facebook_send_api, NuntiusConfig $config) {
    $this->facebookSendAPI = $facebook_send_api;

    $this->setPostBacks($config->getSetting('fb_postbacks'));
  }

  /**
   * Set the tasks.
   *
   * @param array $fb_postbacks
   *   List of tasks form.
   *
   * @return $this
   *   The current instance.
   */
  public function setPostBacks($fb_postbacks) {
    foreach ($fb_postbacks as $fb_postback => $namespace) {
      $this->postBacks[$fb_postback] = new $namespace($this->facebookSendAPI, $fb_postback);
    }

    return $this;
  }

  /**
   * Trigger the matching task to the given text.
   *
   * @param $text
   *   The text the user sent.
   *
   * @return bool|array
   *   If found return an array with the task object, callback and arguments.
   *   If not, return bool.
   */
  public function getPostBack($text) {

  }

}
