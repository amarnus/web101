<?php

/**
 *
 * Make the guestbook entry an object and write to a file
 *
 * @param string $name
 *   Name of the user
 * @param string $comment
 *   Comment entered by the user
 */
function file_sign_guestbook($name, $comment) {
	$fp = fopen('guestbook_entries.txt', 'a');
	if (flock($fp, LOCK_EX)) { // If you can get the lock, take it exclusively: otherwise, block
		$entry = array(
			'name' => $name,
			'comment' => $comment,
			'timestamp' => date('r')
		);
		fwrite($fp, serialize($entry) . "\n"); // Serializing converts the array to a string
		flock($fp, LOCK_UN); // Release the lock
	}	
	fclose($fp);
}

/**
 *
 * Read guestbook entries from a file
 *
*/
function file_fetch_guestbook_entries() {
	$fp = @fopen('guestbook_entries.txt', 'r');
	if (is_null($fp)) {
		return;
	}
	$entries = array();
	while($entry_string = fgets($fp)) {
		array_unshift($entries, unserialize($entry_string)); // Prepend array element instead of appending. Opposite of array_push
	}
	return $entries;
}