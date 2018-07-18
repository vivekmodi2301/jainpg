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
		"<b>Date</b>",
		"<b>Class</b>",
		"<b>Total</b>");
		while($fund=mysqli_fetch_assoc($college_fund)){
			$myArr[]="<b>$fund[fund]</b>";
		}
		$voc_rs=mysqli_query($con,"select distinct name,extrafees from subject where extrafees!='' ");
		$esub=array();
		
		while($vocData=mysqli_fetch_assoc($voc_rs)){
		$esub[]=$vocData['name'];
		$myArr[]="<b>$vocData[name]</b>";
		}
		$course=mysqli_query($con,"select id,coursename from courses");
		$courseno=mysqli_num_rows($course);
		while($coursesName=mysqli_fetch_assoc($course))
		{
		$myArr[]="<b>".$coursesName['coursename']."</b>";
		$courseArray[]=$coursesName['id'];
//		print_r($courseArray);
		?>
        <?php 
		}
		
		//$myArr[]="<b>Grant Total</b>";
		//$myArr[]="<b>Tution Fees</b>";
		$myArr[]="<b>Grant + Tution Total</b>";
		//print_r($myArr);exit;
	$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'black'));
	
	
	
	
	
	
	
$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extrafees='')group by collegefunddte.cid");
	$i=0; while($data=mysqli_fetch_array($rs)){
	$myArr=array(++$no,$data['dt'],$data['coursename'],$data['total']);
	$fnamers=mysqli_query($con,"select id from collegefund");
		while($fname=mysqli_fetch_assoc($fnamers)){
	$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees='')");
	while($fdata=mysqli_fetch_assoc($frs)){
		$myArr[]=$fdata['fees'];
	}}
		
		
		
				$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] and extraFees=''");
		
		//$esub=array();
		$sum=array();
		while($vocData=mysqli_fetch_assoc($voc_rs)){
			for($i=0;$i<count($vocData['extraFees']);$i++){
				$subject=explode(',',$vocData['extraFees']);
				foreach($subject as $subname=>$subvalue)
				{
					//echo $subvalue;
					
					$subFees=explode('-',$subvalue);
					if(in_array($subFees[0],$esub)){
						$sum[$subFees[0]]+=$subFees[1];
					//print_r($subFees);
	//				for($j=0;$j<count($subFees);$j++){
	}}}}
		foreach($esub as $eval)
			{ ?>
           
		<?php 
//		echo $subFees;
		$efgt[$eval]+=$sum[$eval];
		if($sum[$eval]){
		$myArr[]=$sum[$eval];
		}
		else{
			$myArr[]="0";
			}
		$data['gtotal']+=$sum[$eval];
		?>
          <?php 
		}
		for($k=0;$k<count($courseArray);$k++){
			// new add by gopal
		
		if($courseArray[$k]==$data['cid'])
		{
		$courseFees=mysqli_query($con,"SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] and extraFees='' group by cid");
		
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$courseArray[$k] group by cid";
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
//		echo "SELECT tution_fees as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
		//if(mysqli_num_rows($courseFees)){
		$courseFeesData=mysqli_fetch_assoc($courseFees);
			
			
		
        $myArr[]=$courseFeesData['tution_fees']; 
		//$data['gtotal']+=$courseFeesData['tution_fees'];
		
       	
		}
		
		else
		
		{
			$myArr[]="0";
		}
		}
		//end change
		

		
		
		
		
		$trs=mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and extraFees='' group by cid");
		$tdata=mysqli_fetch_assoc($trs);
		$finaltotal+=$tdata['tution_fees']+$data['gtotal'];
		$myArr[]=$tdata['tution_fees']+$data['gtotal'];
		$excel->writeLine($myArr);
	}
	
	
	
	
	
	
	
	
	
	 foreach($esub as $key=>$value){
	   $extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $half=$extrafee['extraFees']/2;//exit;
	$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte  join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]' )group by collegefunddte.cid");
	while($data=mysqli_fetch_assoc($rs) ){
		$myArr=array(
			++$no,
			$data['dt'],
			$data['coursename']." with $value",
			$data['total']
		);
		$fnamers=mysqli_query($con,"select id from collegefund");
		while($fname=mysqli_fetch_assoc($fnamers)){
		$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]')");
	while($fdata=mysqli_fetch_assoc($frs) ){
		$myArr[]=$fdata['fees'];
	}}
	$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] and extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'");
		
		//$esub=array();
		$sum=array();
		while($vocData=mysqli_fetch_assoc($voc_rs)){
			for($i=0;$i<count($vocData['extraFees']);$i++){
				$subject=explode(',',$vocData['extraFees']);
				foreach($subject as $subname=>$subvalue)
				{
					//echo $subvalue;
					
					$subFees=explode('-',$subvalue);
					if(in_array($subFees[0],$esub)){
						$sum[$subFees[0]]+=$subFees[1];
					//print_r($subFees);
	//				for($j=0;$j<count($subFees);$j++){
	}}}}
		foreach($esub as $eval)
			{ 
			$efgt[$eval]+=$sum[$eval];
			if($sum[$eval]){
				$myArr[]=$sum[$eval];
				$fee=mysqli_fetch_assoc(mysqli_query($con,"SELECT sum(collegefunddte.fees) as gtotal FROM `collegefunddte` WHERE sid in( select sid from studentfees where extrafees like 'computer application-$half' and cid=$data[cid])"));
		
		$fee['gtotal']+=$sum[$eval];
			}
			else{
				$myArr[]="0";	
			}
			$data['gtotal']+=$sum[$eval];
			}
            for($k=0;$k<count($courseArray);$k++){
			// new add by gopal
		
		if($courseArray[$k]==$data['cid'])
		{
		$courseFees=mysqli_query($con,"SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid]  and extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]' group by cid");
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$courseArray[$k] group by cid";
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
//		echo "SELECT tution_fees as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
		//if(mysqli_num_rows($courseFees)){
		$courseFeesData=mysqli_fetch_assoc($courseFees);
		$myArr[]=$courseFeesData['tution_fees'];
		}
		else
		
		{
			$myArr[]="0";
		}
		}
		$tdata=mysqli_fetch_assoc(mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and  extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'  group by cid"));
		$finaltotal+=$tdata['tution_fees']+$fee['gtotal'];
		$myArr[]=$tdata['tution_fees']+$fee['gtotal'];
		$excel->writeLine($myArr);
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$esubj=$esub;
	unset($esubj[2]);
	$extrafeesub="";
foreach($esubj as $key=>$value){
		$extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $half=$extrafee['extraFees']/2;//exit;
	   $halfextrafeesub.=$value."-".$half.",";
}
$halfextrafeesub=substr($halfextrafeesub,0,-1);
foreach($esub as $key=>$value){
		$extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $fullextrafeesub.=$value."-".$extrafee['extraFees'].",";
}

$fullextrafeesub=substr($fullextrafeesub,0,-1);
	
	$rs=mysqli_query($con," SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extraFees like '%$halfextrafeesub%' or extraFees like '%$fullextrafeesub%')group by collegefunddte.cid");
	//echo "SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'   group by collegefunddte.cid";
	while($data=mysqli_fetch_assoc($rs) ){
		$myArr=array(
			++$i,
			$data['dt'],
			$data['coursename']." with $value, home science and computer application",
			$data['total']
		);
		$fnamers=mysqli_query($con,"select id from collegefund");
		while($fname=mysqli_fetch_assoc($fnamers)){
		$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees like '%$value-$half%' or extraFees like '%$value-$extrafee[extraFees]%')");
	while($fdata=mysqli_fetch_assoc($frs) ){
		$myArr[]=$fdata['fees'];
	}}
	$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] and extrafees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'");
		
		//$esub=array();
		$sum=array();
		while($vocData=mysqli_fetch_assoc($voc_rs)){
			for($i=0;$i<count($vocData['extraFees']);$i++){
				$subject=explode(',',$vocData['extraFees']);
				foreach($subject as $subname=>$subvalue)
				{
					//echo $subvalue;
					
					$subFees=explode('-',$subvalue);
					if(in_array($subFees[0],$esub)){
						$sum[$subFees[0]]+=$subFees[1];
					//print_r($subFees);
	//				for($j=0;$j<count($subFees);$j++){
	}}}}
		foreach($esub as $eval)
			{
				$efgt[$eval]+=$sum[$eval];
				if($sum[$eval]){
					$myArr[]=$sum[$eval];
				}
				else{
					$myArr[]="0";	
				}
				$data['gtotal']+=$sum[$eval];
			}
			for($k=0;$k<count($courseArray);$k++){
			// new add by gopal
		
		if($courseArray[$k]==$data['cid'])
		{
		$courseFees=mysqli_query($con,"SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid]  and extrafees like '$halfextrafeesub' or extraFees like '$fullextrafeesub' group by cid");
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$courseArray[$k] group by cid";
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
//		echo "SELECT tution_fees as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
		//if(mysqli_num_rows($courseFees)){
		$courseFeesData=mysqli_fetch_assoc($courseFees);
		$myArr[]=$courseFeesData['tution_fees'];
		}
		else{
			$myArr[]="0";	
		}
		}
		$tdata=mysqli_fetch_assoc(mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and  extrafees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'  group by cid"));
		$finaltotal+=$tdata['tution_fees']+$data['gtotal'];
		$myArr[]=$tdata['tution_fees']+$data['gtotal'];
		$excel->writeLine($myArr);
			}
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	
	
	
	
	$myArr=array();
	$myArr[]="<b>Grant Total</b>";
		$myArr[]="";
		$myArr[]="";
		$myArr[]="";
		$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid, dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id   group by  collegefunddte.funds");
		while($fdata=mysqli_fetch_assoc($frs)){
			$myArr[]=$fdata['fees'];
			$gtot+=$fdata['fees'];	
		}
		 foreach($esub as $eval)
			{ ?>
           
<?php 
//		echo $subFees;
		$myArr[]=$efgt[$eval];
		?>
          <?php 
		}
 
$courseid=mysqli_query($con,"select id,coursename from courses");
		while($cid=mysqli_fetch_assoc($courseid)){
			$totaltutionfee=mysqli_fetch_assoc(mysqli_query($con,"select sum(tution_fees) as tutionfee from studentfees where cid=$cid[id]"));
				
			if($totaltutionfee['tutionfee']){ $myArr[]= $totaltutionfee['tutionfee'];} else{ $myArr[]="0";}?>
                        <?php
		}
		$myArr[]=$finaltotal;
		$excel->writeLine($myArr);
	$excel->close();
addEdit('collegefundexcelfile',$_POST);
?>
<script>
	location.href="index.php?mod=funds&do=cfunddtexe";
</script>