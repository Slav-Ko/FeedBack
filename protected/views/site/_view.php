<?php
if ($this->odd==1){
	$this->odd=0;
	$header_color='#4b596c';
	$body_color='#e9eef3';
}else{
	$this->odd=1;
	$header_color='#58ad52';
	$body_color='#deebde';
}
?>
<div style="margin:10px;float:left;width:270px;height:270px;background:<?php echo $body_color; ?>">
	<div style="text-align:center;padding:10px;width:100%;color:white;background:<?php echo $header_color; ?>;">
		<?php echo $data->name; ?>
	</div>
	<div style="margin:10px;font-size:18px;text-align:center;width:100%;color:<?php echo $header_color; ?>;">
		<strong><?php echo $data->email; ?></strong>
	</div>
	<div style="padding:10px;text-align:center;">
		<?php echo $data->body; ?>
	</div>
</div>
