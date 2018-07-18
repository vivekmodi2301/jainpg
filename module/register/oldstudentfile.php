<?php
	$studentdata="";
	$sid="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$studentdata=mysqli_fetch_assoc(mysqli_query($con,"select student1.id, student1.name, fname, courses.coursename, subcourse.name as sub,regyear,resident,category,bpl,std,phone, mobile,  class, year,subject,obtain,total,percentage,board_name from student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id where student1.id=$id"));	
	//print_r($studentdata);
	}
	if(isset($_POST['name'])){
		
		
		addEdit('student1',$_POST,$id);	
		if($id){
			$_SESSION['updatestudent']="Student Detail has been Updated";
		}
		elseif(!$id){
			$_SESSION['insertstudent']="Student Detail has been Submited";		
		}
		?>
        <script>
			location.href="index.php?mod=register&do=slist";
		</script>
        <?php
	}
?>
<table cellspacing="0px" class="<?php echo $theam;?>_form">
<form method="post">
<tr>
	<td colspan="2">Students</td>
</tr>

<tr>
<td>
	Student Name
</td>
<td>
	<input type="text" name="name" value="<?php if(isset($studentdata['name']) && $studentdata['name']){echo $studentdata['name'];}?>">
</td>
</tr>
<tr>
	<td>Father Name</td>
    <td><input type="text" value="<?php if(isset($studentdata['fname']) && $studentdata['fname']){echo $studentdata['fname'];}?>" name="fname"></td>
</tr>
<tr>
	<td>Registration Period</td>
    <td><input type="text" name="regyear" value="<?php if(isset($studentdata['regyear']) && $studentdata['name']){echo $studentdata['regyear'];}else{?> 2016-2017<?php }?>"></td>
</tr>	
<tr>	
<td>
Select Stream
</td>
<?php if(isset($_GET['id'])){
?>
	<td><input type="text" value="<?php if(isset($studentdata['coursename']) && $studentdata['coursename']){echo $studentdata['coursename'];}?>" readonly></td>
<?php	
}
else{?>
<td>
    <select name="cid" id="cid" onchange="course(this.value,'')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses ");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($groupdata['cid']) && $groupdata['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
                <?php	
			}
		?>
    </select>
</td>
<?php }?>
</tr>
<tr>
<td>
Select Year
</td> 
<?php if(isset($_GET['id'])){
?>
	<td><input type="text" value="<?php if(isset($studentdata['sub']) && $studentdata['sub']){echo $studentdata['sub'];}?>" readonly></td>
<?php	
}
else{?>
<td>
   <select name="scid">
                <option value=""><--- Select Sub Coursename ---></option>
             
            </select>
</td>
<?php }?>
</tr>
<tr>
	<td>Bonafide Resident of Rajasthan</td>
    <td><input type="radio" name="resident" <?php if(isset($studentdata['resident']) && $studentdata['resident']=='y'){?> checked<?php }?> value="y">Yes<input type="radio" <?php if(isset($studentdata['resident']) && $studentdata['resident']=='n'){?> checked<?php }?> name="resident" value="n">No</td>
</tr>
<tr>
	<td>Category</td>
    <td>
    	<input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='sc'){?> checked<?php }?> value="sc">SC
    	<input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='st'){?> checked<?php }?> value="st">ST
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='obc'){?> checked<?php }?> value="obc">OBC
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='sbc'){?> checked<?php }?> value="sbc">SBC
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='saharia'){?> checked<?php }?> value="saharia">Saharia
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='gen'){?> checked<?php }?> value="gen">Gen.
    </td>
</tr>
<tr>
	<td>BPL</td>
    <td><input type="radio" name="bpl" <?php if(isset($studentdata['bpl'])&&$studentdata['bpl']=='y'){?> checked<?php }?> value="y">Yes<input type="radio" name="bpl" <?php if(isset($studentdata['bpl'])&&$studentdata['bpl']=='n'){?> checked<?php }?> value="n">No</td>
</tr>
<tr>
	<td>Phone No.</td>
    <td><input type="text" style="width:50px;" name="std" value="<?php if(isset($studentdata['std'])&&$studentdata['std']){echo $studentdata['std'];}else{?> 0151 <?php }?>"><input type="text" value="<?php if(isset($studentdata['std'])&&$studentdata['std']){echo $studentdata['phone'];}?>" name="phone"></td>
</tr>
<tr>
	<td>Mobile No.</td>
    <td><input type="text" value="<?php if(isset($studentdata['std'])&&$studentdata['std']){echo $studentdata['mobile'];}?>" name="mobile"></td>
</tr>
<tr>
<td>Class</td>
<td><input type="text" value="<?php if(isset($studentdata['class'])&&$studentdata['class']){echo $studentdata['class'];}?>" name="class"></td>
</tr>
<tr><td>Year</td>
<td>
<input type="text" value="<?php if(isset($studentdata['year'])&&$studentdata['year']){echo $studentdata['year'];}?>" name="year"></td>
</tr>
<tr>
<td>Subject</td>
<td><input type="text" value="<?php if(isset($studentdata['subject'])&&$studentdata['subject']){echo $studentdata['subject'];}?>" name="subject"></td>
</tr>
<tr><td>Obtain Marks</td>
<td><input type="text" value="<?php if(isset($studentdata['obtain'])&&$studentdata['obtain']){echo $studentdata['obtain'];}?>" name="obtain"></td>
</tr>
<tr><td>Total Marks</td>
                <td><input type="text" value="<?php if(isset($studentdata['total'])&&$studentdata['total']){echo $studentdata['total'];}?>" name="total"></td>
</tr>                
                
     <tr>           <td>Percentage</td>
            <td><input type="text" value="<?php if(isset($studentdata['percentage'])&&$studentdata['percentage']){echo $studentdata['percentage'];}?>" name="percentage"></td>
            </tr>
            <tr>
                <td>Board_name</td>
         
                <td><input type="text" value="<?php if(isset($studentdata['board_name'])&&$studentdata['board_name']){echo $studentdata['board_name'];}?>" name="board_name"></td>
            </tr>
<tr>
<td colspan="2">
    <input type="submit" value="submit">
</td>
</tr>
</form>
</table>
<script src="js/jquery.js.js"></script>
<script>
	function course(cid,scid){
	$.ajax({
	url:"module/register/subcourse.php",
	data:"cid="+cid+"&scid="+scid,
	type:'GET',
	success: function(data){$('#subcourse').html(data);},
	});
 	}
	
	$(document).ready(function(e) {
    <?php if(isset($_GET['id']) && $_GET['id']){?>
	course(cid.value,'<?php echo $studentdata['scid'];?>');
	<?php }?>    
    });
</script>
<script>
function course(cval,scval)
{
	alert(cval);
	$.ajax({
		url:"module/group/subcoursesload.php",
		data: 'cid='+cval+'&id='+scval,
		type:'GET',
		success: function(res){
			
			$('#scid').html(res);
			if(scval)
			{
				loadcourses(cval,scval);
				}
			}
	});
}
function loadcourses(cval,scval)
{
	$.ajax({
		url: "module/group/loadcourses.php",
		data: 'cid='+cval+'&scid='+scval,
		type:'GET',
		success: function(as){$('#courses').html(as);}
	});
}
</script>