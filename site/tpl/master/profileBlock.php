<div class="bColBody">
  <h2><?= $d['profile']['name'] ?></h2>
  <? if (Auth::get('id') == $d['user']['id']) { ?>
    <p><a href="#" class="pseudoLink" id="editProfile">Редактировать</a></p>
    <script>
      $('editProfile').addEvent('click', function() {
        new Ngn.Dialog.RequestFormTabs({
          width: 400,
          url: '/profile/json_edit',
          onSubmited: function() {
            window.location.reload();
          }
        });
      });
    </script>
  <? } ?>
  <p><img src="<?= $d['profile']['md_image'] ?>" style="width:205px;border-radius: 3px;"></p>
  <p>Телефон: <?= $d['user']['phone']?></p>
  <p><?= $d['profile']['about']?></p>
</div>