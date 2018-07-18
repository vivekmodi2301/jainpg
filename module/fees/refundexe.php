<?php
$date=date('d_M_Y',time());
$fileName = "refundexe/".$date.'_'.time()."__refund.xls";
$_POST['filename']=$date.'_'.time()."__refund.xls"; 
	$rs=mysqli_query($con,"SELECT student1.id, student1.name as student,student1.refund_fees, coursename, subcourse.name as year, subcourse.fees from student1 join courses on student1.cid=courses.id join subcourse on student1.scid=subcourse.id where student1.refund_fees!=0");
$excel = new ExcelWriter($fileName);
	
	if($excel==false)	
	{
		echo $excel->error;
		die;
	}
	
	$myArr=array(
		"<b>S. No.</b>",
		"<b>Name</b>",
		"<b>Course</b>",
		"<b>Total Fees</b>",
		"<b>Refund Fees</b>"
		);
		$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'black'));
		$wh="where 1";
		$i=0;
	while($refund=mysqli_fetch_assoc($rs)){
			$myArr=array(++$i,$refund['student'].' '.$refund['coursename'],$refund['year'],$refund['fees'],$refund['refund_fees']);
			
			$excel->writeLine($myArr);
	}
addEdit('refundexe',$_POST);?>
<script>
	location.href="index.php?mod=fees&do=refundexelist";
</script>