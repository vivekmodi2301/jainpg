
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
	$college_fund=mysqli_query($con,"SELECT id, fund from collegefund");

?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="<?php echo mysqli_num_rows($college_fund)+20;?>">College Funds Details With Class Wise</td>
    </tr>

	<tr>
    	<td>S. No.</td>
        <td>Class</td>
        <td>Total</td>
        <?php 
		while($college_fund_data=mysqli_fetch_assoc($college_fund)){?>
        <td><?php echo $college_fund_data['fund']?></td>
        <?php }?>
        <td>Year</td>
        <td>Date</td>
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
        <th>Grant Total</th>
        <td>Tution Fees</td>
        
        <th>Grant + Tution Total</th>
    </tr>
    <?php
	$i=1;
	$efgt=array();
	$gtot="";
	$ttotal="";
	$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees='' group by collegefunddte.cid");
	while($data=mysqli_fetch_assoc($rs) ){
	?>
    <tr>
		<td><?php echo $i++;?></td>
     	<td><?php echo $data['coursename'];?></td>
     	<td><?php echo $data['total'];?></td>
        <?php
	$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid as scid, collegefunddte.dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id join studentfees on studentfees.sid=collegefunddte.sid where collegefunddte.cid=$data[cid] and extraFees=''  group by  collegefunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs) ){
	?>
        <td><?php echo $fdata['fees'];?></td>
        <?php }?>
        <td><?php echo $data['year'];?></td>
        <td><?php echo $data['dt'];?></td>
        <?php
		$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] ");
		
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
           
        <td><?php 
//		echo $subFees;
		$efgt[$eval]+=$sum[$eval];
		echo $sum[$eval];
		$data['gtotal']+=$sum[$eval];
		?></td>
          <?php 
		}
		
        
        
        
        
		
		for($k=0;$k<count($courseArray);$k++){
			// new add by gopal
		
		if($courseArray[$k]==$data['cid'])
		{
		$courseFees=mysqli_query($con,"SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid");
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$courseArray[$k] group by cid";
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
//		echo "SELECT tution_fees as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
		//if(mysqli_num_rows($courseFees)){
		$courseFeesData=mysqli_fetch_assoc($courseFees);
			
			
		?>
        <td>
        <?php 
		$data['gtotal']+=$courseFeesData['tution_fees'];
		echo $courseFeesData['tution_fees'];?>
        </td>
		<?php	
		}
		
		else
		
		{
			?>
            <td>0</td>
            <?php
		}
		}
		//end change
		?>
        
        
        
        <?php
		
			// change by gopal
			$trs=mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] group by cid");
		$tdata=mysqli_fetch_assoc($trs);?>
        
        
        <th><?php echo $data['gtotal'];?></th>
        <td><?php echo $tdata['tution_fees'];
		$ttotal+=$tdata['tution_fees'];
		?></td>
        <th><?php echo $tdata['tution_fees']+$data['gtotal'];?></th>
   </tr>
   <?php } 
   foreach($esub as $key=>$value){
	   $extrafee=mysqli_fetch_assoc(mysqli_query($con,"select extraFees from subject where cid='1' and name='$value'"));
	   $half=$extrafee['extraFees']/2;//exit;
	$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, collegefunddte.dt, collegefunddte.scid,count(distinct collegefunddte.sid) as total, coursename,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join studentfees on studentfees.sid=collegefunddte.sid where extraFees like '$value-$half' or extraFees like '$value-$extrafee[extraFees]' and collegefunddte.cid='1' group by collegefunddte.cid");
	while($data=mysqli_fetch_assoc($rs) ){
	?>
    <tr>
		<td><?php echo $i++;?></td>
     	<td><?php echo $data['coursename']." with $value";?></td>
     	<td><?php echo $data['total'];?></td>
        <?php
	$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid as scid, collegefunddte.dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id join studentfees on studentfees.sid=collegefunddte.sid where collegefunddte.cid=$data[cid] and extraFees like '$value-$half'  group by  collegefunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs) ){
	?>
        <td><?php echo $fdata['fees'];?></td>
        <?php }?>
        <td><?php echo $data['year'];?></td>
        <td><?php echo $data['dt'];?></td>
        <?php
		$voc_rs=mysqli_query($con,"select extraFees from studentfees where  studentfees.cid=$data[cid] ");
		
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
           
        <td><?php 
//		echo $subFees;
		$efgt[$eval]+=$sum[$eval];
		echo $sum[$eval];
		$data['gtotal']+=$sum[$eval];
		?></td>
          <?php 
		}
		
		
        
        
        
        
		
		for($k=0;$k<count($courseArray);$k++){
			// new add by gopal
		
		if($courseArray[$k]==$data['cid'])
		{
		$courseFees=mysqli_query($con,"SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid");
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$courseArray[$k] group by cid";
		//echo "SELECT cid,sum(tution_fees) as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
//		echo "SELECT tution_fees as tution_fees FROM studentfees WHERE cid=$data[cid] group by cid";
		//if(mysqli_num_rows($courseFees)){
		$courseFeesData=mysqli_fetch_assoc($courseFees);
			
			
		?>
        <td>
        <?php 
		$data['gtotal']+=$courseFeesData['tution_fees'];
		echo $courseFeesData['tution_fees'];?>
        </td>
		<?php	
		}
		
		else
		
		{
			?>
            <td>0</td>
            <?php
		}
		}
		//end change
		?>
        
        
        
        
        <?php
		
			// change by gopal
			$trs=mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where cid=$data[cid] group by cid");
		$tdata=mysqli_fetch_assoc($trs);?>
        
        
        <th><?php echo $data['gtotal'];?></th>
        <td><?php echo $tdata['tution_fees'];
		$ttotal+=$tdata['tution_fees'];
		?></td>
        <th><?php echo $tdata['tution_fees']+$data['gtotal'];?></th>
   </tr>
   <?php } 
		}
		?>
    <tr>
	<th colspan="3">Grant Total</th>
    <?php
	$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid, dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id   group by  collegefunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs)){
	?>
            <th><?php echo $fdata['fees'];
			
			$gtot+=$fdata['fees'];
			?></th>
        <?php }?>
        <td class="3"></td>
        <td class="3"></td>
      	
        <?php
		 foreach($esub as $eval)
			{ ?>
           
        <td><?php 
//		echo $subFees;
		echo $efgt[$eval];
		?></td>
          <?php 
		}
		?> 
	<th colspan=""><?php echo $gtot?></th>
     <th colspan=""><?php echo $ttotal; ?></th>
    <th colspan=""><?php echo $gtot+$ttotal;?></th>

    </tr>
</table>
<div>

</div>
	