<?php
	$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$bfunddata=mysqli_fetch_assoc(mysqli_query($con,"select id,dived,year,fund,fees from boysfund where id=$id"));
	}
	if(isset($_POST['year'])){
		if(is_array($_POST['year'])){
			$_POST['year']=implode('-',$_POST['year']);	
		}
		addEdit('boysfund',$_POST,$id);
		?>
        	<script>
				location.href="index.php?mod=bfund&do=bfundlist";
			</script>
        <?php	
	}
?>
<form method="post">
<table cellspacing="0px" class="<?php echo $theam;?>_form">
<tr>
	<td colspan="2">Boys Fund</td>
</tr>
<tr>
	<td>Current Year</td>
	<td><input type="number" name="year[]" onChange="increase_year(this.value)" value="<?php if(isset($bfunddata['year']) && $bfunddata['year']){echo substr($bfunddata['year'],0,strpos($bfunddata['year'],'-'));}?>">
    <input type="number" id="year" value="<?php if(isset($bfunddata['year']) && $bfunddata['year']){echo substr($bfunddata['year'],strpos($bfunddata['year'],'-')+1);}?>" name="year[]"></td>
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
    <td><input type="text" name="fund" value="<?php if(isset($bfunddata['fund']) && $bfunddata['fund']){echo $bfunddata['fund'];}?>"></td>
</tr>
<tr>
	<td>Fees</td>
    <td><input type="text" name="fees" value="<?php if(isset($bfunddata['fees']) && $bfunddata['fees']){echo $bfunddata['fees'];}?>"></td>
</tr>
<tr>
	<td>Fund Dived Into</td>
    <td>
    	<select name="dived">
    		<option <?php if(isset($bfunddata['dived']) && $bfunddata['dived']){ if($bfunddata['dived']=='1'){?> selected <?php }}?> value="1">1</option>
            <option <?php if(isset($bfunddata['dived']) && $bfunddata['dived']){ if($bfunddata['dived']=='2'){?> selected <?php }}?> value="2">2</option>
        </select>
    </td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="submit"></td>
</tr>
</table>
</form>