	<?php
	include_once("../../config.php");
	include_once("../../function.php");
	if(isset($_GET['cid']) && isset($_GET['scid'])){
		?>
        <?php
		$cid=$_GET['cid'];
		$scid=$_GET['scid'];
		$id=$_GET['id'];
		if($id){
			$qry="select student1.id, student1.name, subcourse.fees, subcourse.instalment1, subcourse.instalment2 from student1 join subcourse on scid=subcourse.id where student1.id=$id";
			$rs=mysqli_fetch_assoc(mysqli_query($con,$qry));
			?>
            <option value="<?php echo $rs['id'];?>"><?php echo $rs['name'];?></option>
            <script>
				document.getElementById('totfee').value=<?php echo $rs['fees'];?>;
				document.getElementById('fins').value=<?php echo $rs['instalment1'];?>;
			</script>
            <?php	
			
		}
		else{
			?>
			<option value=""><--- Select Student ---></option>
            <?php
			$qry="select student1.id, student1.name from student1 join courses on cid=courses.id join subcourse on scid=subcourse.id where student1.cid=$cid and scid=$scid";
		$rs=mysqli_query($con,$qry);
		while($studata=mysqli_fetch_assoc($rs)){
			?>
            	<option  value="<?php echo $studata['id'];?>"><?php echo $studata['name'];?></option>
            <?php	
		}
	}
	}
?>