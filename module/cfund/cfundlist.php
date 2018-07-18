<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		deleteData('collegefund',$id);	
	}
?>
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="7">College Fund List</td>
    </tr>
    <tr>
    	<td colspan="7" align="right"><a href="index.php?mod=cfund&do=cfundedit">Add new Record</a></td>
    </tr>
    <tr>
    	<td>S. No.</td>
        <td>Year</td>
        <td>Fund Name</td>
        <td>Fees</td>
        <td>Fund Dived</td>
        <td>Action</td>
    </tr>
    <?php
	
	$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,'SELECT COUNT(*) AS tot FROM collegefund LIMIT 1') ;
		$totRslt=mysqli_fetch_assoc($rs);
  
$i=0;

			$list=mysqli_query($con,"select id,fund,fees, year, dived from collegefund order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);

		
	
		$i=1;
		while($cfunddata=mysqli_fetch_assoc($list)){
			?>
            <tr>
            	<td><?php echo $i++;?></td>
                <td><?php echo $cfunddata['year'];?></td>
                <td><?php echo $cfunddata['fund']; ?></td>
                <td><?php echo $cfunddata['fees'];?></td>
                <td><?php echo $cfunddata['dived'];?></td>
                <td><a href="index.php?mod=cfund&do=cfundedit&id=<?php echo $cfunddata['id'];?>">Update</a>&nbsp;&nbsp;||&nbsp;&nbsp;
                	<a href="#" onClick="deleteData(<?php echo $cfunddata['id'];?>)">Delete</a>
                </td>
            </tr>
            <?php	
		}
	?>
        <tr>
    	<td colspan="10"><?php PaginationDisplay($totRslt['tot'],'index.php?mod=cfund&do=cfundlist&pageNumber=','');?>
</td>
    </tr>
</table>
<script>
	function deleteData(id){
		if(confirm("Do you really want to delte data")){
			location.href="index.php?mod=cfund&do=cfundlist&id="+id;	
		}
	}
</script>