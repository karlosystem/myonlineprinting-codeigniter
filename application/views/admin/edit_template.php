<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.flash.js"></script>
<?php 
	 $template_id=$this->uri->segment(4);
	 $instance_id=$this->uri->segment(5);
	require('Pest/PestJSON.php');
	$apiClient = new PestJSON( 'http://api.templatecloud.com/sandbox');
	$apiClient->setupAuth( 'vermamanoj343@gmail.com', 'admin123' );
	$tcapi_key='d5f111e77c683150cb80860e197a66d0';
		try {
			
			$result = $apiClient->get('/templates/'.$template_id.'/edit?user_key='.$tcapi_key.'&format=json');
			
			}
		catch (Exception $e)
			{
			die( $e->getMessage() );
			}
	
	echo '<pre>';
	echo "<br/>";
	$instance = ("bf6b7bb900dcb665497362cbce0a9e90".$instance_id);
	  
	
	echo "<br/>";
	$asset_key=sha1($instance);
	
	//die;
	echo '</pre>';
	
	
	?>

<script type="text/javascript">
			$(document).ready(function () {
			$('#example').flash({
			src: 'http://dev.templatecloud.com/templates_frontend/PDCRobot.swf?1325859802',
			id: 'PDCRobot',
			width: 900,
			height: 800,
			quality: 'high',
			bgcolor: '#0000ff',
			allowscriptaccess: 'always',
			allownetworking: 'all',
			allowfullscreen: 'true',
			wmode: 'transparent',
			base: 'templates_frontend',
			flashvars: {
			autoParams: 'friendlynames=true', 
			baseURL: 'http://dev.templatecloud.com/api/',
			       templateid: '10014',
            instanceid: '<?php echo $instance_id; ?>',
            customerid: 'ZTMANO22',
            locale: 'en_GB',
			bleed: '1.5000',
			Lock_objects: false,
      extraParam: '&asset_key=<?php echo $asset_key; ?>',
	
			
						}
    }, {
        version: 8
    });
});
</script>

<div id="example" align="center" style="width:100%"></div>
</div>
