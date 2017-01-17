<div class="colBodyContent">
  <p>Вы хотите откликнуться на заказ №<?= $d['order']['id'] ?></p>
  <p>Эскиз заказа:</p>
  <p>
    <a href="<?= $d['order']['outlineImage'] ?>" target="_blank" class="thumb">
      <img src="<?= $d['order']['sm_outlineImage'] ?>">
    </a>
  </p>
  <p><?= $d['order']['size'] ?>см<sup>2</sup>, <?= $d['order']['bodyPart'] ?></p>
  <div class="apeform<?= $d['forceDefaultInit'] ? ' forceDefaultInit' : '' ?>">
    <?= $d['form'] ?>
  </div>
</div>

<script>
  Ngn.Form.factory(document.getElement('.apeform form'));
</script>