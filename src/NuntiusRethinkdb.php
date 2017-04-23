<?php

namespace Nuntius;

use r;

class NuntiusRethinkdb {

  /**
   * @var r\Connection
   */
  protected $connection;

  /**
   * @var integer
   */
  protected $prefix;

  /**
   * The DB name.
   *
   * @var string
   */
  protected $db;

  /**
   * The credentials for the DB connection.
   *
   * @var array
   */
  protected $credentials;

  /**
   * Connecting the the DB.
   *
   * @return $this|null
   *   The current instance of the connection was establish.
   */
  function connect() {
    $this->db = $this->credentials['db'];
    $this->connection = \r\connect($this->credentials['host'], $this->credentials['port'], $this->credentials['db'], $this->credentials['api_key'], $this->credentials['timeout']);
    return $this;
  }

  /**
   * Set the credentials for the the DB connection.
   *
   * @param $credentials
   *   The credentials for the DB connection.
   *
   * @return $this
   *   The current instance.
   */
  public function setCredentials($credentials) {
    $this->credentials = $credentials;

    return $this;
  }

  /**
   * @return int
   */
  public function getPrefix() {
    return $this->prefix;
  }

  /**
   * Getting the connect object.
   *
   * @return r\Connection
   */
  public function getConnection() {
    return $this->connection;
  }

  /**
   * Create a table in the DB.
   *
   * @param $table
   *   The table name.
   */
  public function createTable($table) {
    try {
      r\db($this->db)->tableCreate($table)->run($this->connection);
    } catch (\Exception $e) {
      print($e->getMessage() . "\n");
    }
  }

  /**
   * Creating a DB.
   *
   * @param $db
   *   The DB name.
   */
  public function createDB($db) {
    try {
      r\dbCreate($db)->run($this->connection);
    } catch (\Exception $e) {
      print($e->getMessage() . "\n");
    }
  }

  /**
   * Adding entry to a table.
   *
   * @param $table
   *   The table name.
   * @param $array
   *   The record.
   */
  public function addEntry($table, $array) {
    r\db($this->db)
      ->table($table)
      ->insert($array)
      ->run($this->connection);
  }

  /**
   * Get a table object.
   *
   * @param $table
   *   The name of the table.
   *
   * @return r\Queries\Tables\Table
   */
  public function getTable($table) {
    return r\db($this->db)
      ->table($table);
  }

  /**
   * Delete the table.
   *
   * @param $table
   *   The table name.
   */
  public function deleteTable($table) {
    r\db($this->db)
      ->tableDrop($table)
      ->run($this->connection);
  }

  /**
   * Truncate the table.
   *
   * @param $table
   *   The table name.
   */
  public function truncateTable($table) {
    r\db($this->db)
      ->table($table)
      ->delete()
      ->run($this->connection);
  }

}
