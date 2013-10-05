<html>
<head>
	<link rel="stylesheet" type="text/css" href="structure.css">	
	<link rel="stylesheet" type="text/css" href="another1.css">
</head>
<body>

<?php
function submit($ident,$valu1,$valu2,$valu3,$valu4,$valu5,$valu6,$valu7,$valu8)
{
	echo "<form action='database1.php' method='post' name='myform' >";
	echo "<input type='hidden' name='val1' value='$valu1' />
		<input type='hidden' name='val2' value='$valu2' />
		<input type='hidden' name='val3' value='$valu3' />
		<input type='hidden' name='val4' value='$valu4' />
		<input type='hidden' name='val5' value='$valu5' />
		<input type='hidden' name='val6' value='$valu6' />
		<input type='hidden' name='val7' value='$valu7' />
		<input type='hidden' name='val8' value='$valu8' />
		<input type='hidden' name='identity' value='$ident' />
		<script language='Javascript'>document.myform.submit();</script></form>";
//	    document.getElementById("lostpasswordform").click(); // Simulates button click
//	        document.lostpasswordform.submit(); // Submits the form without the button

}
session_start();
include 'login.php';
$val[1]=mysql_real_escape_string($_REQUEST['val1']);
$val[2]=mysql_real_escape_string($_REQUEST['val2']);
$val[3]=mysql_real_escape_string($_REQUEST['val3']);
$val[4]=mysql_real_escape_string($_REQUEST['val4']);
$val[5]=mysql_real_escape_string($_REQUEST['val5']);
$val[6]=mysql_real_escape_string($_REQUEST['val6']);
$val[7]=mysql_real_escape_string($_REQUEST['val7']);
$val[8]=mysql_real_escape_string($_REQUEST['val8']);
$ident=mysql_real_escape_string($_REQUEST['identity']);
//echo $val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8;
$i=1;
$query="";
$count=0;
for($i=1;$i<9;$i++)
{
	if($val[$i]!=NULL)
	{
		$var1[$count]=$val[$i];
		$count++;
		if($query==NULL)
		{
			$query="$val[$i]";
		}
		else
		{
			$query="$query,$val[$i]";
		}
	}
}

//echo $query;
$kk1="ssn,name,sex";
$prim=mysql_query("select Column_name from information_schema.columns where table_schema = 'hazzel' and table_name ='$ident' and column_key='PRI'");
$prim_result=mysql_result($prim, 0 , 'Column_name' );
$del=-1;
$del=$_REQUEST['deleting'];
//ho "fyck   ",$del,"  dss";

if($del>0)
{
	$del=$del-1;
//	echo $del;
	$query2=mysql_query("select $prim_result from $ident");
	$del_result = mysql_result($query2, $del, $prim_result );
	$del_query=mysql_query("delete from $ident where $prim_result=$del_result");
	submit($ident,$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8]);
}
$query1=mysql_query("select $query from $ident");

//echo "dfsf",$query1,"sfsdf";
$numrows = mysql_num_rows($query1);
//echo "<table border='1' align='center'>";
echo "<table id='box-table-a' border='3' align='center'>";
echo "<tr>";
for($j=0;$j<$count;$j++)
{
	echo "<th>$var1[$j]</th>";
}
echo "<th>Delete</th>";
echo "</tr>";
$edt=mysql_real_escape_string($_REQUEST['edit']);
$chang=mysql_real_escape_string($_REQUEST['change']);
if($chang)
{
	$prim = mysql_query("select Column_name from information_schema.columns where table_schema = 'hazzel' and table_name = '$ident' and column_key='PRI'");
	$prim_result = mysql_result($prim,0,'Column_name');
	$query2=mysql_query("select $prim_result from $ident");
	$no_row=mysql_real_escape_string($_REQUEST['row_no']);
	$primary_key = mysql_result($query2,$no_row,$prim_result);
	for($j=0;$j<$count;$j++)
	{
		$ch_val=$_REQUEST[$var1[$j]];
	//	echo $ident,$var1[$j],$ch_val;
		mysql_query("update $ident set $var1[$j]='$ch_val' where $prim_result=$primary_key");
	}
	submit($ident,$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8]);

}
if($edt)
{
	for($i=0;$i<$numrows;$i++)
	{
		echo "<form action='database1.php' method='post'>";
		echo "<input type='hidden' name='change' value='yes'>
			<input type='hidden' name='val1' value='$val[1]' />
			<input type='hidden' name='val2' value='$val[2]' />
			<input type='hidden' name='val3' value='$val[3]' />
			<input type='hidden' name='val4' value='$val[4]' />
			<input type='hidden' name='val5' value='$val[5]' />
			<input type='hidden' name='val6' value='$val[6]' />
			<input type='hidden' name='val7' value='$val[7]' />
			<input type='hidden' name='val8' value='$val[8]' />
			<input type='hidden' name='row_no' value='$i' />
			<input type='hidden' name='identity' value='$ident' />";
		echo "<tr>";
		for($j=0;$j<$count;$j++)
		{
			$variable=mysql_result($query1,$i,$var1[$j]);
			echo "<td><input type='text' name='$var1[$j]' value='$variable'</td>";
		}
		echo "<td><input type='submit' value='Change'></td></tr>";
		echo "</form>";
	}
}
else
{
$query1=mysql_query("select $query from $ident");

for($i=0;$i<$numrows;$i++)
{
	echo "<tr>";
	for($j=0;$j<$count;$j++)
	{
		$variable=mysql_result($query1,$i,$var1[$j]);
		echo "<td>$variable</td>";
	}
	$k=$i+1;
	echo "<td>";
	echo "<form action='database1.php' method='post'>";
	echo "<input type='hidden' name='deleting' value='$k'>";

	echo "<input type='hidden' name='val1' value='$val[1]'>";
	echo "<input type='hidden' name='val2' value='$val[2]'>";
	echo "<input type='hidden' name='val3' value='$val[3]'>";
	echo "<input type='hidden' name='val4' value='$val[4]'>";
	echo "<input type='hidden' name='val5' value='$val[5]'>";
	echo "<input type='hidden' name='val6' value='$val[6]'>";
	echo "<input type='hidden' name='val7' value='$val[7]'>";
	echo "<input type='hidden' name='val8' value='$val[8]'>";
	echo "<input type='hidden' name='identity' value='$ident'>";
	echo "<input type='submit' value='Delete'>";

	echo "</form>";
	echo "</td>";

	echo "</tr>";
}
echo "<form action='database1.php' method='post'>";
echo "<input type='hidden' name='edit' value='yes'>
<input type='hidden' name='val1' value='$val[1]' />
<input type='hidden' name='val2' value='$val[2]' />
<input type='hidden' name='val3' value='$val[3]' />
<input type='hidden' name='val4' value='$val[4]' />
<input type='hidden' name='val5' value='$val[5]' />
<input type='hidden' name='val6' value='$val[6]' />
<input type='hidden' name='val7' value='$val[7]' />
<input type='hidden' name='val8' value='$val[8]' />
<input type='hidden' name='identity' value='$ident' />
<input type='submit' value='Edit'>
</form>";
}
echo "</table>";


?>
</body>
</html>
