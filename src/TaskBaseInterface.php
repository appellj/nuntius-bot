<?php

namespace Nuntius;

interface TaskBaseInterface {

  /**
   * Return information about the scope of the task.
   *
   * @return mixed
   *   Information about the scope.
   */
  public function scope();

  /**
   * Acting when the user logged in or out.
   */
  public function actOnPresenceChange();

}