<?php

	$id="";
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$grouprs=mysqli_query($con,"SELECT id, gname, cid, groupsub, scid FROM subjectgroup where id=$id");
		$groupdata=mysqli_fetch_assoc($grouprs);
	}
	if(isset($_POST['cid'])){
		if(isset($_POST['groupsub']))
		{
			$_POST['groupsub']=implode(', ',$_POST['groupsub']);
			//echo $_POST['groupsub'];
			//exit;
		}
		addEdit('subjectgroup',$_POST,$id);
		?>
		<script>location.href="index.php?mod=group&do=groupedit";</script>
		<?php	
	}
?>
<form method="post">
<table class="<?php echo $theam;?>_form">
	<tr>
    	<th colspan="2">Create Group of Subjects</th>
     </tr>   
	<tr>	
		<td>
			Select Stream
		</td>
<td>
    <select name="cid" id="cid" onchange="course(this.value,'','')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses ");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($groupdata['cid']) && $groupdata['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
                <?php	
			}
		?>
    </select>
</td></tr>

	<tr>	
		<td>
			Select Year
		</td>
        <td id="scid">
            <select name="scid">
                <option value=""><--- Select Sub Coursename ---></option>
             
            </select>
        </td>
	</tr>
	<tr>
    	<td>Courses</td>
        <td id="courses"> </td>
    </tr>
    <tr>
    	<td>Group Name</td>
        <td><input type="text" name="gname" value="<?php if(isset($groupdata['gname'])){ echo $groupdata['gname']; } ?> " /></td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
    	<td><input type="submit" /></td>
    </tr>
    
</table>
</form>
<script>
function course(cval,scval,groupsub)
{
	$.ajax({
		url:"module/group/subcoursesload.php",
		data: 'cid='+cval+'&id='+scval,
		type:'GET',
		success: function(res){
			
			$('#scid').html(res);
			if(scval)
			{
				loadcourses(cval,scval,groupsub);
				}
			}
	});
}
function loadcourses(cval,scval,groupsub)
{
	
		var cval=encodeURIComponent(cval);
		var scval=encodeURIComponent(scval);
		var groupsub= encodeURIComponent(groupsub);
	$.ajax({
		url: "module/group/loadcourses.php",
		data: 'cid='+cval+'&scid='+scval+'&groupsub='+groupsub,
		type:'GET',
		success: function(as){$('#courses').html(as);}
	});
}
<?php if($id){?>
$(document).ready(function(e) {
    course(cid.value,'<?php echo $groupdata['scid'];?>','<?php echo $groupdata['groupsub'];?>');
	
});
		<?php } ?>
</script>	