<?php
/*
  #
  #    Example of how to use the "Best MySQL Class"
  # http://www.phpclasses.org/browse/package/5165.html
  #

   Just a note for those that may think I am arrogant...
  I am not (or I think not :P) its just I could not think
   of another name for the package as others were taken
     and someone suggested the name, so I took it ;)
  
             By aldo of http://mschat.net/

               Last Updated: Feb-25-2009
*/

if(file_exists('mysql.class.php'))
  require_once('mysql.class.php');

# For this example, our MySQL host will be localhost
# our MySQL username will be root, no password and
# our database name will be database ;) Aren't I creative?

# Using the default constructor...
$db = new MySQL('localhost', 'root', null, 'database');

# Or the connect method.
$db = new MySQL();
$db->connect('localhost', 'root', null, 'database');

# If you want to select a different database, you can:
$db->select_db('new_databaseName');

# Querying the database... Just a random SELECT.
$result = $db->query('SELECT * FROM `the_table`');

# Or maybe one with a variable..?
$result = $db->query("SELECT * FROM `the_table` WHERE colName = '". $db->escape($_GET['someVar']). "'");

# Anything found?
if($db->num_rows($result))
{
  # Something was found ;)
  echo '<pre>';
  # An array...
  print_r($db->fetch_array($result));
  # An associative array.
  print_r($db->fetch_assoc($result));
  # Fetch the row (numerical)
  print_r($db->fetch_row($result));
  echo '</pre>';

  # Free the result I guess...
  $db->free_result($result);
}

# An insert...
$success = $db->query("INSERT INTO `the_table` (`colName`,`anotherCol`) VALUES('aValue','anotherValue')");

if($success)
{
  # Maybe a last id..?
  echo 'Query a success! Last Insert ID: ', $db->last_id();
}
else
  # Error..?
  echo 'Error: ', $db->error();

# Thats all for now, more to be documented soon!
?>