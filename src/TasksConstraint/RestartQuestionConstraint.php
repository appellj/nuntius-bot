<?php

namespace Nuntius\TasksConstraint;

use Nuntius\AbstractQuestionConstraint;

/**
 * Validating the restart question tasks.
 */

class RestartQuestionConstraint extends AbstractQuestionConstraint {

  /**
   * Validate the user input the correct text.
   *
   * @param string $value
   *   The input of the user.
   *
   * @return bool
   */
  public function validateStartingAgain($value) {
    if (!in_array($value, ['yes', 'no', 'y', 'n'])) {
      return 'The answer need to be one of the following: ' . implode(', ' , ['yes', 'no', 'y', 'n']);
    }

    return TRUE;
  }

}
