<?php
$pageNumber='1';
if(isset($_GET['pageNumber'])){
	$pageNumber=$_GET['pageNumber'];
}
$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$subjectdte=mysqli_fetch_assoc(mysqli_query($con,"select id,cid,scid,name,extraFees from subject where id=$id"));
	}
	if(isset($_POST['cid'])){
		addEdit('subject',$_POST,$id);	?>
		<script>
			location.href="index.php?mod=subject&do=list&pageNumber=<?php echo $pageNumber;?>";
		</script>
        <?php
	}
?>	
<form method="post">
<table cellspacing="0px" class="<?php echo $theam;?>_form">
<tr>
	<td colspan="2">Subjects</td>
</tr>
<tr>	
<td>
Select Stream
</td>
<td>
    <select name="cid" id="cid" onchange="course(this.value,'')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($subjectdte['cid']) && $subjectdte['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
                <?php }?>
    </select>
</td>
</tr>
<tr>
<td>
Select Year
</td> 
<td><select id="subcourse" name="scid">
    	<option value=""><--- Select Year ---></option>
    </select>
</td>
</tr>
<tr>
	<td>Subject Name</td>
    <td><input type="text" value="<?php echo $subjectdte['name'];?>" name="name"></td>
</tr>
<tr>
	<td>Extra Fees</td>
    <td><input type="text" value="<?php echo $subjectdte['extraFees'];?>" name="extraFees"></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="submit"></td>
</tr>
</table>
</form>
<script src="js/jquery.js.js"></script>
<script>
	function course(cid,scid){
	$.ajax({
	url:"module/register/subcourse.php",
	data:"cid="+cid+"&scid="+scid,
	type:'POST',
	success: function(data){
		$('#subcourse').html(data);
	},
	});
 	}
	<?php if($id){?>
	$(document).ready(function(e) {
        course(cid.value,'<?php echo $subjectdte['scid'];?>');
    });
	<?php }?>
</script>