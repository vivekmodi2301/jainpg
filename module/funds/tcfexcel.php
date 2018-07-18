<?php $rs=mysqli_query($con,"select id,filename,date from collegefundexcelfile");
	while($data=mysqli_fetch_assoc($rs)){ ?>
	<a href="collegefundexcelfile/<?php echo $data['filename'];?>">Download Faculty List File <?php echo $data['date']?></a><br>

<?php }?>