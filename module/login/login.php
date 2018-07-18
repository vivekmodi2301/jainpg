<?php
$error="";

if(isset($_POST['username']))
{
	extract($_POST);
	$rs=mysqli_query($con,"select id,username from login where username='$username'");
	if(mysqli_num_rows($rs)){
		$_SESSION['login_check']=mysqli_fetch_assoc($rs);
	
		?>
        <script>location.href='index.php?mod=login&do=password';</script>
        <?php
		
	}
	{
		$error="Please Enter valid username";
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
      
     	<td>User Name</td>
        <td><input type="text" required placeholder="User Name" name="username" autofocus="autofocus"/>
        </td>
     </tr>   
        
     <tr>
     	<td colspan="2"><input type="submit" value="Login"/></td>
        
     </tr>   
     
</table>
</form>