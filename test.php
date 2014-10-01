<!DOCTYPE HTML PUBLIC
                 "-//W3C//DTD HTML 4.01 Transitional//EN"
                 "http://www.w3.org/TR/html401/loose.dtd"/>
<html>
<head>
	<title>Winery Search</title>
</head>
<body>
<form action="testsearch.php" method=get>
<p> Select Region:</p>
<br/>
<?php
					$connection = mysqli_connect("localhost","root","gg.com","winestore");
					$result = mysqli_query ($connection,"SELECT region_name FROM region");
					echo '<select name="regions">';
					$i = 0;
					while ($row=mysqli_fetch_array($result))
					{
						echo "<option value=$i>".($row["region_name"])."</option>";
						$i++;
					}
					echo "</select>";
?>
<br/>
<input type="submit" value="search"/>
