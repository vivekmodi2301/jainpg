<?php
if($_SERVER['HTTP_HOST']=='localhost')
{
	@define('ROOT',$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/jainpg/",true);
	@define('HOSTNAME','localhost',true);
	@define('USERNAME','root',true);
	@define('PASSWORD','',true);
		
}else{
		
		@define('ROOT',$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/",true);
			@define('HOSTNAME','localhost',true);
        	@define('USERNAME','root',true);
	        @define('PASSWORD','',true);


}
@define('DB','jainpg1',true);

@define('CSSPATH',ROOT.'/css/',true);
@define('IMAGEPATH',ROOT.'/img/',true);
@define('JSPATH',ROOT.'/js/',true);
@define('UPLOADPATH',ROOT.'/uploadedfiles/',true);
@define('MAND','<span style="color:#f00">*</span>',true);
@define('MANDMSG','<span style="color:#f00">\'*\' </span><span style="color:#00a;">filled are mandatory.</span>',true);
		  
		  
//print_r($_SERVER);

?>
