<? if ($d['items']) { ?>
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
        <div style="float:left;margin-left:20px;width:170px;">
          <p><?= $v['size'] ?>см<sup>2</sup>, <?= $v['bodyPart'] ?></p>
          <p>Добавлено:<br><?= Date::datetimeStr($v['dateCreate_tStamp']) ?></p>
          <p>Окончание тендера:<br><?= Date::datetimeStr(strtotime('+1 day', $v['dateCreate_tStamp'])) ?></p>
          <p>
            <? if ($v['inProgress']) { ?>
              <? if ($v['repliesCount']) { ?>
                Откликов: <?= $v['repliesCount'] ?>
              <? } else { ?>
                Нет откликов
              <? } ?>
            <? } else { ?>
              <a href="/client/replies/<?= $v['id'] ?>">Откликов: <?= $v['repliesCount'] ?></a>
            <? } ?>
          </p>
        </div>
        <!--
        <div style="float:left;margin-left:20px;width:200px;border-left:1px solid #E8E8E8;padding-left:20px;min-height:65px;">
        </div>
        -->
        <div class="clear"></div>
        <div class="line"></div>
      </div>
    <? } ?>
  </div>
<? } else { ?>
  <div class="noItems">У вас нет заказов<br><a href="/client/add">Добавить?</a></div>
<? } ?>
