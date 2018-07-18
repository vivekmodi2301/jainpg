
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
    	<td colspan="<?php echo mysqli_num_rows($college_fund)+10;?>">College Funds Details With Class Wise</td>
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
          
        <?php }?>
        <th>Grant Total</th>
        <td>Tution Fees</td>
        
        <th>Grant + Tution Total</th>
    </tr>
    <?php
	$i=1;
	
		$efgt=array();
	$gtot="";
	$ttotal="";
	
	
	
	$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, dt, collegefunddte.scid,count(distinct sid) as total, coursename,subcourse.name,year,sum(collegefunddte.fees) as gtotal FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id  group by collegefunddte.cid");
	
	
//	$rs=mysqli_query($con,"SELECT collegefunddte.cid as cid, dt, collegefunddte.scid,count(distinct sid) as total, coursename,subcourse.name,year,sum(collegefunddte.fees) as gtotal, sum(extraFees) as extraFees FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id join subject on subject.cid=collegefunddte.cid group by collegefunddte.cid");
	
		while($data=mysqli_fetch_assoc($rs) ){
	?>
    <tr>
        
		<td><?php echo $i++;?></td>
     	<td><?php echo $data['coursename'];?></td>
     	<td><?php echo $data['total'];?></td>
        <?php
	$frs=mysqli_query($con,"SELECT collegefunddte.id, sum(collegefunddte.fees) as fees, collegefunddte.cid, collegefunddte.scid as scid, dt,coursename,name,funds FROM collegefunddte join courses on courses.id=collegefunddte.cid join subcourse on collegefunddte.scid=subcourse.id where collegefunddte.cid=$data[cid]  group by  collegefunddte.funds");
	
	while($fdata=mysqli_fetch_assoc($frs) ){
	?>
        <td><?php echo $fdata['fees'];?></td>
        <?php }?>
        <td><?php echo $data['year'];?></td>
        <td><?php echo $data['dt'];?></td>
        
        
        
        
        <?php
		$voc_rs=mysqli_query($con,"select extraFees from studentfees where extraFees!='' and studentfees.cid=$data[cid] ");
		
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
		?>
        <?php
			$trs=mysqli_query($con,"select sum(tution_fees) as tution_fees,count(sid) from studentfees where scid=$data[scid] group by scid");
		$tdata=mysqli_fetch_assoc($trs);?>
        
        
        <th><?php echo $data['gtotal'];?></th>
        <td><?php echo $tdata['tution_fees'];
		$ttotal+=$tdata['tution_fees'];
		?></td>
        <th><?php echo $tdata['tution_fees']+$data['gtotal'];?></th>
   </tr>
   <?php }?>
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
	