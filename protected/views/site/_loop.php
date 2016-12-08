<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ba-bbq.js"></script>
<?php $this->widget('zii.widgets.CListView', array(
	'id'=> 'thisMessage',
	'dataProvider'=>$dataProvider,
	'itemView' => '_view',
	'summaryText' => '',
	'pager' => array(
		'header' => '',
		'nextPageCssClass' => 'next',
		'previousPageCssClass' => 'previous',
		'selectedPageCssClass' => 'active',
		'hiddenPageCssClass' => 'disabled',
		'htmlOptions'=>array('class'=>'pagination'),
		'maxButtonCount' => 5,
		'firstPageLabel'=> 'Первая',
		'prevPageLabel' => '<<',
		'nextPageLabel' => '>>',
		'lastPageLabel' => 'Последняя',
		
	),
)); ?>
