
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
	#axixa_wrapper .axixa_list tr  .right{
		text-align:right;
	}
</style>
<?php 
	$college_fund=mysqli_query($con,"SELECT id, fund from collegefund");

?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="<?php echo mysqli_num_rows($college_fund)+20;?>">College Funds Details With Class Wise</td>
    </tr>

	<tr>
    	<td>S. No.</td>
        <td>Date</td>
        <td>Class</td>
        <td>Total</td>
        <?php 
		while($college_fund_data=mysqli_fetch_assoc($college_fund)){?>
        <td><?php echo $college_fund_data['fund']?></td>
        <?php }?>
        <?php
		$voc_rs=mysqli_query($con,"select distinct name,extrafees from subject where extrafees!='' ");
		$esub=array();
		
		while($vocData=mysqli_fetch_assoc($voc_rs)){
			?>
        <td><?php 
		$esub[]=$vocData['name'];
		
		echo $vocData['name']?></td>
          
        <?php }
        //print_r($esub);exit;
        
		
		// new add by gopal
		$course=mysqli_query($con,"select id,coursename from courses");
		$courseno=mysqli_num_rows($course);
		while($coursesName=mysqli_fetch_assoc($course))
		{
		?>
        <th><?php 
		$courseArray[]=$coursesName['id'];
//		print_r($courseArray);
		echo $coursesName['coursename']?></th>
        <?php 
		}
		//end code
		?>
        <!--<th>Grant Total</th>
        <td>Tution Fees</td>
        -->
        <th>Grant + Tution Total</th>
    </tr>
    <?php
	$no=1;
	$efgt=array();
	$gtot="";
	$ttotal="";
	$rs=mysqli_query($con," SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extrafees='')group by collegefunddte.cid
");
	//echo "SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees='' group by collegefunddte.cid";
	while($data=mysqli_fetch_assoc($rs) ){
	?>
    <tr>
		<td><?php echo $no++;?></td>
        <td><?php echo $data['dt'];?></td>
     	<td><?php echo $data['coursename'];?></td>
     	<td class="right"><?php echo $data['total'];?></td>
        <?php
		$fnamers=mysqli_query($con,"select id from collegefund");
		while($fname=mysqli_fetch_assoc($fnamers)){
		$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees='')");
	//echo "hi";
	while($fdata=mysqli_fetch_assoc($frs) ){
	?>
        <td class="right"><?php if($fdata['fees']){ echo $fdata['fees'];} else{ echo "0";}?></td>
        <?php } }?>
        
        <?php
		$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] and extraFees='' group by sid");
		
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
           
        <td class="right"><?php 
