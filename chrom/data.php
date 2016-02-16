<?php

error_reporting(0);
#Include the connect.php file
include('config.php');
#Connect to the database
//connection String
$connect = mysql_connect($settings['mysql']['server'], $settings['mysql']['username'], $settings['mysql']['password'])
or die('Could not connect: ' . mysql_error());
//Select The database
$bool = mysql_select_db($settings['mysql']['database'], $connect);
if ($bool === False){
	print "can't find ".$settings['mysql']['database'];
}


// get data and store in a json array
$query = "SELECT * FROM users";
if (isset($_GET['ID']))
{
	$pagenum = $_GET['pagenum'];
	$pagesize = $_GET['pagesize'];
	$start = $pagenum * $pagesize;
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM users WHERE ID='" .$_GET['ID'] . "'";
	$query .= " LIMIT $start, $pagesize";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
	$rows = mysql_query($sql);
	$rows = mysql_fetch_assoc($rows);
	$total_rows = $rows['found_rows'];	
	if (isset($_GET['sortdatafield']))
	{
		$sortfield = $_GET['sortdatafield'];
		$sortorder = $_GET['sortorder'];
		
		if ($sortfield != NULL)
		{		
			if ($sortorder == "desc")
			{
				$query = "SELECT * FROM users WHERE ID='" .$_GET['ID'] . "' ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
			}
			else if ($sortorder == "asc")
			{
				$query = "SELECT * FROM users WHERE ID='" .$_GET['ID'] . "' ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
			}			
			$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
		}
	}
	// get data and store in a json array
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$orders[] = array(
		        'ID' => $row['ID'],
			'IP' => $row['IP'],
			'URL' => $row['URL'],
                         'DATE' => $row['DATE']
		  );
	}
    $data[] = array(
       'TotalRows' => $total_rows,
	   'Rows' => $orders
	);
	echo json_encode($data);    	
}
else if(isset($_POST['ID'])){
    $query = "SELECT * FROM users WHERE ID='" .$_POST['ID']."';";
    $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$orders[] = array(
		'URL_REF' => $row['URL_REF'],
                    'RAW' => $row['RAW']
		  );
	}
        echo json_encode($orders);   
}
else
{
	$pagenum = $_GET['pagenum'];
	$pagesize = $_GET['pagesize'];
	$start = $pagenum * $pagesize;
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM users order BY ID DESC LIMIT $start, $pagesize";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
	$rows = mysql_query($sql);
	$rows = mysql_fetch_assoc($rows);
	$total_rows = $rows['found_rows'];
	if (isset($_GET['sortdatafield']))
	{
		$sortfield = $_GET['sortdatafield'];
		$sortorder = $_GET['sortorder'];
		
		if ($sortfield != NULL)
		{		
			if ($sortorder == "desc")
			{
				$query = "SELECT * FROM users ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";
			}
			else if ($sortorder == "asc")
			{
				$query = "SELECT * FROM users ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";
			}			
			$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
		}
	}
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$customers[] = array(
			'ID' => $row['ID'],
			'IP' => $row['IP'],
			'URL' => $row['URL'],
			'DATE' => $row['DATE']
		  );
	}
    $data[] = array(
       'TotalRows' => $total_rows,
	   'Rows' => $customers
	);
	echo json_encode($data);
}
?>