<?php
// GRANT ALL PRIVILEGES ON TABLE side_adzone TO jerry;
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
/*
    if(!\Yii::$app->user->isGuest)  $menuItems[] = ['label' => 'Consult All', 'url' => ['/testy/consult']];
    if(Yii::$app->user->can('register-persons'))  $menuItems[] = ['label' => 'Register', 'url' => ['/testy/register']];
    if(Yii::$app->user->can('upload-files'))  $menuItems[] = ['label' => 'Upload', 'url' => ['/testy/upload']];
    if(Yii::$app->user->can('download-files'))  $menuItems[] = ['label' => 'Download', 'url' => ['/testy/download']]; 
    if(Yii::$app->user->can('create-users'))  $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    /*
    //if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id==2){
    //if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->role==2){
        $menuItems[] = ['label' => 'Register', 'url' => ['/testy/register']];
        $menuItems[] = ['label' => 'Consult All', 'url' => ['/testy/consult']];
        $menuItems[] = ['label' => 'Upload', 'url' => ['/testy/upload']];
        $menuItems[] = ['label' => 'Download', 'url' => ['/testy/download']];    
    //}
    //else if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id==1){
    //else if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->role==1){
        $menuItems[] = ['label' => 'Consult All', 'url' => ['/testy/consult']];     
    //}
    */
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
