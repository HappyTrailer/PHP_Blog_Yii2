<? use yii\helpers\ArrayHelper; ?>
<style>
    hr.type_3 {
        border: 0;
        height: 25px;
        background-image: url(../../img/type_3.png);
        background-repeat: round;
        clear: both;
    }
</style>
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="#" style="text-decoration: none;">
                        <h2 class="post-title" style="font-weight: bold;">
                            <?= $post->title ?>
                        </h2>
                        <h4 style="font-weight: bold;">
                            <?= $post->categories->name ?>
                        </h4>
                        <h3 class="post-subtitle" style="font-weight: bold;">
                            <?= $post->content ?>
                        </h3>
                    </a>
                    <img class="img-responsive" src="../../<?= $post->img_src ?>" alt="">
                    <p class="post-meta" style="float: right; margin: 10px; font-weight: bold;">Posted by <a href="#"><?= $post->users->name ?></a> on <?= $post->getDateStr() ?></p>
                </div>
                <hr class="type_3">
            </div>
        </div>
    </div>
    <hr>
</article>