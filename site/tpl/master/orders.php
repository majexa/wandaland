<div class="ddItems list">
  <? foreach ($d['items'] as $v) { ?>
  <div class="item">
    <div style="float:left">
    <a href="<?= $v['outlineImage'] ?>" class="thumb" target="_blank">
      <div class="thumbHover"></div>
      <img src="<?= $v['sm_outlineImage'] ?>">
    </a>
    </div>
    <div style="float:right" class="gray">ID: <?= $v['id'] ?></div>
    <div style="float:left;margin-left:20px;">
      <p><?= $v['size'] ?>см<sup>2</sup>, <?= $v['bodyPart'] ?></p>
      <p>Добавлено:<br><?= Date::datetimeStr($v['dateCreate_tStamp']) ?></p>
      <? if (!$v['replyId']) { ?>
        <p><a href="/master/reply/<?= $v['id'] ?>" class="btn"><span><i></i>Откликнуться</span></a></p>
      <? } else { ?>
        <p>Вы уже откликнулись на этот заказ. <a href="/master/showReply/<?= $v['replyId'] ?>">Посмотреть отклик</a></p>
      <? } ?>
    </div>
    <div class="clear"></div>
    <div class="line"></div>
  </div>
  <? } ?>
</div>