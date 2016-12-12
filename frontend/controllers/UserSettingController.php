<?php

namespace frontend\controllers;

use Yii;
use common\components\MiscHelpers;
use common\models\User;
use frontend\models\UserSetting;
use frontend\models\UserSettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserSettingController implements the CRUD actions for UserSetting model.
 */
class UserSettingController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'actions' => ['index','update','timezone'],
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Default path - redirect to update
     * @return mixed
     */
    public function actionIndex()
    {
      // returns record id not user_id
      $id = UserSetting::initialize(Yii::$app->user->getId());
      return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Updates an existing UserSetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->getId();
        $u=User::findOne(Yii::$app->user->getId());
        // set default timezone if not initialized in earlier users
        if ($model->load(Yii::$app->request->post())) {
          $model->timezone =Yii::$app->request->post()['UserSetting']['timezone'];
          $model->has_updated_timezone = UserSetting::SETTING_ON;
          $model->save();
          Yii::$app->getSession()->setFlash('success', 'Your settings have been updated.');
        } else {
          if (empty($model->timezone)) {
              $model->timezone = 'America/Los_Angeles';
          }
        }
        $timezoneList=MiscHelpers::getTimezoneList();
        return $this->render('update', [
            'model' => $model,
            'user'=>$u,
            'timezoneList' => $timezoneList,
        ]);
    }

    /**
     * Deletes an existing UserSetting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionTimezone($timezone='') {
      // set current logged in user timezone than return
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $user_id = Yii::$app->user->getId();
      UserSetting::setUserTimezone($user_id,$timezone);
      return true;
    }

    /**
     * Finds the UserSetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserSetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserSetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
