<?php // sqltest.php

// Note: This example is different to the one in the book. It has
//       been amended to work correctly when deleting entries.

require_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_server)
	or die("Unable to select database: " . mysql_error());

{
	$name   = get_post('name');
	$company   = get_post('company');
	$description = get_post('description');
	$email     = get_post('email');
	$phone    = get_post('phone');

	$query = "INSERT INTO clientcontact VALUES" .
		"('$name', '$company', '$description', '$email', '$phone')";

	if (!mysql_query($query, $db_server))
		echo "INSERT failed: $query<br />" .
		mysql_error() . "<br /><br />";
}

echo <<<_END
<form action="index.php" method="post"><pre>
           Name: <input type="text" name="name" />
        Company: <input type="text" name="company" />
Inquiry Details: <input type="text" name="description" />
         E-Mail: <input type="text" name="email" />
   Phone Number: <input type="text" name="phone" />
         <input type="submit" value="ADD RECORD" />
</pre></form>
_END;

mysql_close($db_server);

function get_post($var)
{
	return mysql_real_escape_string($_POST[$var]);
}
?>