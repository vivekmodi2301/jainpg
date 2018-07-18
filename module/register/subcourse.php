<?php
	include_once("../../config.php");
	include_once("../../function.php");
	if(isset($_POST['cid'])){
		$cid=$_POST['cid'];
		$id=$_POST['scid'];
	?>
    
        <option value=""><--- Select Year ---></option>
        <?PHP
	$rs=mysqli_query($con,"select subcourse.id as id, subcourse.name  from subcourse right join courses on cid=courses.id where courses.id=$cid");
	while($cdata=mysqli_fetch_assoc($rs)){
		
	?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($id) && $id==$cdata['id']){ echo "selected";}?>><?php echo $cdata['name'];?></option>
    <?php
	}
	
	}
	
?>