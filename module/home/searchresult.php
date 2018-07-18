<?php
	
	$url="index.php?mod=home&do=searchlist&";

		$wh=" where 1 ";
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']){
			$wh.=" and student1.name like '%$_REQUEST[keyword]%'";	
			$url.="name=$_REQUEST[name]&";
		}
		if(isset($_REQUEST['name']) && $_REQUEST['name']){
			$wh.=" and optgroup like '%$_REQUEST[name]%' ";	
			$url.="name=$_REQUEST[name]&";
		}
		if(isset($_REQUEST['cid']) && $_REQUEST['cid'])
		{
			$wh.=" and student1.cid=$_REQUEST[cid] ";
			$url.="cid=$_REQUEST[cid]&";
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
			$list=mysqli_query($con,"select student1.id, student1.name, fname, courses.coursename, subcourse.name as sub, regyear,resident,category,bpl,std,phone, mobile, class, year,subject,obtain,total,percentage,board_name,scholarcode,classcode from student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id $wh order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);
			$num=mysqli_num_rows($list);
?>

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
                <td><?php echo $studentdata['class'];?></td>
                
            </tr>
            <?php	
		}
	?>
        <tr>
    	<td colspan="10">
<?php PaginationDisplay($totRslt['tot'],$url.'pageNumber=','');?></td>
    </tr>

</table>
