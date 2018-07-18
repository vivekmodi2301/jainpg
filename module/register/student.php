<?php
	$studentdata="";
	$error="";
	$usererror="";
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$studentdata=mysqli_fetch_assoc(mysqli_query($con,"SELECT student1.id as id, student1.name as name, student1.cid as cid, fname, optsubject, student1.scid as scid, regyear, resident, category, bpl, dt,std, phone, mobile, class, year, subject, obtain, total, percentage, board_name,scholarcode,classcode,submitDate FROM student1 left join courses on cid=courses.id left join subcourse on scid=subcourse.id where student1.id=$id
"));	
	//print_r($studentdata);
}
	if(isset($_POST['name'])){

	if(is_array($_POST['regyear']))
	{
		$_POST['regyear']=implode('-',$_POST['regyear']);	
	}



	/*if (!preg_match("^([a-zA-Z]){4,26}$",$username))
	{
	 	$usererror="Please enter only characters and name must be less than 30 characters";
		$error=1;
	}*/
	


		if(isset($_POST['courses']))
		{
			$_POST['optsubject']=implode(',',$_POST['courses']);
//			echo $_POST['optsubject']; exit;
			unset($_POST['courses']);
		}
		if(isset($_POST['compulsorysubject']))
		{
			$_POST['compulsorysubject']=implode(',',$_POST['compulsorysubject']);
//			echo $_POST['optsubject']; exit;
			//unset($_POST['courses']);
		}
		if(isset($_POST['edited']) && $_POST['edited']=='yes')
		{
			unset($_POST['edited']);
			//print_r($_POST);exit;
			}else
			{	
				unset($_POST['edited']);
				unset($_POST['old_cid']);
				unset($_POST['old_scid']);
				unset($_POST['old_subject']);
				//print_r($_POST);exit;
				}
				
		
			
		addEdit('student1',$_POST,$id);
		?>
<script>
			location.href="index.php?mod=register&do=slist";
		</script>
<?php
		
	}
?>
<form method="post" enctype="multipart/form-data">
  <table cellspacing="0px" class="<?php echo $theam;?>_form">
    <tr>
      <td colspan="2">Students</td>
    </tr>
    <tr>
      <td> Student Name </td>
      <td><input type="text" placeholder="Enter Student Name" name="name" value="<?php if(isset($studentdata['name']) && $studentdata['name']){echo $studentdata['name'];}?>" required>
      
      </td>
    </tr>
    <tr>
      <td>Father Name</td>
      <td><input type="text" placeholder="Enter Student Father Name" value="<?php if(isset($studentdata['fname']) && $studentdata['fname']){echo $studentdata['fname'];}?>" name="fname" required ></td>
    </tr>
    <tr>
      <td>Registration Date</td>
      <td><input type="date" name="submitDate" value="<?php if(isset($studentdata['submitDate'])&&$studentdata['submitDate']){echo $studentdata['submitDate'];} else{echo date('Y-m-d');}?>"></td>
    </tr>
    <tr>
    <td>Compulsory Subject</td>
    <td>
    
    <?php		$crs=mysqli_query($con,"select id,subname from compulsorysubject ");
			while($csdata=mysqli_fetch_assoc($crs)){
				
				?>                
                <input type="checkbox" value="<?php if(isset($csdata['subname']) && $csdata['subname']){echo $csdata['subname'];}?>" name="compulsorysubject[]" checked><?php echo $csdata['subname'];?>
                <?php } ?>
                

    </td>
    </tr>
    <?php
if(isset($_GET['id'])){?>
    <tr>
      <td rowspan="3">Selected Stream, Year, Courses</td>
      <td><input type="text" readonly value="<?php $detail=mysqli_fetch_assoc(mysqli_query($con,"select student1.id, courses.coursename, subcourse.name, optsubject from student1 left join courses on student1.cid=courses.id left join subcourse on student1.scid=subcourse.id where student1.id=$id")); echo $detail['coursename'] ?>">
        <input type="tex" name="old_cid" value="<?php echo $studentdata['cid'];?>" hidden="hidden"></td>
    </tr>
    <tr>
      <td><input type="text" readonly value="<?php echo $detail['name'];?>">
        <input type="hidden" value="<?php echo $studentdata['scid'];?>" name="old_scid" hidden="hidden"></td>
    </tr>
    <tr>
      <td ><input type="text" style="width:350px;" name="old_subject" value="<?php echo $detail['optsubject'];?>"></td>
    </tr>
    <?php }?>
    <?php
if($id){?>
    <tr>
      <td>Change Stream or Year or Subjects</td>
      <td><input type="checkbox" name="edited" value="yes" id="show" onClick="display()"></td>
    </tr>
    <?php }?>
    <tr id="hcid" <?php if($id){?> style="display:none;"<?php }?>>
      <td> Select Stream </td>
      <td><select name="cid" id="cid" onchange="course(this.value,'','')">
          <option value=""><--- Select Coursename ---></option>
          <?php		$rs=mysqli_query($con,"select id,coursename from courses ");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
          <option value="<?php echo $cdata['id'];?>" <?php if(isset($studentdata['cid']) && $studentdata['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
          <?php	
			}
		?>
        </select></td>
    </tr>
    <tr id="hscid" <?php if($id){?> style="display:none;"<?php }?>>
      <td> Select Year </td>
      <td id="scid"><select name="scid">
          <option value=""><--- Select Sub Coursename ---></option>
        </select></td>
    </tr>
    <tr id="hsubject" <?php if($id){?> style="display:none;"<?php }?>>
      <td>Courses</td>
      <td id="courses"></td>
    </tr>
    <tr>
      <td>Scholar Code</td>
      <td><input type="text" readonly value="Scholar"/>
        <input type="text" id="classcode" readonly value="<?php echo $studentdata['classcode']?>"/>
        <input type="text" required placeholder="Enter Scholar Id" value="<?php if(isset($studentdata['scholarcode']) && $studentdata['scholarcode']){echo $studentdata['scholarcode'];} else {  echo getlastRrcord()+1;}?>" name="scholarcode"></td>
    </tr>
    <tr>
      <td>Registration Period</td>
      <td><input type="number" name="regyear[]" onChange="increase_year(this.value)" value="<?php if(isset($studentdata['regyear']) && $studentdata['regyear']){echo substr($studentdata['regyear'],0,strpos($studentdata['regyear'],'-'));}?>">
        <input type="number" id="year" value="<?php if(isset($studentdata['regyear']) && $studentdata['regyear']){echo substr($studentdata['regyear'],strpos($studentdata['regyear'],'-')+1);}?>" name="regyear[]"></td>
    </tr>
    <script>
function increase_year(val)
{
	val=parseInt(val);
	document.getElementById('year').value=eval(val+1);
}
</script>
    <tr>
      <td>Bonafide Resident of Rajasthan</td>
      <td><input type="radio" name="resident" <?php if(isset($studentdata['resident']) && $studentdata['resident']=='y'){?> checked<?php }?> value="y">
        Yes
        <input type="radio" <?php if(isset($studentdata['resident']) && $studentdata['resident']=='n'){?> checked<?php }?> name="resident" value="n">
        No</td>
    </tr>
    <tr>
      <td>Category</td>
      <td><input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='sc'){?> checked<?php }?> value="sc">
        SC
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='st'){?> checked<?php }?> value="st">
        ST
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='obc'){?> checked<?php }?> value="obc">
        OBC
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='sbc'){?> checked<?php }?> value="sbc">
        SBC
        <input type="radio" name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='saharia'){?> checked<?php }?> value="saharia">
        Saharia
        <input type="radio"  name="category" <?php if(isset($studentdata['category'])&&$studentdata['category']=='gen'){?> checked<?php }?> value="gen">
        Gen. </td>
    </tr>
    <tr>
      <td>BPL</td>
      <td><input type="radio" name="bpl" <?php if(isset($studentdata['bpl'])&&$studentdata['bpl']=='y'){?> checked<?php }?> value="y">
        Yes
        <input type="radio" name="bpl" value="n">
        No</td>
    </tr>
    <tr>
      <td>Phone No.</td>
      <td><input type="text" style="width:50px;" name="std" value="<?php if(isset($studentdata['std'])&&$studentdata['std']){echo $studentdata['std'];}else{?> 0151 <?php }?>">
        <input type="text" placeholder="Enter Student Phone no." value="<?php if(isset($studentdata['std'])&&$studentdata['std']){echo $studentdata['phone'];}?>" name="phone"></td>
    </tr>
    <tr>
      <td>Mobile No.</td>
      <td><input type="text" placeholder="Enter Student Mobile no." value="<?php if(isset($studentdata['std'])&&$studentdata['std']){echo $studentdata['mobile'];}?>" name="mobile"></td>
    </tr>
    <tr>
      <td>Date</td>
      <td><input type="date" name="dt" value="<?php if(isset($studentdata['dt'])&&$studentdata['dt']){echo $studentdata['dt'];} else{echo date('Y-m-d');}?>"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><strong>Last Year Details</strong></td>
    </tr>
    <tr>
      <td>Class</td>
      <td><input type="text" placeholder="Previous Class name" value="<?php if(isset($studentdata['class'])&&$studentdata['class']){echo $studentdata['class'];}?>" name="class"></td>
    </tr>
    <tr>
      <td>Year</td>
      <td><input type="text" placeholder="Year of passing last class" value="<?php if(isset($studentdata['year'])&&$studentdata['year']){echo $studentdata['year'];}?>" name="year"></td>
    </tr>
    <tr>
      <td>Subject</td>
      <td><input type="text" placeholder="Commerse/Science/Arts" value="<?php if(isset($studentdata['subject'])&&$studentdata['subject']){ echo $studentdata['subject'];}?>" name="subject"></td>
    </tr>
    <tr>
      <td>Obtain Marks</td>
      <td><input type="text" placeholder="Marks Obtained by Student in last class" value="<?php if(isset($studentdata['obtain'])&&$studentdata['obtain']){echo $studentdata['obtain'];}?>" name="obtain"></td>
    </tr>
    <tr>
      <td>Total Marks</td>
      <td><input type="text" placeholder="Total Marks of Last Class" value="<?php if(isset($studentdata['total'])&&$studentdata['total']){echo $studentdata['total'];}?>" name="total"></td>
    </tr>
    <tr>
      <td>Percentage</td>
      <td><input type="text" placeholder="Last class Percentage" value="<?php if(isset($studentdata['percentage'])&&$studentdata['percentage']){echo $studentdata['percentage'];}?>" name="percentage"></td>
    </tr>
    <tr>
      <td>Board Name</td>
      <td>
	  <input type="radio" name="board_name" <?php if(isset($studentdata['board_name'])&&$studentdata['board_name']=='CBSE'){echo "checked";}?> value="CBSE">CBSE
	  <input type="radio" name="board_name" <?php if(isset($studentdata['board_name'])&&$studentdata['board_name']=='RBSE'){echo "checked";}?> value="RBSE">RBSE
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="submit"></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
	function mshow(chk,radioo,tot){
			var checkedCheckBoxes = $('#courses').find(':radio:checked');
			if (checkedCheckBoxes.length <= tot) {
						if ($(chk).is(":checked")) {
							$(radioo).each(function(e){ $(this).removeAttr("disabled");
								$(this).attr("checked","checked");
							})
						} else {
								$(radioo).each(function(e){
									$(this).removeAttr("checked", false);
									$(this).removeAttr("disabled", "disabled");})
								}
				
			}
			else{
				chk.checked = false;
				alert("Please select only "+ tot +" groups");	
			}

	}
	</script> 
