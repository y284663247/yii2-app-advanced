<?php

namespace api\modules\v1\controllers;

use api\controllers\RestController;
use common\models\LoginForm;
use common\models\SignupForm;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends RestController
{
    public $modelClass = 'app\modules\v1\services\User';

    /**
     * 重写create操作，进行用户注册或添加
     * @name: actions
     * @return array
     * @author: rickeryu <lhyfe1987@163.com>
     * @time: 17/11/21 下午4:57
     */
    public function actions() {
        $actions =  parent::actions(); // TODO: Change the autogenerated stub
        unset($actions['create'],$actions['update'],$actions['delete'],$actions['view']);
        return $actions;
    }

    /**
     * 用户登录操作
     * @name: actionLogin
     * @return array
     * @author: rickeryu <lhyfe1987@163.com>
     * @time: 17/11/21 下午4:18
     */
    public function actionLogin(){
        $model  = new LoginForm();
        $post = Yii::$app->getRequest()->getBodyParams();
        $model->load($post,'');
        if( $access_token = $model->login() ){
            return $access_token;
        }
        $this->error($model);
    }

    /**
     * 用户注册
     * @name: actionSignup
     * @return \app\models\User|null
     * @author: rickeryu <lhyfe1987@163.com>
     * @time: 17/11/21 下午5:05
     */
    public function actionSignup(){
        $model = new SignupForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(),'');
        if ($user = $model->signup()) {
            //创建用户成功，返回用户基本信息
            return $user;
        }
        $this->error($model);
    }

}
