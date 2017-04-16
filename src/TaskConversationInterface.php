<?php

namespace Nuntius;

/**
 * Base interface for question orientation tasks.
 *
 * Only methods with a 'question' prefix will be triggered. A question method
 * will need to return the text of the question. The value will be store into a
 * variable with the same method name but without the prefix.
 *
 * @code
 *  public $name;
 *  public $firstName;
 *
 *  public function questionFirstName() {
 *    return 'what is your first name?';
 *  }
 *
 *  public function questionLastName() {
 *    return 'what is you last name?';
 *  }
 * @endcode
 */
interface TaskConversationInterface extends TaskBaseInterface {

  /**
   * Asking the user questions which needed for the current task.
   *
   * Normal task is a task a black box task - receive an array of arguments
   * (or not) and do something simple - set a reminder.
   *
   * There are some tasks that need to know context - team members so nuntius
   * could notify team members when the senior developer available. This kind of
   * context is a constant context - some information which likely won't change
   * in the near future.
   *
   * Another type of context is a temporary context - something we don't need to
   * keep for ever but only for the current task. A good example is when
   * ordering food. We need to know from where we going to order, who's eating
   * with who and what they are eating. When the task will end the context can
   * be removed. But we might need to keep the information as an archive. For
   * example we need to know for the next food reservations who ordered with who
   * in the past(so we could suggest lunch partners) or we need to know from
   * where we order in the past and maybe suggest something else when looking
   * what we going to eat.
   *
   * The function will return if the answers won't change in the near future.
   *
   * @code
   *  return 'temporary'; // can be 'forever'
   * @endcode
   *
   * @return string
   *   Information about the conversation scope.
   */
  public function conversationScope();

  /**
   * When the all answers have been collected this function will be invoked.
   *
   * The answers won't store automatically due to unknown nature of the task.
   */
  public function collectAllAnswers();

}
