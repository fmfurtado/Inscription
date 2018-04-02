<?php 
      require_once 'configuration.php';
      $config = new EBBConfig();
      include("password_protect.php");
?>

<?php

function display_db_table($query_string, $connection, $header_bool, $table_params) {

	// perform the database query
	$result_id = mysql_query($query_string, $connection) or die("display_db_query:" . mysql_error());
	
	// find out the number of columns in result
	$column_count = mysql_num_fields($result_id) or die("display_db_query:" . mysql_error());
	
	// Here the table attributes from the $table_params variable are added
	print("<TABLE $table_params >\n");
	
	// optionally print a bold header at top of table
	if($header_bool) {
		print("<TR>");
		for($column_num = 0; $column_num < $column_count; $column_num++) {
			$field_name = mysql_field_name($result_id, $column_num);
			print("<TH>$field_name</TH>");
		}
		print("</TR>\n");
	}

	// print the body of the table
	while($row = mysql_fetch_row($result_id)) {
		print("<TR ALIGN=LEFT VALIGN=TOP>");
		for($column_num = 0; $column_num < $column_count; $column_num++) {
			print("<TD>$row[$column_num]&nbsp;</TD>\n");
		}
		print("</TR>\n");
	}
	print("</TABLE>\n"); 
}

?>


<HTML>
<HEAD>
    <TITLE><?= $config->title ?></TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</HEAD>

<BODY>

<br/>

<?php
$connection = mysql_connect($config->server, $config->username, $config->password) or die("Could not connect to database");
mysql_select_db($config->database_name, $connection) or die("Could not select database");

// Show the table
$query_string = "SELECT * FROM $config->inscription_table order by id";
display_db_table($query_string, $connection, TRUE, "border='2'");
?>

<br/>

<form action="admin.php">
  <input type="submit" value="Logout"/>
  <input type="hidden" value="1" name="logout"/>
</form>

</BODY>
</HTML>