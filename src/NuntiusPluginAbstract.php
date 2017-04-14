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
  }

  /**
   * The action to commit when the event on slack is triggered.
   */
  abstract protected function action();

}