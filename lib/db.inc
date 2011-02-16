<?php
/**
 *
 * Connect to the database
 */
function db_connect() {
  static $db_selected;
  if (!$db_selected) {
		$db_link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		if (!$db_link) {
		  // Could not connect to the database
		  message_stack_add(mysql_error()); // Possibly the credentials were wrong
		  return FALSE;
	}
	$db_selected = mysql_select_db('guestbook', $db_link);
	if (!$db_selected) {
	  // Not able to select a database
	  // means the database has not been created
	  message_stack_add('Database guestbook has not yet been created to store records');
	  return FALSE;
	}
  }
  return $db_link;
}

/**
 *
 * Save a record in the guestbook_entries table in the database
 * 
 * @param string $name
 *   Name of the user
 * @param string $comment
 *   Comment entered by the user
 * @param string $faculty
 *   Faculty of Study
 * @param boolean $updates
 *   Has the user signed up for email updates
 * @param int $time
 *   Time when the user signed up
 *
 */
function db_sign_guestbook($name, $comment, $faculty, $updates, $time) {
  if (!($link = db_connect()))
    return;
  list($name, $comment, $faculty, $updates, $time) = array_map('mysql_real_escape_string', array($name, $comment, $faculty, $updates, $time));
  $sql = "INSERT INTO guestbook_entries (name, comment, faculty, email_updates, timestamp) VALUES ('$name', '$comment', '$faculty', '$updates', '$time')";
  mysql_query($sql); // Run the SQL
  if (mysql_errno($link) != 0) { // Implies there was a error
	  message_stack_add(mysql_error()); // Report the error
  } 
  else {
	  message_stack_add("$name, You have signed our guestbook! Thanks =)");
  }
  return;
}

/**
 *
 * Get all records from the guestbook_entries table
 *
 * @param $from
 *   From which entry do you want to retrive records from
 * @param $count
 *   Number of entries to pick up from the from pointer
 */
function db_fetch_guestbook_entries($from = 0, $count = 10) {
  if (!($link = db_connect()))
    return;
  $records = array();
  $results = mysql_query("SELECT * FROM guestbook_entries ORDER BY timestamp DESC LIMIT $from, $count");
  while($record = mysql_fetch_array($results)) {
    array_push($records, $record);	
  }
  return $records;
}