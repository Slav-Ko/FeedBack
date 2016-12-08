<?php
$this->pageTitle=Yii::app()->name;
?>
<style>
.honey1{
	background:#2d3136;
	margin-bottom:20px;
	text-align:center;
}
.honey2{
	background:white;
	margin-bottom:20px;
}
#logo{
	margin-left:100px;
	width:150px;
}
#letter{
	margin:0 auto;
	width:100px;
}
.row-fluid{
	width:80%;
	margin:0 auto;
}
.row-fluid input,.row-fluid textarea,#name,#email,
input:-webkit-autofill,
textarea:-webkit-autofill,
select:-webkit-autofill{
	color:white !important;
	background:#2d3136 !important;
	border:1px solid #4c4f53;
}
.row-fluid textarea{
	height:100px;
}
.short-div {
	height:70px;
	width:100%;
}
.list-view .pager {
	text-align:center;
	clear:both;
}
</style>

<div class="content-section-a honey1">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png">
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<img id="letter" src="<?php echo Yii::app()->request->baseUrl; ?>/img/letter.png">
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="short-div>
							<label for="name" class="control-label" style="color:white;">Имя<span style="color:#be393b;margin:10px">*</span></label>
							<input type="text" id="name" class="form-control input-lg">
						</div>
						<div class="short-div">
							<label for="email" class="control-label" style="color:white;">E-Mail<span style="color:#be393b;margin:10px">*</span></label>
							<input type="text" id="email" class="form-control input-lg">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<label for="comment" class="control-label" style="color:white;">Комментарий<span style="color:#be393b;margin:10px">*</span></label>
						<textarea id="comment" class="form-control input-lg"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<div class="container">
		<div class="row">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
						<button type="submit" id="submit" class="btn" style="color:white;background:#be393b;">Записать</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content-section-a honey2">
	<div class="container">
		<div class="row">
			<div class="container-fluid">
				<div class="row-fluid">
				<div style="width:100%;text-align:center;">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ajax-loader.gif" id="ajax" style="display:none"/>
					<div id="error"></div>
				</div>
				<?php $this->renderPartial('_loop', array('dataProvider'=>$dataProvider)); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
