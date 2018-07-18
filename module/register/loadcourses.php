
<?php
include "../../config.php";
include "../../function.php";
//$_POST['subject']=urldecode($_POST['subject']);

urldecode($_POST['subject']);
$total_group_data=mysqli_fetch_assoc(mysqli_query($con,"select total_group from subcourse where cid=$_POST[cid]"));
//echo "select total_group from subcourse where cid=$_GET[cid]";
//echo $total_group_data['total_group'];
$rs=mysqli_query($con,"select id,groupsub,gname,cid,scid from subjectgroup where cid=$_POST[cid] && scid=$_POST[scid]");
$_POST['subject'];

$j=0;

while($cdata=mysqli_fetch_assoc($rs)){

$subject_names=explode(', ',$cdata['groupsub']);
$f=0;
for($i=0;$i<count($subject_names);$i++){
$subjects=explode(',',$_POST['subject']);
	if(in_array($subject_names[$i],$subjects)){
		$f=1;	
		break;
	}
}

?>
<input type="radio" name="groupid" value="<?php echo $cdata['id'];?>" id="group"  onChange="mshow(this,'.r<?php echo $j;?>','<?php echo $total_group_data['total_group'];?>')" <?php if($f) {?> checked="checked" <?php }?> ><strong><label><?php echo $cdata['gname']?></label> - </strong>
<span><?php 


for($i=0;$i<count($subject_names);$i++){
?>
<input type="checkbox" class="r<?php echo $j;?>" name="courses[]" value="<?php echo $subject_names[$i]?>" 

<?php $subjects=explode(',',$_POST['subject']);
if(in_array($subject_names[$i],$subjects)){
echo "checked ";
		
} if(!$f){ echo "disabled"; } ?> required /><?php echo $subject_names[$i];

	//print_r($subjects);

?>
<?php
}


?></span>


<?php	
echo "<br/>";
$j++;			
}?>
