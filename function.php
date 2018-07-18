<?php
	$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
	
	function addEdit($table,$data,$id=""){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="insert into $table set ";
		$wh="";
		if($id){
			$qry="update $table set ";
			$wh="where id=$id";	
		}	
		foreach($data as $key=>$value){
			$qry.="$key='$value' ,";
		}
		$qry=substr($qry,0,-1).$wh;
		//echo $qry; exit;		
		mysqli_query($con,$qry);

		

	}
	function getlastRrcord()
	{
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		 $data=mysqli_fetch_assoc(mysqli_query($con,"select scholarcode from student1 order by id desc limit 1"));
		 return ($data['scholarcode']);
		//$qry="select $col from $table";
		//$data=mysqli_fetch_assoc(mysqli_query($con,$qry));
		//return ($data[$col]);
	}
	function deleteData($table,$id){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from $table where id=$id";
		mysqli_query($con,$qry);
	}
	function getcolumn($table,$col,$id="")
	{
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="select $col from $table where id=$id";
		$data=mysqli_fetch_assoc(mysqli_query($con,$qry));
		return ($data[$col]);
	}
function PaginationWork($pno='')
{
   global $frmdata ;
   global $frmdataget;
    $recordPerPage=10;
   if($pno)
     $recordPerPage=$pno;
   
   $frmdata['to']=$recordPerPage;
   if($frmdataget['pageNumber']<=1)
   {
	   $frmdataget['pageNumber']=1;
       $frmdata['from']=0;
     }
   else
        $frmdata['from']= $recordPerPage * ( ( (int) $frmdataget['pageNumber']) - 1);
  
}
function PaginationDisplay(&$totalCount,$starturl,$endurl,$pno='')
{
        global $frmdata;
        global $frmdataget;
		$recordPerPage=10;
		if($pno)
		 $recordPerPage=$pno;
        
		if($totalCount > $recordPerPage)
        {
            echo '<span id="pg">';
            $pre=$frmdataget['pageNumber']-1;
            if($frmdata['from'] >0)
            {
                echo '<a href="'.$starturl.$pre.$endurl.'" >&lt;Prev</a>';
            }
            $i=1;
            $j=$frmdataget['pageNumber'];
            if($j>=10)
            $i=$j-4;
            if($totalCount > 2* $recordPerPage)
            {
                for(;$i<=5+$frmdataget['pageNumber'] &&($totalCount >($i-1)*$recordPerPage) ;$i++)
                {
                    if($i==$frmdataget['pageNumber'])
                    {
                        echo '<a id="pg-selected">';
                        echo ($i);
                        echo '</a>';
                    }
                    else
                    {
                        echo '<a href="'.$starturl.$i.$endurl.'">';
                        echo ($i);
                        echo '</a>';
                    }
                }
            }
            $frmdataget['pageNumber']=$j;
            $next=$frmdataget['pageNumber']+1;
            if($totalCount > ($frmdata['from'] + $frmdata['to']))
            {
                echo '<a href="'.$starturl.$next.$endurl.'" >&gt;Next</a>';
            }
            echo '</span>';
      }
}

?>