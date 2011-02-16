<?php
/**
 * 
 * Adds a message of a given type to the current message stack in the session
 *
 * @param $message
 *   Message to be added to the stack
 * @return
 *  TRUE if the message was successfully added or FALSE if the message could not be added
 * 
*/
function message_stack_add($message) {
  // First check if the SESSION array is present
  // This ensures that there is a session currently active
  if (isset($_SESSION)) {
  if (isset($_SESSION['messages'])) {
    array_push($_SESSION['messages'], $message); // Push message into the message stack
    return TRUE;
  }
  else {
    $_SESSION['messages'] = array($message); // Create stack with the message
    return TRUE;
  }
  }
  return FALSE;
}

/**
 *
 * Returns current message stack in the session (if present)
 * 
 * @return
 *   Returns messages stored in the message stack in the session as an array or an empty array if stack not present
 */
function message_stack_get() { 
  $messages =  isset($_SESSION) && isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
  unset($_SESSION['messages']); // Clear the stack to be reused
  return $messages;
}