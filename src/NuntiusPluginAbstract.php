<?php

namespace Nuntius;
use Slack\RealTimeClient;

/**
 * Class NuntiusPluginAbstract.
 *
 * Base class for all the plugins.
 */
abstract class NuntiusPluginAbstract {

  /**
   * @var \Nuntius\NuntiusRethinkdb
   */
  protected $db;

  /**
   * @var \Slack\RealTimeClient
   */
  protected $client;

  /**
   * The entity manager.
   *
   * @var \Nuntius\EntityManager
   */
  protected $entityManager;

  /**
   * Information about the action.
   *
   * @var array
   */
  public $data;

  /**
   * Constructing the class.
   *
   * @param \Slack\RealTimeClient $client
   *   The client object.
   */
  function __construct(RealTimeClient $client) {
    $this->db = Nuntius::getRethinkDB();
    $this->client = $client;
    $this->entityManager = Nuntius::getEntityManager();
  }

  /**
   * Check if a text is matching to a text templates.
   *
   * In case the text is matching to the template the arguments will be
   * exported.
   *
   * The sentence should be in the format of:
   * @code
   *  /what can you do in (.*)/
   * @code
   *
   * @param $input
   *   The text the user submitted.
   * @param $template
   *   The format of the plugin.
   *
   * @return boolean|array
   *   In case there is not match, return FALSE. If found, return the arguments
   *   from the sentence.
   */
  public function matchTemplate($input, $template) {
    if (!preg_match($template, $input, $matches)) {
      return FALSE;
    }

    if (count($matches) == 1) {
      return TRUE;
    }

    unset($matches[0]);

    return $matches;
  }

  /**
   * The action to commit when the event on slack is triggered.
   */
  abstract public function action();

  /**
   * Invoking an action before triggering the action method.
   */
  public function preAction() {
  }

  /**
   * Invoking an action after the action method was triggered.
   */
  public function postAction() {
  }

}