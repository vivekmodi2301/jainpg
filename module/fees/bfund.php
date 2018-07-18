<?php
	if(isset($_GET['sid'])){
		echo $tot;exit;
		$tot=$_GET['tot'];
		$sid=$_GET['sid'];
		$crs=mysqli_query($con,"select id,fund,fees,year from boysfund");
		while($cfunddte=mysqli_fetch_assoc($crs)){
			$_POST['sid']=$sid;
			$_POST['funds']=$cfunddte['id'];
			$_POST['fees']=$cfunddte['fees'];
			$_POST['year']=$cfunddte['year'];
			$tot=$cfunddte['fees'];
			addEdit('boysfunddte',$_POST);
			?>
            	<script>
					location.href="index.php?mod=fees&do=feeslist&sid=<?php echo $sid;?>&tot=<?php echo $tot;?>";
				</script>

            <?php
		}
	}
?>