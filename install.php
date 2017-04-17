<?php

require 'vendor/autoload.php';

$value = \Nuntius\Nuntius::getSettings();
$db = \Nuntius\Nuntius::getRethinkDB();

$db->createDB($value['rethinkdb']['db']);
print("The DB was created.\n");

sleep(5);

foreach (array_keys($value['entities']) as $scheme) {
  $db->createTable($scheme);
  print("The table {$scheme} has created\n");
}

// Run this again.
$db->getTable('system')->insert(['id' => 'updates', 'processed' => []])->run($db->getConnection());
