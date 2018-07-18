<?php
include "../../config.php";
include "../../function.php";
$groupsub=array();
if(isset($_GET['groupsub']))
{
	$groupsub=explode(', ',$_GET['groupsub']);
}
$rs=mysqli_query($con,"select id,name from subject where cid=$_GET[cid] && scid=$_GET[scid]");
while($cdata=mysqli_fetch_assoc($rs)){
?>
<input type="checkbox" name="groupsub[]" <?php if(in_array($cdata['name'],$groupsub)){?> checked="checked"<?php }?> value="<?php echo $cdata['name']?>"/><?php echo $cdata['name']?>
<?php				
}?>
 