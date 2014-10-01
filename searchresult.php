<!DOCTYPE HTML PUBLIC
                 "-//W3C//DTD HTML 4.01 Transitional//EN"
                 "http://www.w3.org/TR/html401/loose.dtd"/>
<html>
<head>
	<title>Search Result</title>
	<style>
	table
	{
		border: 1px solid black;
		padding: 5px;
		align: center;
		margin: auto;
	}
	
	th, td
	{
		padding: 10px;
	}
	</style>
</head>
<body>
	
<?php
	require 'db.inc';
	
	//Obtaining user input
	$wine = $_GET['winename'];
	$region = $_GET['regions'];
	$winery = $_GET['wineryname'];
	$yearstart = $_GET['startyear'];
	$yearend = $_GET['endyear'];
	$minimal = $_GET['minstock'];
	$customer = $_GET['customerno'];
	$minimalprice = $_GET['minprice'];
	$maximalprice = $_GET['maxprice'];
	
	//Year and Price validation
	if($yearstart > $yearend || $minimalprice > $maximalprice)
	{
		displayvalidationerror();
	}
	
	//showing error message if validation is wrong
	function displayvalidationerror()
	{
		print '<table>
	
		<tr>
			<th rowspan="2"  align="center">
				<img src="logo.png" alt="Wine Store" 
				style="float:left; 
				width:120px;
				height:120px;"
				/>
			</th>
			<th style="font-size:32px">
				<br/>
				Wine Store Search
			</th>
			
			<tr>
				<td style="font-size:10px">
					Created by Antonius Hilman
				</td>
			</tr>
		</tr>
		
		<tr>
			<th colspan="2" style="text-align:center; font-size:20px">
				Search Result
			</th>
		</tr>
			<tr>
			<td colspan ="2" >I am sorry</td>
			</tr>
			<tr>
			<td colspan="2"> Please ensure your minimum year or price is lesser than the maximum</td>
			</tr>
			<tr>
			<td colspan="2"> Press back to return to previous page</td>
			</tr>
			<tr>
			<td><a href="../Assignment1/winesearch.php"><input type="submit" value = "back"/></a>
			</tr>
			</table>';
	}
	
	//showing the wines result in tables that is correct
	function displaycorrectresults($results)
	{
		print '<h1 style="margin: auto"> Search Result </h1>';
		
		//tables
		print "<table>
		<tr>
		<th>Wine Name</th>
		<th>Wine Variety</th>
		<th>Year</th>
		<th>Winery</th>
		<th>Region</th>
		<th>Cost</th>
		<th>Availability</th>
		<th>Customer who had purchased</th>
		</tr>";
	}

?>

</body>
</html>
	
