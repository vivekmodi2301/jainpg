<table class="<?php echo $theam;?>_list">
<tr>
	<td colspan="4">List of Excel File of Boys Fund Detail</td>
</tr>
<tr>
	<td>S.No.</td>
    <td>Name</td>
    <td>Date</td>
    <td>Download</td>
</tr>	
<tr>
	<td colspan="4"><a href="index.php?mod=funds&do=cbfunddtexe">Add New Excel File</a></td>
</tr>
<?php $rs=mysqli_query($con,"select id,filename,date from boyfundexcelfile order by id desc");
$i=1;
	while($data=mysqli_fetch_assoc($rs)){?>
<tr>
	<td><?php echo  $i++;?></td>
    <td><?php echo $data['filename'];?></td>
    <td><?php echo $data['date'];?></td>
    <td><a href="boys/<?php echo $data['filename'];?>">Download</a></td>
</tr>
<?php }?>
</table>
<script>
function course(cval,scval,optsubject)
{
	$.ajax({
		url:"module/register/subcoursesload.php",
		data: 'cid='+cval+'&id='+scval+'&subject='+optsubject,
		type:'GET',
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