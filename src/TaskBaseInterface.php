<?php

namespace Nuntius;

interface TaskBaseInterface {

  /**
   * Return information about the scope of the task.
   *
   * @return mixed
   *   Information about the scope.
   */
  public function info();

}