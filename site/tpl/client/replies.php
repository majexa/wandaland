<style>
  .ddItems .avatar {
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin-right: 15px;
    border: 1px solid #ccc;
    float: left;
    display: block;
  }
  .ddItems .text {
    float: left;
    width: 500px;
  }
</style>
<? if ($d['items']) { ?>
  <div class="ddItems list">
  <? foreach ($d['items'] as $v) { ?>
    <div class="item">
      <? if (!file_exists(UPLOAD_PATH.'/user/sm_'.$v['userId'].'.png')) { ?>
        <img src="/m/img/empty.png" class="avatar">
      <? } else { ?>
        <img src="/u/user/sm_<?= $v['userId'] ?>.png" class="avatar">
      <? } ?>
      <div class="text">
        <p>Мастер <b><?= $v['userName'] ?></b></p>
        <p><b><?= $v['price'] ?></b> <span class="currency">Ᵽ</span> <small>(приблизительная стоимость работы)</small></p>
        <p><i><?= $v['comment'] ?></i></p>
        <p><a href="/works/<?= $v['userId'] ?>" target="_blank">Портфолио мастера</a></p>
      </div>
      <div class="clear"></div>
      <div class="line"></div>
    </div>
  <? } ?>
  </div>
<? } else { ?>
  <div class="noItems">нет откликов</div>
<? } ?>