//		echo $subFees;
		$efgt[$eval]+=$sum[$eval];
		if($sum[$eval]){
			echo $sum[$eval];	
		}
		else{
			echo "0";	
		}
		//echo $data['gtotal']."+=".$sum[$eval];
		$data['gtotal']+=$sum[$eval];
		?></td>
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
			
			
		?>
        <td class="right">
        <?php 
		//$data['gtotal']+=$courseFeesData['tution_fees'];
		echo $courseFeesData['tution_fees'];?>
        </td>
		<?php	
		}
		
		else
		
		{
			?>
            <td class="right">0</td>
            <?php
		}
		}
		//end change
		?>
        
        
        
        <?php
		
			// change by gopal
			$trs=mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and extraFees='' group by sid");
			//echo "select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and extraFees='' group by cid";
			
		$tdata=mysqli_fetch_assoc($trs);?>
        
        
        <!--<th><?php //echo $data['gtotal'];?></th>
        <td><?php //echo $tdata['tution_fees'];
		//$ttotal+=$tdata['tution_fees'];
		?></td>-->
        <th class="right"><?php
		//echo $tdata['tution_fees']."+".$data['gtotal']; 
			$finaltotal+=$tdata['tution_fees']+$data['gtotal'];
		echo $tdata['tution_fees']+$data['gtotal'];?>
        </th>
   </tr>
   <?php } 
   $fee="";
   foreach($esub as $key=>$value){
	   $extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $half=$extrafee['extraFees']/2;//exit;
	   
	$rs=mysqli_query($con," SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte  join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]' )group by collegefunddte.cid
");
//echo " SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte  join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'   group by collegefunddte.cid)
//";
//echo " SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte  join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'   group by collegefunddte.cid)
//";
	//$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'   group by collegefunddte.cid");
	while($data=mysqli_fetch_assoc($rs) ){
	?>
    <tr>
		<td><?php echo $no++;?></td>
        <td><?php echo $data['dt'];?></td>
     	<td><?php echo $data['coursename']." with $value";?></td>
     	<td class="right"><?php echo $data['total'];?></td>
        <?php
		//"SELECT sum(collegefunddte.fees) as fees from collegefunddte join studentfees on studentfees.sid=collegefunddte.sid where collegefunddte.cid=$data[cid] and extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'  group by  collegefunddte.funds"
	
		$fnamers=mysqli_query($con,"select id from collegefund");
		while($fname=mysqli_fetch_assoc($fnamers)){
		$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]')");
	//$frs=mysqli_query($con," SELECT sum(collegefunddte.fees) as fees FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id join collegefund on collegefunddte.funds=collegefund.id join studentfees on collegefunddte.sid=studentfees.sid where collegefunddte.cid=$data[cid] and extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'   group by  collegefunddte.funds,studentfees.sid,collegefunddte.sid
 //");
	while($fdata=mysqli_fetch_assoc($frs)){
	?>
        <td class="right"><?php echo $fdata['fees'];?></td>
        <?php }}?>
        <?php
		$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] and extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]' ");
		
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
           
        <td class="right"><?php
		$efgt[$eval]+=$sum[$eval];
		if($sum[$eval]){
			//echo $sum[$eval];
			$fee=mysqli_fetch_assoc(mysqli_query($con,"SELECT sum(collegefunddte.fees) as gtotal FROM `collegefunddte` WHERE sid in( select sid from studentfees where extrafees like 'computer application-$half' and cid=$data[cid])"));
			//echo "SELECT sum(collegefunddte.fees) as gtotal FROM `collegefunddte` WHERE sid in( select sid from studentfees where extrafees like 'computer application-$half' or extrafees like '$value-$extrafee[extraFees]' and cid=$data[cid])";
			//echo $fee['gtotal'];
		//echo "SELECT sum(collegefunddte.fees) as gtotal FROM `collegefunddte` WHERE sid in( select sid from studentfees where extrafees like 'computer application-%'"; 
		//print_r($fee);
		//echo $fee['gtotal']."+=".$sum[$eval]."hi";exit;
		echo $sum[$eval];
		//echo $fee['gtotal'];
		$fee['gtotal']+=$sum[$eval];
		//echo $fee['gtotal'];
		}
		else{
			echo "0";	
		}
		
		?></td>
          <?php 
		}
		//echo $data['gtotal'];exit;
		
		
        
        
        
        
		
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
			
			
		?>
        <td class="right">
        <?php 
		//$data['gtotal']+=$courseFeesData['tution_fees'];
		echo $courseFeesData['tution_fees'];?>
        </td>
		<?php	
		}
		
		else
		
		{
			?>
            <td class="right">0</td>
            <?php
		}
		}
		//end change
		$tdata=mysqli_fetch_assoc(mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and  extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]'  group by cid"));

		?>
        <th class="right"><?php
		echo $tdata['tution_fees']."+".$fee['gtotal']; 
			$finaltotal+=$tdata['tution_fees']+$fee['gtotal'];
		echo $tdata['tution_fees']+$fee['gtotal'];?>
        </th>
   </tr>
   <?php  
		}
	}
	
	$esubj=$esub;
	unset($esubj[2]);
	$halfextrafeesub="";
foreach($esubj as $key=>$value){
		$extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $half=$extrafee['extraFees']/2;//exit;
	   $halfextrafeesub.=$value."-".$half.",";
}
$halfextrafeesub=substr($halfextrafeesub,0,-1);

