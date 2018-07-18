Data is submiting....

<?php
	if(isset($_POST['fees'])){
		$i1=$_POST['i1'];
		$i2=$_POST['i2'];
		$tf=$_POST['tf'];	
		$bfund=$_POST['boysfund'];
		$cfund=$_POST['collegefund'];
		//print_r($_POST);exit;
		unset($_POST['i1'],$_POST['i2'],$_POST['tf'],$_POST['collegefund'],$_POST['boysfund']);	
//		print_r($_POST['extraFees']);
//		print_r($_POST['boysfund']);exit;
		$extValue=0;
		
		
		
		$feesubmit=$_POST['fees'];
		$_POST['sid']=$_GET['id'];
		$sid=$_POST['sid'];
		//echo $sid;
		//$sid=$_POST['sid'];
		//echo "select id,sid from boysfunddte where sid=$sid"; exit;		
		$tot=0;
		$_POST['tution_fees']=$_POST['fees'];
			$bfrs=mysqli_query($con,"select id,sid from boysfunddte where sid=$sid limit 1");
			if(mysqli_num_rows($bfrs)<1){
				$bcount=count($bfund);
				$tot=0;
				$bf=array();
				$bfdtlrs=mysqli_query($con,"select id,fund,dived ,fees,year from boysfund ");
				while($bfdtldata=mysqli_fetch_assoc($bfdtlrs)){
				//for($i=0;$i<$bcount;$i++){
					//print_r($bfund[$i]);exit;
					
					//print_r($dte);exit;
					$bf['sid']=$sid;
					$bf['funds']=$bfdtldata['fund'];
					//print_r($bfund);
					//echo $bfdtldata['id'];
					if(in_array($bfdtldata['id'],$bfund)){
					//echo "hello";
					if($_POST['fees']==$tf){
						$bf['fees']=$bfdtldata['fees'];
					}else{
						$bf['fees']=$bfdtldata['fees']/$bfdtldata['dived'];
					}
					}else{
						$bf['fees']=0;
						}
					//echo $bf['fees'];exit;	
					$bf['year']=$bfdtldata['year'];
					$bf['cid']=$_POST['cid'];
					$bf['scid']=$_POST['scid'];
					$bf['dt']=$_POST['dte'];
					$tot+=$bf['fees'];
					//print_r($bf);
					
					//echo "<br>";
					addEdit('boysfunddte',$bf);
				}
				
				//exit;
				$ccount=count($cfund);
				$cf=array();
					$crs=mysqli_query($con,"select id,dived,fees,year from collegefund");
					//echo "select id,dived,fees,year from collegefund";exit;
					while($cdte=mysqli_fetch_assoc($crs)){
					//print_r($dte);exit;
					$cf['sid']=$sid;
					$cf['funds']=$cdte['id'];		
					if(in_array($cdte['id'],$cfund)){	
					if($_POST['fees']==$tf){
						$cf['fees']=$cdte['fees'];
					}else{
						$cf['fees']=$cdte['fees']/$cdte['dived'];
					}
					}
					else{
						$cf['fees']=0;	
					}
					$cf['year']=$cdte['year'];
					$cf['cid']=$_POST['cid'];
					$cf['scid']=$_POST['scid'];
					$cf['dt']=$_POST['dte'];		
					$tot+=$cf['fees'];
					addEdit('collegefunddte',$cf);
				}
        //echo "$_POST[fees]<=$tf && $_POST[fees]>$i1<br>";		
		if($_POST['fees']<=$tf && $_POST['fees']>$i1){
			//echo "hi";exit;
			foreach($_POST['extraFees'] as $key => $val)
			{
				$_POST['extra_Fees'][]=$key.'-'.$val;
				$extValue+=$val;
			}
			$_POST['extraFees']=implode(',',$_POST['extra_Fees']);
			
		}
		elseif($_POST['fees']==$i1)
		{
			
		//echo "$_POST[fees]==$i1<br>";
			//echo "hii";exit;
			foreach($_POST['extraFees'] as $key => $val)
			{
				$_POST['extra_Fees'][]=$key.'-'.$val/2;
				$extValue+=$val/2;
			}
			$_POST['extraFees']=implode(',',$_POST['extra_Fees']);
		}
		
		$_POST['tution_fees']=$feesubmit-$tot-$extValue;
		//echo $_POST['extraFees'];exit;
		
		unset($_POST['extra_Fees']);
		 addEdit('studentfees',$_POST);
		 //exit;
		?>
        <script>
	location.href="index.php?mod=fees&do=feeslist";
</script>  
<?php
				}

	else
		{
			//echo "hi";exit;
			$bcount=count($bfund);
				$tot=0;
				$bf=array();
				$bfdtlrs=mysqli_query($con,"select id,fund,dived ,fees,year from boysfund where dived='2'");
				while($bfdtldata=mysqli_fetch_assoc($bfdtlrs)){
				//for($i=0;$i<$bcount;$i++){
					//print_r($bfund[$i]);exit;
					
					//print_r($dte);exit;
					$bf['sid']=$sid;
					$bf['funds']=$bfdtldata['fund'];
					//print_r($bfund);
					//echo $bfdtldata['id'];
					if(in_array($bfdtldata['id'],$bfund)){
					//echo "hello";
					if($_POST['fees']==$tf){
						$bf['fees']=$bfdtldata['fees'];
					}else{
						$bf['fees']=$bfdtldata['fees']/$bfdtldata['dived'];
					}
					}else{
						$bf['fees']=0;
						}
					//echo $bf['fees'];exit;	
					$bf['year']=$bfdtldata['year'];
					$bf['cid']=$_POST['cid'];
					$bf['scid']=$_POST['scid'];
					$bf['dt']=$_POST['dte'];
					$tot+=$bfdtldata['fees'];
					//print_r($bf);
					
					//echo "<br>";
					addEdit('boysfunddte',$bf);
				}
				
				//exit;
				$ccount=count($cfund);
				$cf=array();
					$crs=mysqli_query($con,"select id,dived,fees,year from collegefund where dived='2'");
					//echo "select id,dived,fees,year from collegefund";exit;
					while($cdte=mysqli_fetch_assoc($crs)){
					//print_r($dte);exit;
					$cf['sid']=$sid;
					$cf['funds']=$cdte['id'];		
					if(in_array($cdte['id'],$cfund)){	
					if($_POST['fees']==$tf){
						$cf['fees']=$cdte['fees'];
					}else{
						$cf['fees']=$cdte['fees']/$cdte['dived'];
					}
					}
					else{
						$cf['fees']=0;	
					}
					$cf['year']=$cdte['year'];
					$cf['cid']=$_POST['cid'];
					$cf['scid']=$_POST['scid'];
					$cf['dt']=$_POST['dte'];		
					$tot+=$cdte['fees'];
					addEdit('collegefunddte',$cf);
				}
				
        //echo "$_POST[fees]<=$tf && $_POST[fees]<$i1";
		if($_POST['fees']<=$tf && $_POST['fees']<$i2 ){
			//echo "hi";exit;
			foreach($_POST['extraFees'] as $key => $val)
			{
				$_POST['extra_Fees'][]=$key.'-'.$val;
				$extValue+=$val;
			}
			$_POST['extraFees']=implode(',',$_POST['extra_Fees']);
			
		}
		
		elseif($_POST['fees']==$i2)
		{
			//echo "hi";exit;
			foreach($_POST['extraFees'] as $key => $val)
			{
				$_POST['extra_Fees'][]=$key.'-'.$val/2;
				$extValue+=$val/2;
			}
			$_POST['extraFees']=implode(',',$_POST['extra_Fees']);
		}
		$_POST['tution_fees']=$feesubmit-$tot-$extValue;
		//print_r($_POST['extraFees']);exit;
		unset($_POST['extra_Fees']);
		 addEdit('studentfees',$_POST);
		 //exit;
		?>
        <script>
	location.href="index.php?mod=fees&do=feeslist";
</script>  
<?php
		}
}
		
		
	
?>