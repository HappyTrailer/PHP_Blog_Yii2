<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    <?= Html::a('Create', ['create-post'], ['class' => 'btn btn-success']);?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        'content',
        [
            'attribute' => 'created_at',
            'label' => 'Time Created',
            'value' => function ($model) {
                $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                $date_sec = $model->created_at;
                $month = $months[(int)date('m', $date_sec) - 1];
                $day = date('d', $date_sec);
                $year = date('Y', $date_sec);
                $time = new DateTime("@$date_sec");
                $time->setTimezone(new DateTimeZone('Europe/Kiev'));
                return $month . " " . $day . ", " . $year . " - " . $time->format('H:i');
            }
        ],
        [
            'attribute' => 'updated_at',
            'label' => 'Time Updated',
            'value' => function ($model) {
                    $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    $date_sec = $model->updated_at;
                    $month = $months[(int)date('m', $date_sec) - 1];
                    $day = date('d', $date_sec);
                    $year = date('Y', $date_sec);
                    $time = new DateTime("@$date_sec");
                    $time->setTimezone(new DateTimeZone('Europe/Kiev'));
                    return $month . " " . $day . ", " . $year . " - " . $time->format('H:i');
            }
        ],
        [
            'attribute' => 'image',
            'format' => 'html',
            'value' => function ($model) {
                return Html::img($model->img_src,
                    ['width' => '70px']);
            },
        ],
        [
            'attribute' => 'category_id',
            'label' => 'Category',
            'value' => 'categories.name'
        ],
        [
            'attribute' => 'user_id',
            'label' => 'User',
            'value' => 'users.name'
        ],
        ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function($url, $model) {
                    return Html::a("<span class='glyphicon glyphicon-eye-open'></span>", ['view-post', 'id' => $model->id]);
                },
                'update' => function($url, $model){
                    return Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['edit-post', 'id' => $model->id]);
                },
                'delete' => function($url, $model){
                    return Html::a("<span class='glyphicon glyphicon-trash'></span>", ['del-post', 'id' => $model->id], ['data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?')]);
                }
            ]
        ]
    ]
]); ?>
