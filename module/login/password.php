<?php
$error="";
	//print_r($_SESSION['login_check']);
	$username=$_SESSION['login_check']['username'];
	
if(isset($_POST['password']))
{
	$pass=$_POST['password'];
	$rs=mysqli_query($con,"select id,password from login where username='$username' and password='$pass'");
//	echo "select id,password from login where username='$username' and password='$pass'";
//	exit;
	if(mysqli_num_rows($rs)){
		$_SESSION['login_details']=mysqli_fetch_assoc($rs);
	
		?>
        <script>location.href='index.php?mod=home&do=search';</script>
        <?php
		
	}
	{
		$error="Please Enter valid password";
		}
}?>

        <form method="post">
  
<table class="axixa_form" >
      <tr>
    	<th colspan="2" >Login</th>
        </tr>
             <?php if($error){?>

     <tr>
    	<th colspan="2" style="color:#f00"><?php echo $error;?></th>
     </tr>
     <?php }?>
     <tr>
     	<td>Password</td>
        <td><input type="password" required placeholder="User password" name="password" autofocus="autofocus"/>
        </td>
     </tr>   
     <tr>
     	<td colspan="2"><input type="submit" value="Login"/></td>
        
     </tr>   
     
</table>
</form>