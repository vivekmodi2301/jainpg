<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jain Girls PG College</title>
<script src="js/jquery.js"></script>
<link rel="stylesheet" href="css/<?php echo $theam;?>_style.css"/>
</head>

<body>
	<div id="<?php echo $theam;?>_wrapper">
    <div id="header-title">Jain Girls PG College</div>
    	<header>
        	
            <nav>
            	<ul>
                <?php
				if(isset($_SESSION['login_details']))
				{
				?>
                <li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='home'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=home&do=search">Search</a></li>
                                 <li class="dropdown">
                    	<a href="#" class="bropdownlink">Students</a>
                        <ul class="dropdown-menu">
                        <li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='group'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=register&do=slist">All Student
</a></li>
                        <?php
							$ars=mysqli_query($con,"select id,coursename from courses");
							while($course=mysqli_fetch_assoc($ars)){
		
						?>
								<li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='group'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=register&do=slist&cid=<?php echo $course['id'];?>"><?php echo $course['coursename'];?></a></li>
<?php }?>



                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='boysfunds'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=register&do=studentUpdateClass">Move to next class</a></li>
                   </ul>
   
                	<li class="dropdown">
                    	<a href="#" class="bropdownlink">All Funds</a>
                        <ul class="dropdown-menu">
                    		<li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='bfund'){ echo $theam.'_menu_active';}?>">
                    <a href="index.php?mod=bfund&do=bfundlist">Boys fund</a></li>                    <li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='cfund'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=cfund&do=cfundlist">College fund</a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='cfundlist'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=funds&do=cfundlist">Total C Fund</a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='bfundlist'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=funds&do=bfundlist">Total B Fund</a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='collegefunds'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=funds&do=newcollegefundslist">College Class Fund</a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='boysfunds'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=funds&do=boysfunds">College Boys Funds</a></li>    	
                        </ul>
                    </li>
                    <li class="dropdown">
                    	<a href="#" class="bropdownlink">Generate Excel Files</a>
                        <ul class="dropdown-menu">
                    		<li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='bfund'){ echo $theam.'_menu_active';}?>">
                    <a href="index.php?mod=register&do=excellist">Students Excel Files</a></li>                    
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='bfundlist'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=funds&do=cfunddtexe">College fund Detail Download </a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='collegefunds'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=funds&do=bfunddtexe">Boys fund Detail Download</a></li>
<li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='collegefunds'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=fees&do=refundexelist">Refund Excel File Download</a></li>                    
                       	
                        </ul>
                    </li>
                    <li class="dropdown">
                    	<a href="#" class="bropdownlink">Fees</a>
                        <ul class="dropdown-menu">
                    		<li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='fees'){ echo $theam.'_menu_active';}?>">
                    <a href="index.php?mod=fees&do=feeslist">Fees</a>
                    </li>
                     <li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='cfund'){ echo $theam.'_menu_active';}?>">
                    <a href="index.php?mod=fees&do=feesrefundlist">Fees Refund</a>
                    </li>
                   </ul>
                   </li>
                   
                   
                   
                   <li class="dropdown">
                    	<a href="#" class="bropdownlink">Courses</a>
                        <ul class="dropdown-menu">
                    		<li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='clist'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=course&do=clist">Course</a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='sclist'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=course&do=sclist">Sub Course</a></li>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['do']=='compulsoryadd'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=course&do=complist">Compulsory subject</a></li>
                   </ul>
                   </li>
                   
                   
                   
                   
                  </li>
                   
                   
                    <li id="<?php if(isset($_GET['mod']) && $_GET['mod']=='group'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=group&do=list">Group</a></li>
                    
                	<li  id="<?php if(isset($_GET['mod']) && $_GET['mod']=='subject'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=subject&do=list">Subject</a></li>
                	
                    <li><a href="index.php?mod=login&do=logout">Logout</a></li>
                    <?php
				}
				else
				{?>
                    <li  id="<?php if(isset($_GET['mod']) && $_GET['mod']=='login'){ echo $theam.'_menu_active';}?>"><a href="index.php?mod=login&do=login">Login</a></li>				
				<?php
				}
					?>
                	
                </ul>	
            </nav>
        </header>
        <section>
       
	   <?php 
	   $contattype="full_";
	   if(0){
		   $contattype="";
		   ?>
        <aside>
        		<!--
                <div class="axixa_panel">
                	<h3>News Part</h3>
                    <div>
                    	contant
                    </div>	
                </div>
                -->
        		<div class="axixa_panel">
                	<h3>Other menu</h3>
                    <ul>
                    	<li><a href="#">My Account</a></li>
                        <li><a href="#">Image</a></li>
                        <li><a href="#">Quiz</a></li>
                    	<li><a href="#">Logout</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">My Account</a></li>
                    	<li><a href="#">My Account</a></li>
                        <li><a href="#">Image</a></li>
                        <li><a href="#">Quiz</a></li>
                    	<li><a href="#">Logout</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">My Account</a></li>
                        
                    </ul>	
                </div>
                <!--
        		<div class="axixa_panel">
                	<h3>News Part</h3>
                    <div>
                    	contant
                    </div>	
                </div>
            	-->
        </aside>
        <?php } ?>
        <div id="<?php echo $theam.'_'.$contattype;?>contant">