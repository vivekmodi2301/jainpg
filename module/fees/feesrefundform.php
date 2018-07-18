
<?php
$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$stufee=mysqli_fetch_assoc(mysqli_query($con,"select student1.id as student, studentfees.id, student1.name,student1.cid,student1.scid, courses.coursename as course,subcourse.fees as totfee,dte, instalment1,instalment2, subcourse.name as year from studentfees right join student1 on sid=student1.id right join courses on student1.cid=courses.id right join subcourse on student1.scid=subcourse.id where student1.id=$id"));
	}
	if(isset($_POST['refund_reson'])){
		?>
        Data is submiting
        <?php
	addEdit('student1',$_POST,$id);	
?>
	<script>
		location.href="index.php?mod=fees&do=feesrefundlist";
	</script>
<?php
}

	?>
<form method="post" >
<table cellspacing="0px" class="<?php echo $theam;?>_form">

<tr>
	<td colspan="2">Fees</td>
</tr>
<tr>
	<td>
    	Course Name
    </td>
    <td>
    <input type="hidden" name="cid" value="<?php echo $stufee['cid'];  ?>" readonly>
    <input type="hidden" name="scid" value="<?php echo $stufee['scid'];  ?>" readonly>
        <input type="text" value="<?php if(isset($stufee['course']) && $stufee['course']){echo $stufee['course'];}  ?>" readonly>
    </td>
</tr>
<tr>
	<td>
    	Year
    </td>
    <td>
    	<input type="text" value="<?php if(isset($stufee['year']) && $stufee['year']){echo $stufee['year'];}  ?>" readonly>
    </td>
</tr>
<tr>
	<td>
    	Student Name
    </td>
    <td>
    	<input type="text" value="<?php if(isset($stufee['name']) && $stufee['name']){echo $stufee['name'];}  ?>" readonly>
    </td>
</tr>
<tr>
	<td>Fees Refund Reson</td>
	<td>
    	<select name="refund_reson">
        	<option value="fail">Fail</option>
            <option value="form cancel">Form cancel</option>
            <option value="stream change">Stream Change</option>
            <option value="subject change">Subject Change</option>
            <option value="other">Other</option>
        </select>
    </td>
</tr>
<tr>
	<td>Fees Refund Date</td>
    <td><input type="text" name="refund_date" value="<?php echo date('Y-M-d h:m:s');?>"></td>
</tr>
<tr>
	<td>Fees Refund</td>
    <td><input type="text" name="refund_fees"></td>
</tr>
<tr>
	<td colspan="2"><input type="submit" value="Submit"></td>
</tr>
</table>
</form>
