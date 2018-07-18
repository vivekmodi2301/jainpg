<style>
#axixa_wrapper .axixa_list tr:nth-child(odd),#axixa_wrapper .axixa_form tr:nth-child(odd)

{
	background-color:#eef;
	}
#axixa_wrapper .axixa_list tr:nth-child(2){
	background-color:#1a1;
	background-size:100% 100%;
	color:#fff;
	
	text-align:center;
	font-weight:bold;
	height:30px;
	font-size:14px;
}
#axixa_wrapper .axixa_list tr:nth-child(3){
	text-align:left;
	font-weight:normal;
	color:#000;
}

#axixa_wrapper .axixa_form tr:first-child>td:first-child{
	border-right:0;

}
#axixa_wrapper .axixa_form tr>td:first-child{
	border-right:1px solid #aaf;
}
#axixa_wrapper .axixa_form tr>td{
	padding:5px;
}
#axixa_wrapper .axixa_list tr,#axixa_wrapper .axixa_form tr
{
	background-color:#fff;
	min-height:40px;
	font-size:14px;
	}
</style>
<?php 
	if(isset($_GET['sid']) && isset($_GET['tot'])){
		$sid=$_GET['sid'];
		$tot=$_GET['tot'];
		echo $tot;
	}
?>
<?php
	$url="index.php?mod=fees&do=feeslist&";
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
			if(isset($_REQUEST['scid']) && $_REQUEST['scid'])
		{
			$wh.=" and student1.scid=$_REQUEST[scid] ";
			$url.="name=$_REQUEST[scid]&";
			}
			$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,"SELECT COUNT(*) AS tot from student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id $wh LIMIT 1") ;
		$totRslt=mysqli_fetch_assoc($rs);
			$list=mysqli_query($con,"select student1.id, student1.name,optsubject,student1.board_name, fname,student1.cid,student1.scid, courses.coursename, subcourse.name as year,subcourse.fees from student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id $wh order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);
?>

<form method="post">
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="2">Search Pannel For Student Fees List</td>
    </tr>
    <tr  style="background-color:#fff; text-align:left; color:#000; font-size:14px; font-weight:normal;">
    	<td>Stundent Name</td>
        <td><input type="text" value="<?php if(isset($_REQUEST['name']) && $_REQUEST['name']){ echo $_REQUEST['name'];}?>"  name="name"></td>
    </tr>
    <tr>	
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
    	<td colspan="7">Students Fees List</td>
    </tr>

	<tr>
    	<td>S. No.</td>
        <td>Name</td>
        <td>Course</td>
        <td>Subcourse</td>
        <td>Total Fees</td>
        <td>Remaining Fees</td>
        <td>Action</td>
    </tr>
    <?php
		$i=1;
		while($studentdata=mysqli_fetch_assoc($list)){
		if($studentdata=='RBSE')$reg=200;
		else $reg=100;
			?>
            <tr>
            	<td><?php echo $i++;?></td>
                <td><?php echo $studentdata['name'];?></td>
                <td><?php echo $studentdata['coursename']; ?></td>
                <td><?php echo $studentdata['year'];?></td>
        		<td><?php //echo $studentdata['fees'];
				
				$sub=str_replace(',',"','",$studentdata['optsubject']);
				$sub="'$sub'";
				$rs=mysqli_query($con,"select sum(extraFees) as extraFees from subject where cid=$studentdata[cid] and scid=$studentdata[scid] and name in($sub)");
				$extrafees=mysqli_fetch_assoc($rs);
				$total_FEES=$studentdata['fees']+$extrafees['extraFees']+$reg;
				echo $total_FEES;
				?></td>
                <td><?php 
					$fees_data=mysqli_query($con,"select id,sid,fees from studentfees where sid=$studentdata[id]");
					if(mysqli_num_rows($fees_data)){
						$totfee=0;
						while($fee=mysqli_fetch_assoc($fees_data)){
							$totfee+=$fee['fees'];	
						}	
						echo $total_FEES-$totfee;
					}		
					else{
					echo $studentdata['fees']+$extrafees['extraFees'];
					}
				?></td>	
                <td><a href="index.php?mod=fees&do=addedit&id=<?php echo $studentdata['id'];?>">Submit Fees</a></td>
            </tr>
            <?php	
		}
	?>
    <tr>
    	<td colspan="10">
		<?php PaginationDisplay($totRslt['tot'],$url.'pageNumber=',$num);?>
</td>
    </tr>
</table>
<div>

</div>
<script>
	function feesform(id){
		location.href="index.php?mod=fees&do=feeslist&id="+id;
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