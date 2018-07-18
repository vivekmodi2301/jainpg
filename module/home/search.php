<table cellspacing="0px" class="<?php echo $theam;?>_form">
<tr>
	<td colspan="2">Total Stuents</td>
</tr>
<?php 
	$total="";
	$rs=mysqli_query($con,"select count(cid) as cid,coursename from student1 right join courses on courses.id=cid group by courses.id");
	while($data=mysqli_fetch_assoc($rs)){
	
	?>
	<tr>
    	<td><?php echo $data['coursename']?></td>
        <td><?php echo $data['cid'];
			$total+=$data['cid']
		?></td>
    </tr>
    <?php 
	}
	?>
    <tr>
    	<td>Total</td>
        <td><?php echo $total;?></td>
    </tr>
    
</table>
