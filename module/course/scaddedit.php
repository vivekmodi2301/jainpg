<?php
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$course=mysqli_fetch_assoc(mysqli_query($con,"SELECT id, cid, name, fees, instalment1, instalment2, total_group FROM subcourse where id=$id"));
	}
	if(isset($_POST['name'])){
		addEdit('subcourse',$_POST,$id);
		if($id){
			$_SESSION['updatestudent']="Boys Fund Detail has been Updated";
		}
		elseif(!$id){
			$_SESSION['insertstudent']="Boys Fund Detail has been Submited";		
		}
		?>
        	<script>
				location.href="index.php?mod=course&do=sclist";
			</script>
        <?php	
	}
?>
<form method="post">
<table class="<?php echo $theam;?>_form">
	<tr>
    	<td colspan="2">Add/Update Course Detail</td>
    </tr>
    <tr><td>Course</td><td>
    	<select name="cid" id="cid" onchange="course(this.value,'')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($course['cid']) && $course['cid']==$cdata['id']){?>selected<?php }?>><?php echo $cdata['coursename'];?></option>
                <?php	
			}
		?>
    </select>
    </td>
    </tr>
    <tr>
    	<td>Year</td>
    	<td><input type="text" value="<?php if(isset($course['name']) && $course['name']){ echo $course['name'];}?>" name="name"></td>
    </tr>
    <tr>
    	<td>Total Fees</td>
    	<td><input type="text" value="<?php if(isset($course['fees']) && $course['fees']){ echo $course['fees'];}?>" name="fees"></td>
    </tr>
    <tr>
    	<td>First Installment</td>
    	<td><input type="text" value="<?php if(isset($course['instalment1']) && $course['instalment1']){ echo $course['instalment1'];}?>" name="instalment1"></td>
    </tr>
   	<tr>
    	<td>Second Installment</td>
    	<td><input type="text" value="<?php if(isset($course['instalment2']) && $course['instalment2']){ echo $course['instalment2'];}?>" name="instalment2"></td>
    </tr>
    <tr>
    	<td>Total Group</td>
    	<td><input type="text" value="<?php if(isset($course['total_group']) && $course['total_group']){ echo $course['total_group'];}?>" name="total_group"></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" vlaue="Submit"></td>
    </tr>
</table>
</form>