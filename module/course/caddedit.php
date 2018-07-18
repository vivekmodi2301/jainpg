<?php
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$course=mysqli_fetch_assoc(mysqli_query($con,"select id,coursename,classcode from courses where id=$id"));
	}
	if(isset($_POST['coursename'])){
		addEdit('courses',$_POST,$id);
		?>
        	<script>
				location.href="index.php?mod=course&do=clist";
			</script>
        <?php	
	}
?>
<form method="post">
<table class="<?php echo $theam;?>_form">
	<tr>
    	<td colspan="2">Add/Update courses</td>
    </tr>
    <tr>
    	<td>Coursename</td>
    	<td><input type="text" value="<?php if(isset($course['coursename']) && $course['coursename']){ echo $course['coursename'];}?>" name="coursename"></td>
    </tr>
    <tr>
    	<td>Class Code</td>
    	<td><input type="text" value="<?php if(isset($course['classcode']) && $course['classcode']){ echo $course['classcode'];}?>" name="classcode"></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" vlaue="Submit"></td>
    </tr>
</table>
</form>