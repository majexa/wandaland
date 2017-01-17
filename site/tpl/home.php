<!DOCTYPE html>
<html>
<head>
  <title><?= $d['pageHeadTitle'] ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="/i/css/common/screen.css" media="screen, projection"/>
  <link rel="stylesheet" type="text/css" href="/i/css/common/layout.css" media="screen, projection"/>
  <link rel="stylesheet" type="text/css" href="/m/home.css" media="screen, projection"/>
  {sflm}
</head>
<body>
<div class="hHeader">
  <div class="container">
    <div class="largeTitle"><img src="/m/img/large-logo.png"></div>
    <? if (Auth::get('id')) ?>
    <div class="authCont"><a href="" class="auth pseudoLink">Войти</a></div>
    <script>
      Ngn.Btn.addAction('.auth', function() {
        new Ngn.Dialog.Auth();
      });
    </script>
    <div class="homeBtns">
      <a href="/client" class="client">
        <span>
          <h2>Клиент</h2>
          <p><b>Хочу тату</b></p>
          <p>добавить эскиз</p>
        </span>
      </a>
      <a href="/master" class="master">
        <span>
          <h2>Мастер</h2>
          <p><b>Делаю тату</b></p>
          <p>посмотреть текущие заказы</p>
        </span>
      </a>
      <a href="/masters" class="masters">
        <span>
          <h2>Мастера</h2>
          <p><b>Работы</b></p>
        </span>
      </a>
      <div class="clear"></div>
    </div>

    <div style="margin-bottom:25px">
      <h2><a href="#" class="pseudoLink" id="aboutLink">О сервисе</a></h2>
    </div>
    <script>
      document.getElement('#aboutLink').addEvent('click', function() {
        var el = document.getElement('#about');
        el.setStyle('display',  el.getStyle('display') == 'inline-block' ? 'none' : 'inline-block');
      });
    </script>
    <div class="cont" id="about" style="width: 500px; display: none">
      <? $this->tpl('about') ?>
    </div>
    <div style="height: 30px"></div>
  </div>
</div>
<div class="footer">
  <div class="container" style="width: 400px">
    <?= Config::getVarVar('layoutTexts', 'footer') ?>
    <? $this->tpl('counters', null, true) ?>
  </div>
</div>
</body>
</html>