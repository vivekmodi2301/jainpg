<?php
	if(isset($_GET['id'])){
		deleteData('subject',$id);	
	}
		$url="index.php?mod=subject&do=list&";
		$wh=" where 1 ";
		if(isset($_REQUEST['name']) && $_REQUEST['name']){
			$wh.=" and subject.name like '%$_REQUEST[name]%' ";
			$url.="name=$_REQUEST[name]&";	
		}
		if(isset($_REQUEST['cid']) && $_REQUEST['cid'])
		{
			$wh.=" and subject.cid=$_REQUEST[cid] ";
			$url.="cid=$_REQUEST[cid]&";
			}
			if(isset($_REQUEST['scid']) && $_REQUEST['scid'])
		{
			$wh.=" and subject.scid=$_REQUEST[scid] ";
			$url.="scid=$_REQUEST[scid]&";
			}
			$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,"SELECT COUNT(*) AS tot FROM subject join courses on subject.cid=courses.id join subcourse on scid=subcourse.id $wh LIMIT 1") ;
		$totRslt=mysqli_fetch_assoc($rs);
 $i=0;

			$list=mysqli_query($con,"SELECT subject.id, coursename, subject.name, subcourse.name as year FROM subject join courses on subject.cid=courses.id join subcourse on scid=subcourse.id $wh order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);
?>
<form method="post">
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="2">Search Pannel For Subject List</td>
    </tr>
    <tr>
    	<td>Stundent Name</td>
        <td><input type="text" value="<?php if(isset($_REQUEST['name']) && $_REQUEST['name']){ echo $_REQUEST['name'];}?>"  name="name"></td>
    </tr>
    <tr style="background-color:#fff; text-align:left; color:#000; font-size:14px; font-weight:normal;">	
		<td>
			Select Stream
		</td>
<td>
    <select name="cid" id="cid" onchange="course(this.value,'','')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses ");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($_REQUEST['cid']) && $_REQUEST['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
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
    	<td colspan="2" align="center"><input type="submit" value="Search"></td>
    </tr>
</table>
</form>
<br><br>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="5">Subject List</td>
    </tr>
    <tr>
    	<td colspan="5" align="right"><a href="index.php?mod=subject&do=addedit">Add New Course</a></td>
    </tr>
	<tr>
    	<td>S.No.</td>
        <td>Stream</td>
        <td>Year</td>
        <td>Subject Name</td>
        <td>Action</td>
    </tr>
<?php
		$i=1;
		while($subject=mysqli_fetch_assoc($list)){
			?>
    <tr>
   		<td><?php echo $i++;?></td>
        <td><?php echo $subject['coursename'];
		//echo  getcolumn('courses','coursename',$subject['cid']);
		?></td>
        <td><?php echo $subject['year'];
		//echo  getcolumn('subcourse','name',$subject['scid']);
		?></td>
        <td><?php echo $subject['name'];?></td>
        <td><a href="index.php?mod=subject&do=addedit&id=<?php echo $subject['id'];?>">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onClick="deletedata(<?php echo $subject['id'];?>)">Delete</a></td>
    </tr>
    <?php
		}
	?>
            <tr>
    	<td colspan="10">
<?php PaginationDisplay($totRslt['tot'],$url.'pageNumber=','');?></td>
    </tr>

</table>
<script>
	function deletedata(id){
		if(confirm("Do you really want to delete")){
			location.href="index.php?mod=subject&do=list&id="+id;	
		}
	}
	function course(cval,scval,optsubject)
{
	$.ajax({
		url:"module/register/subcoursesload.php",
		data: 'cid='+cval+'&id='+scval+'&subject='+optsubject,
		type:'POST',
		success: function(res){
			
			$('#scid').html(res);
			if(scval)
			{
				loadcourses(cval,scval,optsubject);
				}
			}
	});
}
<?php if($_POST['cid']){?>
	$(document).ready(function(e) {
        course(cid.value,'<?php echo $_POST['scid'];?>','');
    });
	<?php }?>

</script>