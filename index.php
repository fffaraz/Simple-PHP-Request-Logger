<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
 
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
 
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#example').dataTable( {
        "sScrollY": "200px",
        "bPaginate": false
    } );
} );
 
function fnShowHide( iCol )
{
    /* Get the DataTables object again - this is not a recreation, just a get of the object */
    var oTable = $('#example').dataTable();
     
    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
    oTable.fnSetColumnVis( iCol, bVis ? false : true );
}

</script>

</head>
<body>
<a href="javascript:void(0);" onclick="fnShowHide(0);">id<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(1);">datetime<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(2);">ip<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(3);">hostname<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(4);">uri<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(5);">agent<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(6);">referer<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(7);">domain<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(8);">filename<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(9);">method<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(9);">data<br></a>
<center>
<table class="table table-striped table-bordered table-condensed table-hover" id="example">
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
</tr>

<?php
include ('logdb.php');

$sql = "SELECT * FROM hits ORDER BY id DESC";
$result = mysqli_query($con, $sql);

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

echo "\n</table>\n<center>\n";
mysqli_close($con);
?>

</body>
</html>

