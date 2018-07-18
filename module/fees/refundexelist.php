<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="4">Refund Fees List</td>
    </tr>
	<tr>
    	<td>S.No.</td>
        <td>Filename</td>
        <td>Date</td>
        <td>Download</td>
    </tr>
    <tr>
    	<td colspan="4"><a href="index.php?mod=fees&do=refundexe">Add New</a></td>
    </tr>
    <?php
		$i=1;
		$rs=mysqli_query($con,"SELECT id,filename,date from refundexe");
		while($refundexe=mysqli_fetch_assoc($rs)){
	?>
    <tr>
    	<td><?php echo $i++;?></td>
        <td><?php echo $refundexe['filename'];?></td>
        <td><?php echo $refundexe['date'];?></td>
        <td><a href="refundexe/<?php echo $refundexe['filename'];?>">Download</a></td>
    </tr>
    <?php
		}
	?>
</table>