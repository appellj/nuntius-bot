<?php

namespace Nuntius;

/**
 * Abstract methods for GitHub webhooks.
 */
abstract class GitHubWebhooksAbstract implements GitHubWebhooksInterface {

  /**
   * Logger object.
   *
   * @var \Nuntius\Entity\Logger
   */
  protected $logger;

  /**
   * Constructing.
   */
  function __construct() {
    $this->logger = Nuntius::getEntityManager()->get('logger');
  }

  /**
   * Holds the data of the webhook payload.
   *
   * @var array
   */
  protected $data;

  /**
   * {@inheritdoc}
   */
  public function getData() {
    return $this->data;
  }

  /**
   * {@inheritdoc}
   */
  public function setData($data) {
    $this->data = $data;

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function postAct() {
    $this->logger->insert((array) $this->getData());
  }

}
