<?php
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
$vari=mysql_real_escape_string($_REQUEST['identity']);
$coun=mysql_real_escape_string($_REQUEST['num_co']);
$i=1;
$query="";
$count=0;
for($i=1;$i<=$coun;$i++)
{
		if($query==NULL)
		{
			$query="'$val[$i]'";
		}
		else
		{
			$query="$query,'$val[$i]'";
		}
}

$numrows=0;
if($numrows==0)
{
	mysql_query("INSERT INTO $vari VALUE($query)") or die('could not enter '. mysql_error());
	}       
	else    
	{
			die("<h2 id=\"header\">Already registered Can't modyfy data</h2>");
	}
echo "<h1>done</h1>";
mysql_close($con);
?>
