<?php
	if(isset($_GET['id'])){
		deleteData('courses',$id);	
	}
?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="4">Courses List</td>
    </tr>
    <tr>
    	<td colspan="4" align="right"><a href="index.php?mod=course&do=caddedit">Add New Course</a></td>
    </tr>
	<tr>
    	<td>S.No.</td>
        <td>Course Name</td>
        <td>Course Name</td>
        <td>Action</td>
    </tr>
    
    <?php
	$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,'SELECT COUNT(*) AS tot FROM courses LIMIT 1') ;
		$totRslt=mysqli_fetch_assoc($rs);
  
$i=0;

			$list=mysqli_query($con,"select id,coursename,classcode from courses order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);

		$i=1;
		while($course=mysqli_fetch_assoc($list)){
	?>
    <tr>
   		<td><?php echo $i++;?></td>
        <td><?php echo $course['coursename'];?></td>
        <td><?php echo $course['classcode'];?></td>
        <td><a href="index.php?mod=course&do=caddedit&id=<?php echo $course['id'];?>">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onClick="deletedata(<?php echo $course['id'];?>)">Delete</a></td>
    </tr>
    <?php
		}
	?>
    <tr>
    	<td colspan="10"><?php PaginationDisplay($totRslt['tot'],'index.php?mod=course&do=clist&pageNumber=','');?>
</td>
    </tr>
</table>
<div>

</div>
<script>
	function deletedata(id){
		if(confirm("Do you really want to delete")){
			location.href="index.php?mod=course&do=clist&id="+id;	
		}
	}
</script>