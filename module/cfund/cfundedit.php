<?php
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$cfunddata=mysqli_fetch_assoc(mysqli_query($con,"select id,year,dived,fund,fees from collegefund where id=$id"));
	}
	if(isset($_POST['year'])){
		if(is_array($_POST['year'])){
			$_POST['year']=implode('-',$_POST['year']);	
		}
		addEdit('collegefund',$_POST,$id);
		?>
        	<script>
				location.href="index.php?mod=cfund&do=cfundlist";
			</script>
        <?php	
	}
?>
<form method="post">
<table cellspacing="0px" class="<?php echo $theam;?>_form">
<tr>
	<th colspan="2">College Fund</th>
</tr>
<tr>
	<td>Current Year</td>
	<td><input type="number" name="year[]" onChange="increase_year(this.value)" value="<?php if(isset($cfunddata['year']) && $cfunddata['year']){echo substr($cfunddata['year'],0,strpos($cfunddata['year'],'-'));}?>">
    <input type="number" id="year" value="<?php if(isset($cfunddata['year']) && $cfunddata['year']){echo substr($cfunddata['year'],strpos($cfunddata['year'],'-')+1);}?>" name="year[]"></td>
</tr>
<script>
function increase_year(val)
{
	val=parseInt(val);
	document.getElementById('year').value=eval(val+1);
}
</script>
<tr>
	<td>Fund Name</td>
    <td><input type="text" name="fund" value="<?php if(isset($cfunddata['fund']) && $cfunddata['fund']){echo $cfunddata['fund'];}?>"></td>
</tr>
<tr>
	<td>Fees</td>
    <td><input type="text" name="fees" value="<?php if(isset($cfunddata['fees']) && $cfunddata['fees']){echo $cfunddata['fees'];}?>"></td>
</tr>
<tr>
	<td>Fund Dived Into</td>
    <td>
    	<select name="dived">
    		<option <?php if(isset($cfunddata['dived']) && $cfunddata['dived']){ if($cfunddata['dived']=='1'){?> selected <?php }}?> value="1">1</option>
            <option <?php if(isset($cfunddata['dived']) && $cfunddata['dived']){ if($cfunddata['dived']=='2'){?> selected <?php }}?> value="2">2</option>
        </select>
    </td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="submit"></td>
</tr>
</table>
</form>