
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
	#axixa_wrapper .axixa_list tr .right{
		text-align:right;
	}
</style>
<?php 
	$college_fund=mysqli_query($con,"SELECT id, fund from boysfund");

?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="<?php echo mysqli_num_rows($college_fund)+7;?>">Boys Funds Details With Class Wise</td>
    </tr>

	<tr>
    	<td>S. No.</td>
        <td>Class</td>
        <td>Total</td>
        
        <?php 
		$gtot="";
		
		while($college_fund_data=mysqli_fetch_assoc($college_fund)){?>
        <td><?php echo $college_fund_data['fund']?></td>
        <?php }?>
        
        <td>Year</td>
        <td>Date</td>
        <th>Grant Total</th>
    </tr>
    <?php
	$i=1;
	$rs=mysqli_query($con,"SELECT  dt, boysfunddte.scid,count(distinct sid) as total, coursename,name,year,sum(boysfunddte.fees) as gtotal FROM boysfunddte join courses on courses.id=boysfunddte.cid join subcourse on boysfunddte.scid=subcourse.id group by coursename");
	while($data=mysqli_fetch_assoc($rs)){
	?>
    <tr>
        
		<td><?php echo $i++;?></td>
     	<td><?php echo $data['coursename'];?></td>
     	<td class="right"><?php echo $data['total'];?></td>
        <?php
	$frs=mysqli_query($con,"SELECT boysfunddte.id, sum(boysfunddte.fees) as fees, boysfunddte.cid, boysfunddte.scid, dt,coursename,name,funds FROM boysfunddte join courses on courses.id=boysfunddte.cid join subcourse on boysfunddte.scid=subcourse.id group by  boysfunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs)){
	?>
        <td class="right"><?php echo $fdata['fees'];?></td>
        <?php }?>
        <td><?php echo $data['year'];?></td>
        <td><?php echo $data['dt'];?></td>
        <th class="right"><?php echo $data['gtotal'];?></th>
   </tr>
   <?php }?>
    <tr>
	<th colspan="3">Grant Total</th>
    <?php
	$frs=mysqli_query($con,"SELECT boysfunddte.id, sum(boysfunddte.fees) as fees, boysfunddte.cid, boysfunddte.scid, dt,coursename,name,funds FROM boysfunddte join courses on courses.id=boysfunddte.cid join subcourse on boysfunddte.scid=subcourse.id   group by  boysfunddte.funds");
	while($fdata=mysqli_fetch_assoc($frs)){
	?>
            <th class="right"><?php echo $fdata['fees'];
			
			$gtot+=$fdata['fees'];
			?></th>
        <?php }?>
	<th class="right" colspan="3"><?php echo $gtot?></th>

    </tr>
</table>
<div>

</div>
	