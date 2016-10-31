<?php
use app\models\Categories;
use app\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>

<?= $form->field($post, 'title'); ?>
<?= $form->field($post, 'content'); ?>
<? $listCategories = ArrayHelper::map(Categories::find()->all(), 'id', 'name'); ?>
<?= $form->field($post, 'category_id')->dropDownList($listCategories); ?>
<? $listUsers = ArrayHelper::map(Users::find()->all(), 'id', 'name'); ?>
<?= $form->field($post, 'user_id')->dropDownList($listUsers); ?>
<?= $form->field($post, 'created_at'); ?>
<?= $form->field($post, 'updated_at'); ?>
<?= $form->field($post, 'img_src'); ?>

<?= Html::submitButton('Submit',['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>