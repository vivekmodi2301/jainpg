<?php
$id="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$stufee=mysqli_fetch_assoc(mysqli_query($con,"select student1.id as student, studentfees.id, student1.name,student1.cid,student1.scid, courses.coursename as course,subcourse.fees as totfee,optsubject,dte, instalment1,instalment2, subcourse.name as year, refund_fees, old_cid, old_scid from studentfees right join student1 on sid=student1.id right join courses on student1.cid=courses.id right join subcourse on student1.scid=subcourse.id left join subject on student1.cid=subject.id where student1.id=$id"));
	}
	?>
<form method="post" action="index.php?mod=fees&do=submitfeeprocess&id=<?php echo $id;?>">
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
	<td>Date</td>
    <td><input type="date" name="dte" value="<?php echo date('Y-m-d');?>"></td>
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
	<td>Total Fees</td>
    <?php if($stufee['refund_fees']){
		$fee=mysqli_fetch_assoc(mysqli_query($con,"select id, cid, fees,instalment1, instalment2 from subcourse where cid=$stufee[old_cid] and id= $stufee[old_scid]"));
		?>
        <td><input type="text" readonly value="<?php echo $fee['fees'];?>"></td>
        <?php } else{
			
			$sub=str_replace(',',"','",$stufee['optsubject']);
			$sub="'$sub'";
			$rs=mysqli_query($con,"select sum(extraFees) as extraFees from subject where cid=$stufee[cid] and scid=$stufee[scid] and name in($sub)");
			
			$extrafees=mysqli_fetch_assoc($rs);
			
//			echo $stufee['totfee'];
			
				$totFees=$stufee['totfee']+$extrafees['extraFees'];
			$ers=mysqli_query($con,"select extraFees,name from subject where cid=$stufee[cid] and scid=$stufee[scid] and name in($sub)");
			
			
			?>
	<td><input type="text" readonly name="tf" value="<?php echo $totFees;?>"></td>
    <?php }?>
</tr>

<?php $ers=mysqli_query($con,"select extraFees,name from subject where cid=$stufee[cid] and scid=$stufee[scid] and name in($sub) and extraFees!=0");
while($efdata=mysqli_fetch_assoc($ers)){
?>
<tr>
	<td><?php echo $efdata['name']?></td>
    <td>
    <input type="hidden" value="<?php echo $efdata['name'];?>" 
    name="extraFees[<?php echo $efdata['name']?>]"/>
    <input type="text" readonly name="extraFees[<?php echo $efdata['name']?>]" value="<?php echo $efdata['extraFees']?>"/></td>
</tr>
<?php }?>
<tr>
	<td>Boys Fund</td>
    <td>
    	<?php
			$bfund=mysqli_query($con,"select id,fund,fees,year from boysfund");
			while($bfunddte=mysqli_fetch_assoc($bfund)){
				?>
                	<input type="checkbox" checked name="boysfund[]" value="<?php echo $bfunddte['id'];?>"><?php echo $bfunddte['fund'];?>
                <?php	
			}
		?>
    </td>
</tr>
<tr>
	<td>College Fund</td>
    <td>
    	<?php
			$cfund=mysqli_query($con,"select id,fund,fees,year from collegefund");
			while($cfunddte=mysqli_fetch_assoc($cfund)){
				?>
                	<input type="checkbox" checked name="collegefund[]" value="<?php echo $cfunddte['id'];?>"><?php echo $cfunddte['fund'];?>
                <?php	
			}
		?>
    </td>
</tr>

<tr>
	<td>Instalment First</td>
    <?php if($stufee['refund_fees']){?>
    <td><input type="text" name="i1" readonly value="<?php echo $fee['instalment1'];?>"></td>
    <?php } else{?>
	<td><input type="text" readonly name="i1" value="<?php echo ($extrafees['extraFees']/2)+$stufee['instalment1'];?>"></td>
    <?php }?>
</tr>
<tr>
	<td>Instalment Second</td>
	<?php if($stufee['refund_fees']){?>
    <td><input type="text" readonly name="i2" value="<?php echo $fee['instalment2'];?>"></td>
    <?php } else{?>
	<td><input type="text" readonly name="i2" value="<?php echo ($extrafees['extraFees']/2)+$stufee['instalment2'];?>"></td>
    <?php }?>
</tr>
<?php if($stufee['refund_fees']){?>
<tr>
	<td>
    	Fees Refunded
    </td>
    <td>
    	<?php echo $stufee['refund_fees'];?> Fees Refunded</td>
    </td>
</tr>
<?php }?>
<tr>
	<td>Fees Submited</td>
    <?php
		$rs=mysqli_query($con,"select sid,fees from studentfees where sid=$id");
		if($row=mysqli_num_rows($rs)){
			if($row==1){
				$feesub=mysqli_fetch_assoc($rs);
				$totfee=$stufee['totfee']+($extrafees['extraFees']);
				$submited=$feesub['fees'];
				$refund=$stufee['refund_fees'];
				$remfee=$totfee-$submited+$refund;
				if($remfee){?>
					<td><input type="text" name="fees" value="<?php echo $remfee;?>"></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="center"><input type="submit"  value="submit"></td>
                    </tr>
                    <?php	
				}
				else{
					?>
                    	<td><span style="color:#090">Your all Fees has been submited</span></td>
                    <?php
				}
				?>
                    <?php
				}
				else{ while($feesub=mysqli_fetch_assoc($rs)){ $submited+=$feesub['fees'];  } if($submited==$stufee['totfee']){?>
					<td><span style="color:#090">Your all Fees has been submited</span></td>
			<?php } elseif($submited>$stufee['totfee']){?>
				<td><?php echo $submited-$stufee['totfee'];?> Fees Refund</td>
                <?php	
			}
			else{
					?>
                    	<td><input type="text" name="fees" value="<?php echo $stufee['totfee']-$submited;?>"></td></tr>
                        <tr><td colspan="2"><input type="submit" value="Submit Fees"></td></tr>
                    <?php
				} }
		}
		else{?>
			<td><input type="text" name="fees" value="<?php echo ($extrafees['extraFees']/2)+$stufee['instalment1'];?>"></td></tr><tr>
            <td colspan="2" align="center"><input type="submit"  value="submit"></td></tr>
            <?php	
		}
	?>
</tr>
</table>
</form>
