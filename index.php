<html>
<head>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
 
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
 
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#example').dataTable( {
    	"bSort" : false,
    	//"aaSorting" : [[]],
        "bPaginate" : false
    } );
    fnShowHide(8);
    fnShowHide(9);
    fnShowHide(10);
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
<a href="javascript:void(0);" onclick="fnShowHide(0);">id</a>
<a href="javascript:void(0);" onclick="fnShowHide(1);">datetime</a>
<a href="javascript:void(0);" onclick="fnShowHide(2);">ip</a>
<a href="javascript:void(0);" onclick="fnShowHide(3);">hostname</a>
<a href="javascript:void(0);" onclick="fnShowHide(4);">uri</a>
<a href="javascript:void(0);" onclick="fnShowHide(5);">agent</a>
<a href="javascript:void(0);" onclick="fnShowHide(6);">referer</a>
<a href="javascript:void(0);" onclick="fnShowHide(7);">domain</a>
<a href="javascript:void(0);" onclick="fnShowHide(8);">filename</a>
<a href="javascript:void(0);" onclick="fnShowHide(9);">method</a>
<a href="javascript:void(0);" onclick="fnShowHide(10);">data</a>
<br>

<table class="table table-striped table-bordered table-condensed table-hover" id="example">
<thead>
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
</thead>
<tbody>

<?php
include ('logdb.php');

$limit = 5000;
//if(isset($_GET['l'])) $limit = $_GET['l'];

$sql = "SELECT * FROM hits ORDER BY id DESC LIMIT " . $limit;
$result = mysqli_query($con, $sql);

function make_whois($inp)
{
	return '<a href="http://whois.domaintools.com/' . $inp . '" >' . $inp . '</a>';
} 

while($row = mysqli_fetch_array($result))
{
	/*
	$ab = $row['agent'];
	$pos = strpos($row['agent'], 'MSIE');
	if ($pos !== false) 
	{
		$pos2 = strpos($row['agent'], ';', $pos);
    	$row['agent'] = trim(substr($row['agent'], $pos, $pos2 - $pos));
	}
	$pos = strrpos($row['agent'], ')');
	if ($pos !== false) 
	{
		$pos++;
		$row['agent'] = trim(substr($row['agent'], $pos));
    }
    if($row['agent']=="") $row['agent']=substr($ab, 0, 20);
    */
	echo "\n";
	echo "<tr>\n";
	echo "<td>" . $row['id'] . "</td>\n";
	echo "<td>" . $row['datetime'] . "</td>\n";
	echo "<td>" . make_whois($row['ip']) . "</td>\n";
	$hostname = @gethostbyaddr($row['ip']);
	if($hostname != $row['ip'])
		echo "<td>" . $hostname . "</td>\n";
	else
		echo "<td></td>\n";
	echo "<td>" . $row['uri'] . "</td>\n";
	echo "<td>" . $row['agent'] . "</td>\n";
	echo "<td>" . $row['referer'] . "</td>\n";
	echo "<td>" . $row['domain'] . "</td>\n";
	echo "<td>" . $row['filename'] . "</td>\n";
	echo "<td>" . $row['method'] . "</td>\n";
	echo "<td>" . $row['data'] . "</td>\n";
	echo "</tr>\n";
}

mysqli_close($con);
?>

</tbody>
</table>

</body>
</html>