<script>
function course(cval,scval,optsubject)
{
	$.ajax({
		url:"module/register/subcoursesload.php",
		data: 'cid='+cval+'&id='+scval+'&subject='+optsubject,
		type:'POST',
		success: function(res){
			
			$('#scid').html(res);
			if(scval)
			{
				loadcourses(cval,scval,optsubject);
				}
			}
	});
}
function loadcourses(cval,scval,optsubject)
{
			
		var cval=encodeURIComponent(cval);
		var scval=encodeURIComponent(scval);
		var optsubject= encodeURIComponent(optsubject);
	$.ajax({
		url: "module/register/loadcourses.php",
		
		data: 'cid='+cval+'&scid='+scval+'&subject='+optsubject,
		type:'POST',
		success: function(as){$('#courses').html(as);}
	});
}
<?php if($id){?>
	$(document).ready(function(e) {
        course(cid.value,'<?php echo $studentdata['scid'];?>','<?php echo $studentdata['optsubject'];?>');
    });
	<?php }?>
	function display(){
		if(document.getElementById('show').checked){
		document.getElementById('hcid').style.display="";
		document.getElementById('hscid').style.display="";
		document.getElementById('hsubject').style.display="";	
		}
		else{
			document.getElementById('hcid').style.display="none";
			document.getElementById('hscid').style.display="none";
			document.getElementById('hsubject').style.display="none";
		}
	}
</script>