$fullextrafeesub="";
foreach($esubj as $key=>$value){
		$extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $fullextrafeesub.=$value."-".$extrafee['extraFees'].",";
}

$fullextrafeesub=substr($fullextrafeesub,0,-1);
$rs=mysqli_query($con," SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid where sid in(select sid from studentfees where extraFees like '%$halfextrafeesub%' or extraFees like '%$fullextrafeesub%')group by collegefunddte.cid
");
	//$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'    group by collegefunddte.cid");
	//echo "SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'   group by collegefunddte.cid";
	while($data=mysqli_fetch_assoc($rs) ){
	?>
    <tr>
		<td><?php echo $no++;?></td>
        <td><?php echo $data['dt'];?></td>
     	<td><?php echo $data['coursename']." with $value and computer application";?></td>
     	<td class="right"><?php echo $data['total'];?></td>
        <?php
		$fnamers=mysqli_query($con,"select id from collegefund");
		while($fname=mysqli_fetch_assoc($fnamers)){
		$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees like '%$value-$half%' or extraFees like '%$value-$extrafee[extraFees]%')");
		//echo "SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=$fname[id] and  sid in (select sid from studentfees where cid=$data[cid] and extrafees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]')";
	//$frs=mysqli_query($con,"SELECT sum(collegefunddte.fees) as fees join studentfees on studentfees.sid=collegefunddte.sid where collegefunddte.cid=$data[cid] and extrafees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'  group by  collegefunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs) ){
	?>
        <td class="right"><?php echo $fdata['fees'];?></td>
        <?php }}?>
        
        <?php
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
			{ ?>
           
        <td class="right"><?php 
//		echo $subFees;
		$efgt[$eval]+=$sum[$eval];
		if($sum[$eval]){
			echo $sum[$eval];
		}
		else{
			echo "0";	
		}
		$data['gtotal']+=$sum[$eval];
		?></td>
          <?php 
		}
		//echo $data['gtotal'];exit;
		
		
        
        
        
        
		
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
			
			
		?>
        <td class="right">
        <?php 
		//$data['gtotal']+=$courseFeesData['tution_fees'];
		echo $courseFeesData['tution_fees'];?>
        </td>
		<?php	
		}
		
		else
		
		{
			?>
            <td class="right">0</td>
            <?php
		}
		}
		//end change
		$tdata=mysqli_fetch_assoc(mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] and  extrafees like '$halfextrafeesub' or extraFees like '$fullextrafeesub'  group by cid"));
		?>
        <th class="right"><?php
		//echo $tdata['tution_fees']."hi".$data['gtotal']; 
			$finaltotal+=$tdata['tution_fees']+$data['gtotal'];
		echo $tdata['tution_fees']+$data['gtotal'];?>
        </th>
   </tr>
   <?php  
		}?>
    <tr>
	<th colspan="4">Grant Total</th>
    <?php
	$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid, dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id   group by  collegefunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs)){
	?>
            <th class="right"><?php echo $fdata['fees'];
			
			$gtot+=$fdata['fees'];
			?></th>
        <?php }?>
        <?php
		 foreach($esub as $eval)
			{ ?>
           
        <td class="right"><?php 
//		echo $subFees;
		echo $efgt[$eval];
		?></td>
          <?php 
		}
		$courseid=mysqli_query($con,"select id,coursename from courses");
		while($cid=mysqli_fetch_assoc($courseid)){
			$totaltutionfee=mysqli_fetch_assoc(mysqli_query($con,"select sum(tution_fees) as tutionfee from studentfees where cid=$cid[id]"));
				
			?>
            <th class="right"><?php if($totaltutionfee['tutionfee']){ echo $totaltutionfee['tutionfee'];} else{ echo "0";}?></th>
            <?php
		}
		?>
    <th class="right"><?php echo $finaltotal;?></th>

    </tr>
</table>
<div>

</div>
	