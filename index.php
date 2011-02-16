<?php
// Load all the required files
require_once(dirname(__FILE__) . '/settings.php');
require_once(dirname(__FILE__) . '/lib/db.inc');
require_once(dirname(__FILE__) . '/lib/token.inc');
require_once(dirname(__FILE__) . '/lib/message_stack.inc');

// Start a new session or continue with the existing one
session_start(); 

// Act when a form is submitted
if (isset($_POST) && !empty($_POST)) {
  if (isset($_POST['values']['form_token']) && token_validate($_POST['values']['form_token'])) {
    // Required parameters are name, comment
    // Validation below is very primitive and has been kept that way for simplicity
    // However, it is important to thoroughly validate the input before using it or storing it
    // Otherwise, your site code become susceptible to code injection/SQL injection.
    $save_to_database = true; 
    if (empty($_POST['name'])) {
	    $save_to_database = false;
	    message_stack_add('Required field name is empty');
    }
    if (empty($_POST['comment'])) {
	    $save_to_database = false;
	    message_stack_add('Required field comment is empty');
    }
	    
    if ($save_to_database) {
	    // Insert into the database
	    db_sign_guestbook($_POST['name'], $_POST['comment'], $_POST['faculty'], $_POST['email_updates'], date('r'));
    }
  }
  else {
    message_stack_add('Unauthorized submission of the form. Please try again.');	
  }
  header('HTTP/1.0 303 See Other');
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// Variables to be inserted into the template
$variables = array(
	'messages' => message_stack_get(),
	'entries' => db_fetch_guestbook_entries(),
  'current_time' => time(),
  'form_token' => token_get()
);

// Extracts the keys of the associative array (dictionary) as individual variables
// Eg. array('chuck' => 'hello', 'norris' => 'world') would become $chuck = 'hello', $norris = 'world'
// Second argument ensures that if there are already variables with the same name i.e. chuck or norris..
// .. they wont get replaced
extract($variables, EXTR_SKIP);

// Render the template file
include(dirname(__FILE__) . '/template.php');