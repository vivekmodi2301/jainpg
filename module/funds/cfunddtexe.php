<table class="<?php echo $theam;?>_list">
<tr>
	<td colspan="4">List of Excel File of College Fund Detail</td>
</tr>
<tr>
	<td>S.No.</td>
    <td>Name</td>
    <td>Date</td>
    <td>Download</td>
</tr>	
<tr>
	<td colspan="4"><a href="index.php?mod=funds&do=ccfunddtexe">Add New Excel File</a></td>
</tr>
<?php $rs=mysqli_query($con,"select id,filename,date from collegefundexcelfile order by date desc");
$i=1;
	while($data=mysqli_fetch_assoc($rs)){?>
<tr>
	<td><?php echo $i++;?></td>
    <td><?php echo $data['filename'];?></td>
    <td><?php echo $data['date'];?></td>
    <td><a href="college/<?php echo $data['filename'];?>">Download</a></td>
</tr>
<?php }?>
</table>