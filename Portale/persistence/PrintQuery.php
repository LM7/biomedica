<?php
   $filename="sheet.xls";
   header ("Content-Type: application/vnd.ms-excel");
   header ("Content-Disposition: inline; filename=$filename");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang=it><head>
<title>Titolo</title></head>
<body>
<table border="1">
<?php
include 'Query.php';
$q = new Query();
$pat = new Patient(0,306);
$cns = new Cns();
$tongue = new Tongue(0,0,'n');
$result = $q -> queryMultiple(0,$cns,0,0,0,0,0,$tongue);
echo $q -> show($result,0,$cns,0,0,0,0,0,$tongue);
?>
</table>
</body></html>