<?php

class CtrlTatooAbout extends CtrlTatooBase {

  function action_default() {
    $this->setPageTitle('О сервисе');
    $this->d['menu'][Arr::getKeyByValue($this->d['menu'], 'link', '/about')]['sel'] = true;
    $this->d['sectionTitle'] = 'О сервисе';
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['contentTpl'] = 'about';
  }

}