<?php
//	include("../../excelwriter.inc.php");
//	include('../../define.php');
//include('../../function.php');

if(isset($_POST['cid']) && $_POST['cid'])
{
	

//	$query=$_POST['qry'];
	$rs=mysqli_query($con,"SELECT collegefunddte.id, sid, courses.coursename, subcourse.name as cyear, date, funds, collegefunddte.fees,student1.name, collegefunddte.year,fund FROM collegefunddte join student1 on sid=student1.id join collegefund on funds=collegefund.id join courses on collegefunddte.cid=courses.id join subcourse on collegefunddte.scid=subcourse.id  where student1.cid=$_POST[cid] and student1.scid=$_POST[scid]");
		$date=date('d_M_Y',time());
//	echo $date;
unset($_POST['cid']);
	unset($_POST['scid']);
	$fileName = "collegefunddtlexcelfile/".$date.'_'.time()."__studentlist.xls";
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
		"<b>Fund Name</b>",
		"<b>Fees</b>",
		"<b>Year</b>",
		"<b>Date</b>"
				);
	
	$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'black'));
	 $i=0; while($data=mysqli_fetch_assoc($rs)){
	$myArr=array(++$i,$data['name'], $data['coursename'], $data['cyear'], $data['fund'], $data['fees'],$data['year'],$data['date']);
	print_r($myArr);
	$excel->writeLine($myArr);
	}
		
	//$_POST['filename']=$fileName;
			
	$excel->close();
addEdit('collegefunddtlexcelfile',$_POST);
	?>
    <script>
		location.href="index.php?mod=register&do=tcfexcel";
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
		type:'GET',
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