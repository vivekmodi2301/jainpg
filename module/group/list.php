<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		deleteData('subjectgroup',$id);
		?>
        	<script>
				location.href="index.php?mod=group&do=list";
			</script>
        <?php	
	}
	$url="index.php?mod=group&do=list&";
		$wh=" where 1 ";
		if(isset($_REQUEST['name']) && $_REQUEST['name']){
			$wh.=" and gname like '%$_REQUEST[name]%' ";
			$url.="name=$_REQUEST[name]&";
		}
		if(isset($_REQUEST['cid']) && $_REQUEST['cid'])
		{
			$wh.=" and subjectgroup.cid=$_REQUEST[cid] ";
			$url.="cid=$_REQUEST[cid]&";
			}
			if(isset($_REQUEST['scid']) && $_REQUEST['scid'])
		{
			$wh.=" and subjectgroup.scid=$_REQUEST[scid] ";
			$url.="cid=$_REQUEST[scid]&";
			}
		$frmdataget=$_REQUEST;
		PaginationWork();
		$rs=mysqli_query($con,"SELECT COUNT(*) AS tot  FROM subjectgroup join courses on subjectgroup.cid=courses.id join subcourse on scid=subcourse.id $wh LIMIT 1") ;
		$totRslt=mysqli_fetch_assoc($rs);
			$list=mysqli_query($con,"SELECT subjectgroup.id as id, coursename, name, gname, subjectgroup.cid as cid, groupsub FROM subjectgroup join courses on subjectgroup.cid=courses.id join subcourse on scid=subcourse.id $wh order by id desc LIMIT ".$frmdata['from'].", ".$frmdata['to']);
	
?>
<form method="post">
<table class="<?php echo $theam;?>_list">
	<tr>
    	<td colspan="2">Search Pannel For Group of Subjects</td>
    </tr>
    <tr>
    	<td>Group Name</td>
        <td><input type="text" value="<?php if(isset($_REQUEST['name']) && $_REQUEST['name']){ echo $_REQUEST['name'];}?>"  name="name"></td>
    </tr>
    <tr style="background-color:#fff; text-align:left; color:#000; font-size:14px; font-weight:normal;">	
		<td>
			Select Stream
		</td>
<td>
    <select name="cid" id="cid" onchange="course(this.value,'','')">
    <option value=""><--- Select Coursename ---></option>
    <?php		$rs=mysqli_query($con,"select id,coursename from courses ");
			while($cdata=mysqli_fetch_assoc($rs)){
				
				?>
                <option value="<?php echo $cdata['id'];?>" <?php if(isset($_REQUEST['cid']) && $_REQUEST['cid']==$cdata['id']){ echo "selected";}?>><?php echo $cdata['coursename'];?></option>
                <?php	
			}
		?>
    </select>
</td></tr>

	<tr>	
		<td>
			Select Year
		</td>
        <td id="scid">
            <select name="scid">
                <option value=""><--- Select Sub Coursename ---></option>
             
            </select>
        </td>
	</tr>
    <tr>
    	<td colspan="2" align="center"><input type="submit" value="Search"></td>
    </tr>
</table>
</form>
<br><br>
<table class="<?php echo $theam;?>_list">
	<tr>
		<th colspan="13">
			List of Groups
		</th>
	</tr>
	
    <tr>
    	<td colspan="13" align="right"><a href="index.php?mod=group&do=groupedit">Add new Record</a></td>
    </tr>
	<tr>
    	<td>S. No.</td>
        <td>Group Name</td>
        <td>Stream</td>
        <td>Year</td>
        <td>Group Subject</td>
        <td>Action</td>
    </tr>
    <?php
		$i=1;
		while($groupdata=mysqli_fetch_assoc($list)){
			?>
            <tr>
            	<td width="50px"><?php echo $i++;?></td>
                <td width="100px"><?php echo $groupdata['gname'];?></td>
                <td width="100px"><?php echo $groupdata['coursename']; ?></td>
                <td width="100px"><?php echo $groupdata['name'];?></td>
                
				<td width="250px"><?php echo $groupdata['groupsub'];?></td>
                <td><a href="index.php?mod=group&do=groupedit&id=<?php echo $groupdata['id'];?>">Update</a>
                	<a href="#" onClick="deleteRecord(<?php echo $groupdata['id'];?>)">Delete</a>
                </td>
            </tr>
            <?php	
		}
	?>
    <tr>
    	<td colspan="10">
<?php PaginationDisplay($totRslt['tot'],$url.'pageNumber=','');?></td>
    </tr>
</table>
<script>
	function deleteRecord(id){
		if(confirm("Do you really want to delte record")){
			location.href="index.php?mod=group&do=list&id="+id;	
		}	
	}
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
<?php if($_REQUEST['cid']){?>
	$(document).ready(function(e) {
        course(cid.value,'<?php echo $_POST['scid'];?>','');
    });
	<?php }?>

</script>