<?php
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$course=mysqli_fetch_assoc(mysqli_query($con,"select id,subname from compulsorysubject where id=$id"));
	}
	if(isset($_POST['subname'])){
		addEdit('compulsorysubject',$_POST,$id);
		?>
        	<script>
				location.href="index.php?mod=course&do=complist";
			</script>
        <?php	
	}
?>
<form method="post">
<table class="<?php echo $theam;?>_form">
	<tr>
    	<td colspan="2">Add/Update Coumplsory Subject</td>
    </tr>
    <tr>
    	<td>Subject name</td>
    	<td><input type="text" value="<?php if(isset($course['subname']) && $course['subname']){ echo $course['subname'];}?>" name="subname"></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" vlaue="Submit"></td>
    </tr>
</table>
</form>