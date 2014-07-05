<?php  include 'model/Patient.php';
$ciao='hello world!';
$ciao2='how are u?';
$ciao3='bye';
$pat = new Patient();
               $q = $pat->__get("ng");
               echo $q;
?>
<a>
<table>
<tr>
<td><?=$ciao?></td>
<td><?=$ciao2?></td>
</tr>
<tr>
<td><?=$ciao?></td>
<td><?=$ciao2?></td>
</tr>
</table>
</a>