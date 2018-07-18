<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		deleteData('boysfund',$id);
		?>
        	<script>
				location.href="index.php?mod=bfund&do=bfundlist";
			</script>
        <?php	
	}
?>
<table  class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="7">Boys Fund List</td>
    </tr>
    <tr>
    	<td colspan="7" align="right"><a href="index.php?mod=bfund&do=bfundedit">Add new Record</a></td>
    </tr>
    <tr>
    	<td>S. No.</td>
        <td>Year</td>
        <td>Fund Name</td>
        <td>Fees</td>
        <td>Fund Dived Into</td>
        <td>Action</td>
    </tr>
    <?php

$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,'SELECT COUNT(*) AS tot FROM boysfund LIMIT 1') ;
		$totRslt=mysqli_fetch_assoc($rs);
  
$i=0;

			$list=mysqli_query($con,"select id,fund,fees, year, dived from boysfund order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);

		
		$i=1;
		while($bfunddata=mysqli_fetch_assoc($list)){
			?>
            <tr>
            	<td><?php echo $i++;?></td>
                <td><?php echo $bfunddata['year'];?></td>
                <td><?php echo $bfunddata['fund']; ?></td>
                <td><?php echo $bfunddata['fees'];?></td>
                <td><?php echo $bfunddata['dived'];?></td>
                <td><a href="index.php?mod=bfund&do=bfundedit&id=<?php echo $bfunddata['id'];?>">Update</a>&nbsp;&nbsp;||&nbsp;&nbsp;
                	<a href="#" onClick="deleteData(<?php echo $bfunddata['id'];?>)">Delete</a>
                </td>
            </tr>
            <?php	
		}
	?>
    <tr>
    	<td colspan="10"><?php PaginationDisplay($totRslt['tot'],'index.php?mod=bfund&do=bfundlist&pageNumber=','');?>
</td>
    </tr>
</table>
<script>
	function deleteData(id){
		if(confirm("Do you really want to delte data")){
			location.href="index.php?mod=bfund&do=bfundlist&id="+id;	
		}
	}
</script>