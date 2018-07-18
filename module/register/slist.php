<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		deleteData('student1',$id);
		?>
        	<script>
				alert("Student Detail has been Deleted");
				location.href="index.php?mod=register&do=slist";
			</script>
        <?php	
	}
	$url="index.php?mod=register&do=slist&";
	if(isset($_REQUEST['number'])){
		$data=$_REQUEST['number'];
		$url.="data=$_REQUEST[number]&";
	}
		$wh=" where 1 ";
		if(isset($_REQUEST['name']) && $_REQUEST['name']){
			$wh.=" and student1.name like '%$_REQUEST[name]%' ";	
			$url.="name=$_REQUEST[name]&";
		}
		if(isset($_REQUEST['cid']) && $_REQUEST['cid'])
		{
			$wh.=" and student1.cid=$_REQUEST[cid] ";
			$url.="cid=$_REQUEST[cid]&";
			}
		if(isset($_REQUEST['date']) && $_REQUEST['date'])
		{
			$wh.=" and student1.submitDate='$_REQUEST[date]' ";
			$url.="submitDate=$_REQUEST[date]&";
		}
			if(isset($_REQUEST['scid']) && $_REQUEST['scid'])
		{
			$wh.=" and student1.scid=$_REQUEST[scid] ";
			$url.="scid=$_REQUEST[scid]&";
			}
		$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,"SELECT COUNT(*) AS tot FROM student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id $wh LIMIT 1") ;
		$totRslt=mysqli_fetch_assoc($rs);
			$list=mysqli_query($con,"select student1.id, student1.name, fname, courses.coursename, subcourse.name as sub, regyear,resident,category,bpl,std,phone, mobile, class, year,subject,obtain,total,percentage,board_name,scholarcode,classcode,submitDate from student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id $wh order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);
		$num=mysqli_num_rows($list);
?>
<form method="post">
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="2">Search Pannel For Student List</td>
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
    <select  id="cid" onchange="course(this.value,'','')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses ");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($_REQUEST['cid']) && $_REQUEST['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
                <?php	
			}
		?>
    </select>
</td>
</tr>
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
    	<td>Select Registration Year</td>
        <td>
        	<input type="text" name="year" value="<?php $year=date('Y'); 
			echo $year."-".++$year; ?>">
        </td>
    </tr>
    
<!--    <tr>
    	<td>No. of Student Selected</td>
        <td>
        	<select name="number">
            	<?php for($i=2;$i<=$totRslt['tot'];$i=$i+2){
				?>
                	<option value="<?php echo $i;?>" <?php if(isset($_POST['number']) && $_POST['number']==$i){  echo "selected";}?>><?php echo $i;?></option>
                <?php	
				}
				?>
            </select>
        </td>
    </tr>-->
    <tr>
    	<td colspan="2" align="center"><input type="submit" value="Search"></td>
    </tr>
</table>
</form>
<br><br>
<table class="<?php echo $theam;?>_list">
<tr>
    	<td colspan="20">Student List</td>
    </tr>

    <tr>
    	<td colspan="20" align="right"><a href="index.php?mod=register&do=student">Add new Record</a></td>
    </tr>
    	<tr>
    	<td>S. No.</td>
        <td>Name</td>
        <td>Scholar Code</td>
        <td>Course</td>
        <td>Father Name</td>
        <td>Category</td>
        <td>Phone No.</td>
        <td>Mobile No.</td>
        <td>Class</td>
        <td>Registration Year</td>
        <td>Action</td>
    </tr>
    
    <?php
	


		$i=1;
		while($studentdata=mysqli_fetch_assoc($list)){
			?>
            <tr>
            	<td><?php echo $i++;?></td>
                <td><?php echo $studentdata['name'];?></td>
                <td>Scholar/<?php echo $studentdata['classcode'].'/'.$studentdata['scholarcode'];?></td>
                <td><?php echo $studentdata['coursename']; ?></td>
                <td><?php echo $studentdata['fname'];?></td>
                <td><?php echo $studentdata['category'];?></td>
                <td><?php echo $studentdata['phone'];?></td>
                <td><?php echo $studentdata['mobile'];?></td>
                <td><?php echo $studentdata['sub'];?></td>
                <td><?php echo $studentdata['regyear'];?></td>
                <td><a href="index.php?mod=register&do=student&id=<?php echo $studentdata['id'];?>">Update</a>
                	<a href="#" onClick="deleteRecord(<?php echo $studentdata['id'];?>)">Delete</a>
                </td>
            </tr>
            <?php	
		}
	?>
        <tr>
    	<td colspan="11">
<?php PaginationDisplay($totRslt['tot'],$url.'pageNumber=','');?></td>
    </tr>

</table>
<script>
	function deleteRecord(id){
		if(confirm("Do you really want to delete student")){
			location.href="index.php?mod=register&do=slist&id="+id;	
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
<?php if($_REQUEST['cid']){?>
	$(document).ready(function(e) {
        course(cid.value,'<?php echo $_POST['scid'];?>','');
    });
	<?php }?>
</script>