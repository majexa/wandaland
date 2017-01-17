<link rel="stylesheet" type="text/css" href="/thm/css/users.css" media="screen, projection"/>
<div class="users">
  <? foreach ($d['items'] as $v) { ?>
    <div class="item">
      <a href="/works/<?= $v['userId'] ?>">
        <img src="<?= UPLOAD_DIR.'/'.MIsc::getFilePrefexedPath($v['image'], 'sm_') ?>">
        <p><?= $v['name'] ?></p>
      </a>
    </div>
  <? } ?>
</div>
