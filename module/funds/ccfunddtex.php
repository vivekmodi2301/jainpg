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
	/*$myArr=array(
		"<b>S.No.</b>",
		"<b>Class</b>",
		"<b>Total Student</b>"
	);
	while($fund=mysqli_fetch_assoc($college_fund)){
			$myArr[]="<b>$fund[fund]</b>";
	}
	print_r($myArr);
	*/
	$myArr=array(vivek,ramnaresh);
	$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'black'));
	$excel->close();
	addEdit('collegefundexcelfile',$_POST);
?>
<script>
	location.href="index.php?mod=funds&do=cfunddtexe";
</script>
