<?php
/**
 *
 * Creates a unique form token and saves it in the session for validation later
 * 
 * @return
 *  Unique form token generated or FALSE if it cannot be set
 */
function token_get() {
  if (isset($_SESSION)) {
	return ($_SESSION['form_token'] = uniqid()); // Set and return form token to a unique string
  }
  return FALSE;
}

/**
 *
 * Validate the given form token with the one in the session
 *
 * @param $token
 *   Token to be validated
 * @return
 *   TRUE if the token is valid and false if not
 */
function token_validate($token = NULL) {
  return 
    !is_null($token) and // Token cannot be NULL
    isset($_SESSION) and // Session should be alive
    isset($_SESSION['form_token']) and // There should be a form token already saved in the session
    ($_SESSION['form_token'] == $token); // Check if the given token is same as the saved one
}