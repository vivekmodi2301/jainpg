<?php
	include_once("../../config.php");
	include_once("../../function.php");
	if(isset($_GET['student'])){
		$student=$_GET['student'];
		$studentdata=mysqli_fetch_assoc(mysqli_query($con,"select student1.name as student,subcourse.name as year, coursename as courses, fees, instalment1, instalment2 from student1 join subcourse on scid=subcourse.id join courses on student1.cid=courses.id where student1.id=$student"));
		echo $studentdata['fees'];
		
	}
	
	if(isset($_GET['stu'])){
		$student=$_GET['stu'];
		$studentdata=mysqli_fetch_assoc(mysqli_query($con,"select student1.name as student,subcourse.name as year, coursename as courses, fees, instalment1, instalment2 from student1 join subcourse on scid=subcourse.id join courses on student1.cid=courses.id where student1.id=$student"));
		echo $studentdata['instalment1'];
	}
?>