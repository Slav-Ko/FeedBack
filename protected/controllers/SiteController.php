<?php

class SiteController extends Controller
{
	public $odd;

	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	

	public function actionMessage()
	{
		$message = new Message;
		$answer='';
		$adminMail=Yii::app()->params['adminEmail'];
		$name=Yii::app()->request->getPost('name');
		$email=Yii::app()->request->getPost('email');
		$body=Yii::app()->request->getPost('body');
		if (isset($_POST['name'])){
			$message->attributes=array(
				'name'=>$name,
				'email'=>$email,
				'body'=>$body
			);
			$message->verifyCode= Yii::app()->request->getPost('verifyCode');
			if ($message->validate())
				if ($message->save()){
					Mails::send($adminMail,$name.' '.$email,$body); 
					$answer='Сообщение зарегистрировано';
				}else
					$answer='Приходите завтра';
			else
				$answer=0;
		}
		echo json_encode(array('answer'=>$answer));
		Yii::app()->end();
	}

	public function actionMessageNoCaptcha()
	{
		$message = new Message;
		$answer='';
		$name=Yii::app()->request->getPost('name');
		$email=Yii::app()->request->getPost('email');
		$body=Yii::app()->request->getPost('body');
		if (isset($_POST['name'])){
			$message->name=$name;
			$message->email=$email;
			$message->body=$body;
			$vc_key="Yii.CCaptchaAction.".Yii::app()->getId().".site.captcha";
			$message->verifyCode=Yii::app()->session->get($vc_key);
			//$vc_key="Yii.CCaptchaAction.".Yii::app()->getId().".site.captcha";
			//Yii::app()->session->put($vc_key,22);
			//$message->verifyCode=22;
			if ($message->validate())
				if ($message->save()){
					$error=0;
					$answer='Сообщение зарегистрировано № '.$message->id;
				}else{
					$error=1;
					$answer='Ошибка';
				}
			else{
				$error=2;
				$answer='Ошибка';
			}
		}
		echo json_encode(array(
			'error'=>$error,
			'answer'=>$answer,
		));
		Yii::app()->end();
	}

	public function actionIndex()
	{
		$model = new Message;
	        $dataProvider = new CActiveDataProvider('Message', array(
			'pagination' => array(
				'pageSize' => 10,
			),
	        ));
		if (Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_loop', array(
				'dataProvider'=>$dataProvider,
			));
			Yii::app()->end();
		} else {
			$this->render('index', array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
			));
		}
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}