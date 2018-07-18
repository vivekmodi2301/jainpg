<?php
	if(isset($_GET['id'])){
		deleteData('subcourse',$id);	
	}
?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="8">Courses Details</td>
    </tr>
	
    <tr>
    	<td colspan="8" align="right"><a href="index.php?mod=course&do=scaddedit">Add New Course</a></td>
    </tr>
    <tr>
    	<td>S.No.</td>
        <td>Course Name</td>
        <td>Year</td>
        <td>Total Fees</td>
        <td>Instalment First</td>
        <td>Instalment Second</td>
        <td>Total Group</td>
        <td>Action</td>
    </tr>
    <?php
$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,'SELECT COUNT(*) AS tot from courses left join subcourse on cid=courses.id LIMIT 1') ;
		$totRslt=mysqli_fetch_assoc($rs);
  
$i=0;

			$list=mysqli_query($con,"select subcourse.id,courses.coursename,total_group, subcourse.name, fees, instalment1, instalment2 from courses left join subcourse on cid=courses.id order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);


		$i=1;
		while($course=mysqli_fetch_assoc($list)){
	?>
    <tr>
   		<td><?php echo $i++;?></td>
        <td><?php echo $course['coursename'];?></td>
        <td><?php echo $course['name'];?></td>
        <td><?php echo $course['fees'];?></td>
        <td><?php echo $course['instalment1'];?></td>
        <td><?php echo $course['instalment2'];?></td>
        <td><?php echo $course['total_group'];?></td>
        <td><a href="index.php?mod=course&do=scaddedit&id=<?php echo $course['id'];?>">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onClick="deletedata(<?php echo $course['id'];?>)">Delete</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="10">
		<?php PaginationDisplay($totRslt['tot'],'index.php?mod=course&do=sclist&pageNumber=','');?>
</td>
    </tr>
</table>
<div>

</div>
<script>
	function deletedata(id){
		if(confirm("Do you really want to delete")){
			location.href="index.php?mod=course&do=sclist&id="+id;	
		}
	}
</script>