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
	$college_fund=mysqli_query($con,"SELECT id, fund from collegefund");

?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="<?php echo mysqli_num_rows($college_fund)+4;?>">College Funds List</td>
    </tr>

	<tr>
    	<td>S. No.</td>
        <td>Student Name</td>
        
        <?php 
		
		
		while($college_fund_data=mysqli_fetch_assoc($college_fund)){?>
        <td><?php echo $college_fund_data['fund']?></td>
        <?php }?>
        
        <td>Year</td>
        <td>Date</td>
    </tr>
    <?php
	$rs=mysqli_query($con,"select distinct sid,name,collegefunddte.year,collegefunddte.date FROM collegefunddte join student1 on sid=student1.id join collegefund on funds=collegefund.id group by sid ");
	while($data=mysqli_fetch_assoc($rs)){?>
    <tr>
    <?php
	//echo "SELECT collegefunddte.id, sid, date, funds, collegefunddte.fees,name, collegefunddte.year,fund FROM collegefunddte join student1 on sid=student1.id join collegefund on funds=collegefund.id where collegefunddte.sid=$data[sid]";

			$list=mysqli_query($con,"SELECT collegefunddte.id, sid, date, funds, collegefunddte.fees,name, collegefunddte.year,fund FROM collegefunddte join student1 on sid=student1.id join collegefund on funds=collegefund.id where collegefunddte.sid=$data[sid]");

		$i=1;?>
        
		<td><?php echo $i++;?></td>
     	       	<td><?php echo $data['name'];?></td>
             
        <?php     
		while($studentdata=mysqli_fetch_assoc($list)){
			?>
      
                <td><?php echo $studentdata['fees'];?></td>
            <?php	
		}
	?>
              <td><?php echo $data['year']?></td>
                <td><?php 
				$new=date('d-M-Y',strtotime($data['date']));
				echo $new?></td>
     
       </tr>
         <?php	
		}
	?>   
    <tr>
    	<td colspan="10">
		<?php PaginationDisplay($totRslt['tot'],'index.php?mod=funds&do=cfundlist&pageNumber=','');?>
</td>
    </tr>
</table>
<div>

</div>
	