function isValidEmail(email,strict){
	if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
	return !(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}
jQuery(document).ready(function(){
	$('#submit').click(function(){
		var good=true;
		var error='';
		if ($('#name').val()==''){
			good=false;
			$('#name').css({'border-color':'red','border-width':'4px'});
			error=error+'имя; ';
		}else
			$('#name').css({'border-color':'green','border-width':'4px'});
		if ($('#email').val()=='' || isValidEmail($('#email').val(),true)){
			good=false;
			$('#email').css({'border-color':'red','border-width':'4px'});
			error=error+'почта; ';
		}else
			$('#email').css({'border-color':'green','border-width':'4px'});
		if ($('#comment').val()==''){
			good=false;
			$('#comment').css({'border-color':'red','border-width':'4px'});
			error=error+'комментарий; ';
		}else
			$('#comment').css({'border-color':'green','border-width':'4px'});
		if(good){
			$('#ajax').show();
			$('#yw1_button').click();
			$.ajax({
				url: '<?php echo Yii::app()->request->baseUrl; ?>/site/messagenocaptcha',
				type: "POST",
				dataType:"json",
				data:{
					'name':$('#name').val(),
					'email':$('#email').val(),
					'body':$('#comment').val(),
				},
				success: function(data) {
					$('#ajax').hide();
					if (data.error==0){
						$.fn.yiiListView.update('thisMessage',{ajaxUpdate:'thisMessage'});
						$('#error').css({'color':'green'}).html(data.answer);
					}else{
						$('#error').css({'color':'red'}).html(data.answer);
					}
					$('#name').val('');
					$('#email').val('');
					$('#comment').val('');
				}
			});
		}else{
			$('#error').css({'color':'red'}).html('ошибка: '+error);
		}
	});
});
</script>

<div class="content-section-a honey1">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png">
			</div>
		</div>
	</div>
</div>

<div style="width:100%;text-align:center">
	<a  href="#feedback" data-toggle="modal" class="btn btn-success">Форма обратной связи</a>
</div>

<div id="feedback" class="modal fade" style="display:none">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float:right;padding-bottom:15px">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/close.png" alt="Закрыть"/>
				</button>
			</div>
			<div id="feedback_body" class="modal-body" style="text-align:center">
				<?php $form = $this->beginWidget('CActiveForm', array(
					'id'=>'message-form',
					'enableAjaxValidation'=>false,
				)); ?>
				<?php echo $form->errorSummary($model); ?>

			<div style="width:20%;float:left">
				<?php echo $form->label($model, 'name')?>
			</div>
			<div style="width:60%;float:left">
				<?php echo $form->textField($model,'name',array('size'=>50,'placeholder'=>'Введите Имя')); ?>
				<?php echo $form->error($model, 'name'); ?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:20%;float:left">
				<?php echo $form->label($model, 'email')?>
			</div>
			<div style="width:60%;float:left">
				<?php echo $form->textField($model,'email',array('size'=>50,'placeholder'=>'Введите Почту')); ?>
				<?php echo $form->error($model, 'email'); ?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:20%;float:left">
				<?php echo $form->labelEx($model, 'body'); ?>
			</div>
			<div style="width:60%;float:left">
				<?php echo $form->textArea($model, 'body', array('style' => 'height:60px;width:413px;')); ?>
				<?php echo $form->error($model, 'body'); ?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:80%;float:left">
				<?php $this->widget('CCaptcha')?>
			</div>
			<div style="clear:both;height:20px"></div>

			<div style="width:20%;float:left">
				<?php echo $form->labelEx($model, 'verifyCode'); ?>
			</div>
			<div style="width:60%;float:left">
				<input id="Message_verifyCode" type="text" value="" style="width:413px;">
			</div>
			<div style="clear:both;height:20px"></div>

				<?php $this->endWidget(); ?>
			</div>
			<div class="modal-footer" style="text-align:center">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ajax-loader.gif" id="ajax-loader" style="display:none"/>
				<button id="send" type="button" class="btn btn-success">
					Отправить вопрос
				</button>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function(){
	$('#send').click(function(){
		var good=true;
		if ($('#Message_name').val()==''){
			good=false;
			$('#Message_name').css({'border-color':'red'});
		}else
			$('#Message_name').css({'border-color':'green'});
		if ($('#Message_email').val()=='' || isValidEmail($('#Message_email').val(),true)){
			good=false;
			$('#Message_email').css({'border-color':'red'});
		}else
			$('#Message_email').css({'border-color':'green'});
		if ($('#Message_body').val()==''){
			good=false;
			$('#Message_body').css({'border-color':'red','border-width':'2px'});
		}else
			$('#Message_body').css({'border-color':'green'});
		if ($('#Message_verifyCode').val()==''){
			good=false;
			$('#Message_verifyCode').css({'border-color':'red','border-width':'2px'});
		}else
			$('#Message_verifyCode').css({'border-color':'green'});
		if(good){
			$('#ajax-loader').show();
			$.ajax({
				url: '<?php echo Yii::app()->request->baseUrl; ?>/site/message',
				type: "POST",
				dataType:"json",
				data:{
					'name':$('#Message_name').val(),
					'email':$('#Message_email').val(),
					'body':$('#Message_body').val(),
					'verifyCode':$('#Message_verifyCode').val()
				},
				success: function(data) {
					if (data.answer==0){
						alert('Капча не сработала, введите снова');
						$('#Message_verifyCode').val('');
					}else{
						$.fn.yiiListView.update('thisMessage',{ajaxUpdate:'thisMessage'});
						$('#send').hide();
						$('#feedback_body').html(data.answer);
					}
					$('#ajax-loader').hide();
				}
			});
		}
	});
});
</script>
