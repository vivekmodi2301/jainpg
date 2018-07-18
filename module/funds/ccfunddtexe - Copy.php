<?php
$date=date('d_M_Y',time());
$fileName = "college/".$date.'_'.time()."__studentlist.xls";
$_POST['filename']=$date.'_'.time()."__studentlist.xls"; 
	$college_fund=mysqli_query($con,"SELECT id, fund from collegefund");
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
		while($fund=mysqli_fetch_assoc($college_fund)){
			$myArr[]="<b>$fund[fund]</b>";
		}
		$myArr[]="<b>Year</b>";
		$myArr[]="<b>Date</b>";
		$myArr[]="<b>Grant Total</b>";
		$myArr[]="<b>Tution Fees</b>";
		$myArr[]="<b>Grant + Tution Total</b>";
	$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'black'));
	$i=1;
	$gtot="";
	$ttotal="";
	$rs=mysqli_query($con,"SELECT  dt, collegefunddte.scid,count(distinct sid) as total, coursename,name,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id group by collegefunddte.scid");
	$i=0; while($data=mysqli_fetch_array($rs)){
	$myArr=array(++$i,$data['coursename'].' '.$data['name'],$data['total']);
	$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid, dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id where collegefunddte.scid=$data[scid]  group by  collegefunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs)){
		$myArr[]=$fdata['fees'];
	}
		$myArr[]=$data['year'];
		$myArr[]=$data['dt'];
		$trs=mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where scid=$data[scid] group by scid");
		$tdata=mysqli_fetch_assoc($trs);
		$myArr[]=$data['gtotal'];
		$myArr[]=$tdata['tution_fees'];
		$ttotal+=$tdata['tution_fees'];
		$myArr[]=$tdata['tution_fees']+$data['gtotal'];
		$excel->writeLine($myArr);
	}
	$myArr=array();
	$myArr[]="<b>Grant Total</b>";
		$myArr[]="";
		$myArr[]="";
		$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid, dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id   group by  collegefunddte.funds");
		while($fdata=mysqli_fetch_assoc($frs)){
			$myArr[]=$fdata['fees'];
			$gtot+=$fdata['fees'];	
		}
		$myArr[]="";
		$myArr[]="";
		$myArr[]=$gtot;
		$myArr[]=$ttotal;
		$myArr[]=$gtot+$ttotal;
		$excel->writeLine($myArr);
	$excel->close();
addEdit('collegefundexcelfile',$_POST);
?>
<script>
	location.href="index.php?mod=funds&do=cfunddtexe";
</script>