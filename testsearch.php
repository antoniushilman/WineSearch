<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd"/>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Wines</title>
</head>
<body>
<?php
$region = $_GET['regions'];
$connection = mysqli_connect("localhost","root","gg.com","winestore");
$result = mysqli_query ($connection,"SELECT region_name FROM region");
$i = 0;
while ($row=mysqli_fetch_array($result))
{
	if($i == $region)
	{
		print $row["region_name"];
		break;
	}
	else
	{
		$i++;
	}
}
?>
</body>
</html>
	
