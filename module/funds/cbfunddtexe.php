<?php
$date=date('d_M_Y',time());
$fileName = "boys/".$date.'_'.time()."__studentlist.xls";
$_POST['filename']=$date.'_'.time()."__studentlist.xls"; 
	$boys_fund=mysqli_query($con,"SELECT id, fund from boysfund");
$excel = new ExcelWriter($fileName);
	
	if($excel==false)	
	{
		echo $excel->error;
		die;
	}
	
	$myArr=array(
		"<b>S. No.</b>",
		"<b>Class</b>",
		"<b>Total</b>");
		while($fund=mysqli_fetch_assoc($boys_fund)){
			$myArr[]="<b>$fund[fund]</b>";
		}
		$myArr[]="<b>Year</b>";
		$myArr[]="<b>Date</b>";
		$myArr[]="<b>Grant Total</b>";
		$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'black'));
		$wh="where 1";
		$rs=mysqli_query($con,"SELECT  dt, boysfunddte.scid,count(distinct sid) as total, coursename,name,year,sum(boysfunddte.fees) as gtotal FROM boysfunddte join courses on courses.id=boysfunddte.cid join subcourse on boysfunddte.scid=subcourse.id $wh group by coursename");
		$i=0;
	while($data=mysqli_fetch_assoc($rs)){
			$myArr=array(++$i,$data['coursename'],$data['total']);
			$frs=mysqli_query($con,"SELECT boysfunddte.id, sum(boysfunddte.fees) as fees, boysfunddte.cid, boysfunddte.scid, dt,coursename,name,funds FROM boysfunddte join courses on courses.id=boysfunddte.cid join subcourse on boysfunddte.scid=subcourse.id where boysfunddte.scid=$data[scid] group by  boysfunddte.funds");
			while($fdata=mysqli_fetch_assoc($frs)){
				$myArr[]=$fdata['fees'];	
			}
			$myArr[]=$data['year'];
			$myArr[]=$data['dt'];
			$myArr[]=$data['gtotal'];
			$excel->writeLine($myArr);
	}
	$myArr=array();
	$myArr[]="Grant Total";
	$myArr[]="";
	$myArr[]="";
	$frs=mysqli_query($con,"SELECT boysfunddte.id, sum(boysfunddte.fees) as fees, boysfunddte.cid, boysfunddte.scid, dt,coursename,name,funds FROM boysfunddte join courses on courses.id=boysfunddte.cid join subcourse on boysfunddte.scid=subcourse.id $wh group by  boysfunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs)){
		$myArr[]=$fdata['fees'];
		$gtot+=$fdata['fees'];
	}
	$myArr[]="";
	$myArr[]="";
	$myArr[]=$gtot;
	$excel->writeLine($myArr);
		$excel->close();
addEdit('boyfundexcelfile',$_POST);?>
<script>
	location.href="index.php?mod=funds&do=bfunddtexe";
</script>