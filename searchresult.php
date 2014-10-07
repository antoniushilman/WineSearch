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
		text-align: center;
		padding: 15px;
		margin:auto;
	}
	</style>
</head>
<body>
	
<?php
	require 'db.inc';
	
	//Obtaining user input
	$regionid = 0;
	$wine = $_GET['winename'];
	$region = $_GET['regions'];
	$wineryname = $_GET['wineryname'];
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
				Wine Store Search Result
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
	function displaycorrectresults($result)
	{
		//table 1
		if(mysqli_num_rows($result) == 0)
		{
			print '<table>
			<tr>
			<th style="font-size:32px; text-align:left" colspan="9" align="center">
				<img src="logo.png" alt="Wine Store" 
				style="float:left; 
				width:120px;
				height:120px;"
				/>
					Wine Store Search
				<p style="font-size:10px">
					Created by Antonius Hilman
				</p>
			</th>
			</tr>
			
			<tr>
			<th colspan="2" style="text-align:center; font-size:20px">
				Search Result
			</th>
			</tr>
			
			<tr>
				<td>
					No search found
				</td>
			</tr>
			
			</table>';
		}
		else
		{
		//table 2
		print '<table>
	
		<tr>
			<th style="font-size:32px; text-align:left" colspan="9" align="center">
				<img src="logo.png" alt="Wine Store" 
				style="float:left; 
				width:120px;
				height:120px;"
				/>
					Wine Store Search
				<p style="font-size:10px">
					Created by Antonius Hilman
				</p>
			</th>
		</tr>
		<tr>
			<th colspan="9" style="text-align:center; font-size:20px">
				Search Result
			</th>
		</tr>
		<tr>
			<th>Wine Name</th>
			<th>Wine Variety</th>
			<th>Year</th>
			<th>Winery</th>
			<th>Region</th>
			<th>Cost</th>
			<th>Availability</th>
			<th>No. Customer</th>
		</tr>';
		
		// Until there are no rows in the result set, fetch a row into
		// the $row array and ...
		while ($row =  mysqli_fetch_array($result))
		{
			// ... start a TABLE row ...
			echo "<tr>";
			// ... and print out each of the attributes in that row as 
			// a separate TD (Table Data).
			echo "<td>".($row["wine_name"])."</td>";
			echo "<td>".($row["wine_type"])."</td>";
			echo "<td>".($row["year"])."</td>";
			echo "<td>".($row["winery_name"])."</td>";
			echo "<td>".($row["region_name"])."</td>";
			echo "<td>".($row["cost"])."</td>";
			echo "<td>".($row["on_hand"])."</td>";
			echo "<td>".($row["qty"])."</td>";
			// Finish the row
			echo "</tr>";
		}
			print "</table>";
		}
	}
	
	//Validation if no input
	
	if($wine == NULL)
	{
		$wine = "";
	}
	
	if($wineryname == NULL)
	{
		$wineryname = "";
	}
	
	if($region == "All")
	{
		$region = "";
	}
	
	if($yearstart == NULL)
	{
		$yearstart = 1970;
	}
	
	if($yearend == NULL)
	{
		$yearend = 1999;
	}
	
	if($minimal == NULL)
	{
		$minimal = 0;
	}
	
	if($customer == NULL)
	{
		$customer = 0;
	}
	
	if($minimalprice == NULL)
	{
		$minimalprice = 0;
	}
	
	if($maximalprice == NULL)
	{
		$maximalprice = 1000;
	}
	
	//query for all user input
	$query = "SELECT 
	wine_name, wine_type, year, winery_name, region_name, cost, qty, on_hand 
	FROM 
	wine, wine_type, winery, items, region, inventory
	WHERE 
	wine.winery_id = winery.winery_id AND 
	winery.region_id = region.region_id AND 
	wine.wine_id = items.wine_id AND 
	wine.wine_id = inventory.wine_id AND 
	wine_type.wine_type_id = wine.wine_type_id AND 
	
	wine_name LIKE '%".$wine."%' AND 
	winery_name LIKE '%".$wineryname."%' AND 
	region_name LIKE '%".$region."%' AND 
	on_hand >= '".$minimal."' AND 
	(year BETWEEN '".$yearstart."' AND '".$yearend."') AND 
	(cost BETWEEN '".$minimalprice."' AND '".$maximalprice."') AND 
	qty >= '".$customer."'
	";
	
	// Connect to the MySQL server
	$connection = mysqli_connect("localhost","root","gg.com","winestore");
	$result = mysqli_query ($connection, $query);

	// Display the results
	displaycorrectresults($result);
?>

</body>
</html>

	
