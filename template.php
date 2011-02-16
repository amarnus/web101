<?php
 /* 
   Variables available for templating this page
     $messages
     $entries
     $form_token
     $current_time
 */
?>

<!DOCTYPE html>
	<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
	<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
	<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
	<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
  <head>
	  <meta charset="utf-8">
	  <meta name="robots" content="noindex, nofollow">
	  <meta name="author" content="Amarnath Ravikumar">
	  <meta name="description" content="A simple Guestbook application">
	  <meta name="keywords" content="web, workshop, demo, html, css, php">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="stylesheet" href="css/style.css?v=1">
    <title>Guestbook / Web 101</title>
  </head>
  <body>
	  <div id="container">
		  <!-- Page header -->
		  <header>
			  <hgroup>
		  	  <h1><em>Web 101 / Guestbook</em></h1>
		    </hgroup>
		    <nav>
			    <ul>
				    <li><a href="http://nusacm.org/demo">Home</a></li>
				    <li><a href="http://nusacm.org/web101" target="_blank">Workshop</a></li>
				    <li><a href="http://github.com/amarnus/web101" target="_blank">Source</a></li>
				  </ul>
			  </nav>
		  </header>
		  <div id="main">
			  <?php if (!empty($messages)): ?>
				  <div id="messages">
					  <?php foreach($messages as $message): ?>
						  <div class="message">
						    <?php print $message; ?>
						  </div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
    		<!-- Form to submit the user submitted data to the server -->
		    <form enctype="multipart/form-data" method="POST" name="guestbook_form" target="_self" autocomplete="on" id="guestbook_form" class="guestbook_form">
		      <fieldset id="guestbook_form_required_wrapper" draggable="true">
		        <legend>Required fields</legend>
		        <div class="form-item">
		          <!-- Simple name text field -->
		          <label for="guestbook_form_name">Name </label>
		          <input type="text" placeholder="Your name goes here" name="name" size="60" maxlength="20" id="guestbook_form_name" required>
		        </div>
		        <div class="form-item">
		          <!-- Simple textarea field -->
		          <label for="guestbook_form_description">Leave a comment about this workshop <span class="small">(in less than 140 characters)</span> </label>
		          <textarea name="comment" id="guestbook_form_description" rows="3" cols="43" maxlength="140" placeholder="Less than 140 characters.." wrap="soft" required></textarea>
		        </div>
		        <div class="form-item">
		         <!--
		            Normal single select options field (Only one value can be selected)
		            i.e. Drop-down box
		          -->
		          <label for="guestbook_form_faculty">Faculty of Study </label>
		          <select name="faculty" size="1" id="guestbook_form_faculty">
		          <option>Conservatory of Music</option>
		          <option>Faculty of Arts and Social Sciences</option>
		          <option>Faculty of Dentistry</option>
		          <option>Faculty of Engineering</option>
		          <option>Faculty of Law</option>
		          <option>Faculty of Science</option>
		          <option>School of Business</option>
		          <option selected>School of Computing</option>
		          <option>School of Design and Environment</option>
		          <option>School of Medicine</option>
		          <option>University Scholars Program</option>    
		          </select>
		        </div>
		        <div class="form-item">
		          <!-- Gender radio buttons, Only one can be chosen -->
		          <label for="guestbook_form_gender">Gender</label>
		          <input type="radio" name="gender" id="guestbook_form_gender" checked> Male<br>
		          <input type="radio" name="gender"> Female
		        </div>
		        <div class="form-item">
		          <!-- Checkboxes -->
		          <input type="checkbox" name="email_updates" id="guestbook_form_email_updates" value="1" checked> <span class="small">Sign me up for email updates from NUS ACM</span>
		        </div>
		        <!-- Submits the form values to the URL specified in action -->
			      <div class="form-item">
			        <input type="submit" value="Save">
			      </div>
			      <!-- Hidden values (to be set dynamically by the server) -->
				    <input type="hidden" name="values[]" values="">
				    <input type="hidden" name="values[current_time]" value="<?php print $current_time; ?>">
				    <input type="hidden" name="values[form_token]" value="<?php print $form_token; ?>">
		      </fieldset>
		    </form>
		    <?php if (!empty($entries)): ?>
				  <div id="guestbook_entries">
					  <?php foreach($entries as $entry): ?>
						  <article class="entry">
							  <strong><?php print $entry['name']; ?></strong><br>
							  <?php print $entry['comment']; ?><br>
							  <time datetime="<?php print $entry['timestamp']; ?>"><?php print $entry['timestamp']; ?></time>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
	    </div>
	    <!-- Page footer -->
	    <footer>
	      <p>&copy; 2011 NUS Student Chapter of the ACM</p>
	    </footer>
	  </div>
  </body>