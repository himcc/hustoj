<?
session_start();
if (!isset($_SESSION['administrator'])){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
require_once("../include/db_info.inc.php");

if($_POST['do']=='do'){
	$start=addslashes($_POST['start']);
	$end=addslashes($_POST['end']);
	$sql="select * from problem where problem_id>=$start and problem_id<=$end";
	//echo $sql;
	$result=mysql_query($sql) or die(mysql_error());
   header('Content-Type:   text/xml'); 
   echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

 <fps version="1.0">
 <?
 while ($row = mysql_fetch_object($result)) {
	 
 ?>
   <item>
     <title><![CDATA[<?=$row->title?>]]></title>
     <time_limit><![CDATA[<?=$row->time_limit?>]]></time_limit>
     <memory_limit><![CDATA[<?=$row->memory_limit?>]]></memory_limit>
     <description><![CDATA[<?=$row->description?>]]></description>
     <input><![CDATA[<?=$row->input?>]]></input>
     <output><![CDATA[<?=$row->output?>]]></output>
     <sample_input><![CDATA[<?=$row->sample_input?>]]></sample_input>
     <sample_output><![CDATA[<?=$row->sample_output?>]]></sample_output>
     <test_input><![CDATA[<?=$row->test_input?>]]></test_input>
     <test_output><![CDATA[<?=$row->test_output?>]]></test_output>
     <hint><![CDATA[<?=$row->hint?>]]></hint>
     <source><![CDATA[<?=$row->source?>]]></source>
     <spj><![CDATA[<?=$row->spj?>]]></spj>
   </item>

 
<?
}
mysql_free_result($result);
 
echo "</fps>";

}
?>