<?php
include "../../config.php";
include "../../function.php";
$id=$_REQUEST['id'];
$classcode=getcolumn("courses","classcode",$_POST['cid']);
?>
<script>
document.getElementById('classcode').value='<?php echo $classcode;?>';
</script>
<?php
//echo $_POST['subject'];
?>

<select name="scid" id="scid"  required onChange="loadcourses(cid.value,this.value,'<?php echo $_POST['subject']?>')" >
    <option value=""><--- Select Sub Course Name ---></option>
    <?php		$rs=mysqli_query($con,"select id,name from subcourse where cid=$_POST[cid]");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($id) && $id==$cdata['id']){ echo "selected";}?>><?php echo $cdata['name'];?></option>
                <?php	
			}
		?>
</select>