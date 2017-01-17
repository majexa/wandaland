<?php

class CtrlTatooMasters extends CtrlTatooBase {

  protected function init() {
    parent::init();
    $this->d['menu'][0]['sel'] = true;
    $this->d['sectionTitle'] = 'мастера';
  }

  function action_default() {
    $this->d['items'] = db()->query(<<<SQL
SELECT dd_i_profile.*, users.name FROM users
RIGHT JOIN dd_i_profile ON users.id=dd_i_profile.userId
WHERE
  users.role='master' AND
  users.active=1
SQL
    );
    $this->setPageTitle('Мастера');
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['contentTpl'] = 'masters';
  }

}