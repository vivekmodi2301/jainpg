<?php
include "../../config.php";
include "../../function.php";
$rs=mysqli_query($con,"select id,name,cid,scid from subject where cid=$_POST[cid] && scid=$_POST[scid] group by name");
$j=0;
?>


<select name="subjectid" id="subjectid">
    <option value=""><--- Select Subject ---></option>
    <?php		
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['name'];?>"><?php echo $cdata['name'];?></option>
                <?php	
			}
		?>
</select>


