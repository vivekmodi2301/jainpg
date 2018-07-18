<?php

if(isset($_POST['cid']) && $_POST['cid'])
{
	

//	$query=$_POST['qry'];
	$rs=mysqli_query($con,"SELECT id, name, cid, fname, optsubject, scid, regyear, resident, category, bpl, std, phone, mobile, class, year, subject, obtain, total, percentage, board_name, dt, cid_change, scid_change, optsub_change FROM student1 where cid=$_POST[cid] and scid=$_POST[scid]");

	$date=date('d_M_Y',time());
//	echo $date;
unset($_POST['cid']);
	unset($_POST['scid']);
	$fileName = "studentexcelfile/".$date.'_'.time()."__studentlist.xls";
	$_POST['filename']=$date.'_'.time()."__studentlist.xls";
//	print_r($_POST);exit;
		

		//exit;
	$excel = new ExcelWriter($fileName);
	
	if($excel==false)	
	{
		echo $excel->error;
		die;
	}
	
	$myArr=array(
		"<b>S. No.</b>",
		"<b>Student Name</b>",
		"<b>Stream</b>",
		"<b>Year</b>",
		"<b>Father Name</b>",
		"<b>Otional Subject</b>",
		"<b>Registration Year</b>",
		"<b>Category</b>",
		"<b>BPL</b>",
		"<b>STD Code</b>",
		"<b>Phone No.</b>",
		"<b>Mobile No.</b>",
		"<b>Previous class</b>",
		"<b>Previous class Passing Year</b>",
		"<b>Commerce/Arts/Science</b>",
		"<b>Obtain Marks in Previous Class</b>",
		"<b>Total Marks</b>",
		"<b>Percentage Of Previous Class</b>",
		"<b>Board Name</b>",
		"<b>Date</b>",
				);
	
	$excel->writeLine($myArr);
	 $i=0; while($data=mysqli_fetch_array($rs)){
	$myArr=array(++$i,
	'<span>'.$data['name'].'</span>', 
	'<span>'.$data['cid'].'</span>', 
	'<span>'.$data['scid'].'</span>', 
	'<span>'.$data['fname'].'</span>', 
	'<span>'.$data['optsubject'].'</span>',
	'<span style="text-align:right">'.$data['regyear'].'</span>',
	'<span>'.$data['category'].'</span>',
	'<span>'.$data['bpl'].'</span>',
	'<span style="text-align:right">'.$data['std'].'</span>',
	'<span style="text-align:right">'.$data['phone'].'</span>',
	'<span style="text-align:right">'.$data['mobile'].'</span>',
	'<span>'.$data['class'].'</span>',
	'<span style="text-align:right">'.$data['year'].'</span>',
	'<span>'.$data['subject'].'</span>',
	'<span style="text-align:right">'.$data['obtain'].'</span>',
	'<span style="text-align:right">'.$data['total'].'</span>',
	'<span style="text-align:right">'.$data['percentage'].'</span>',
	'<span style="text-align:right">'.$data['board_name'].'</span>',
	'<span style="text-align:right">'.$data['dt'].'</span>');
	$excel->writeLine($myArr);
	}
		
	//$_POST['filename']=$fileName;
			
	$excel->close();
addEdit('studentexcelfile',$_POST);
	?>
    <script>
		location.href="index.php?mod=register&do=gtstudent";
	</script>
<?php }?>

<form method="post">
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="2">Generate Excel File of Students</td>
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

	<tr style="background-color:#fff; text-align:left; color:#000; font-size:14px; font-weight:normal;">	
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
    	<td colspan="2" align="center"><input type="submit" value="Generate"></td>
    </tr>
</table>
</form>
<br><br>

<script>
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
