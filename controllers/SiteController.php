<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Posts;
use app\models\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionIndex3()
    {
        return $this->render('index');
    }

    public function actionIndex2()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function sdfsd()
    {}
	public function BBBBBB()
    {}
    
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
	public function assddfsa()
	{}
	public function actionContact3()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionContact2()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPosts()
    {
        $dataProvider = new ActiveDataProvider(
            [
                'query' => Posts::find()->with('categories')->with('users')
            ]
        );
        $dataProvider->pagination->pageSize=2;
        return $this->render('posts', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewPost($id)
    {
        $post = Posts::findOne($id);
        return $this->render('viewpost', [
            'post' => $post
        ]);
    }

    public function actionEditPost($id)
    {
        $post = Posts::findOne($id);
        if($post->load(Yii::$app->request->post()) && $post->validate())
        {
            $post->save();
            return $this->redirect(Yii::$app->user->getReturnUrl());
        }
        else
        {
            $returnUrl = Yii::$app->request->referrer;
            Yii::$app->user->setReturnUrl($returnUrl);
        }
        return $this->render('editpost', [
            'post' => $post
        ]);
    }

    public function actionDelPost($id)
    {
        Posts::findOne($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCreatePost()
    {
        $post = new Posts();
        if($post->load(Yii::$app->request->post()) && $post->validate())
        {
            $post->save();
            return $this->redirect(Yii::$app->user->getReturnUrl());
        }
        else
        {
            $returnUrl = Yii::$app->request->referrer;
            Yii::$app->user->setReturnUrl($returnUrl);
        }
        return $this->render('editpost', [
            'post' => $post
        ]);
    }

    public function actionBlog()
    {
        $posts = Posts::find()->with('categories')->with('users')->orderBy(["updated_at" => SORT_DESC])->all();
        return $this->render('blog', [
            'posts' => $posts
        ]);
    }
}
