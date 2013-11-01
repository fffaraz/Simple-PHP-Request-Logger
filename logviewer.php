<?php
include ('logdb.php');

$sql = "SELECT * FROM hits ORDER BY id DESC";
$result = mysqli_query($con, $sql);

echo "<center>
<table border='1'>
<tr>
<th>id</th>
<th>datetime</th>
<th>ip</th>
<th>hostname</th>
<th>uri</th>
<th>agent</th>
<th>referer</th>
<th>domain</th>
<th>filename</th>
<th>method</th>
<th>data</th>
</tr>\n";

while($row = mysqli_fetch_array($result))
{
	echo "\n";
	echo "<tr>\n";
	echo "<td>" . $row['id'] . "</td>\n";
	echo "<td>" . $row['datetime'] . "</td>\n";
	echo "<td>" . $row['ip'] . "</td>\n";
	echo "<td>" . @gethostbyaddr($row['ip']) . "</td>\n";
	echo "<td>" . $row['uri'] . "</td>\n";
	echo "<td>" . $row['agent'] . "</td>\n";
	echo "<td>" . $row['referer'] . "</td>\n";
	echo "<td>" . $row['domain'] . "</td>\n";
	echo "<td>" . $row['filename'] . "</td>\n";
	echo "<td>" . $row['method'] . "</td>\n";
	echo "<td>" . $row['data'] . "</td>\n";
	echo "</tr>\n";
}

echo "\n</table>\n<center>\n\n";

mysqli_close($con);
