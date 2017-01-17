<?php

class CtrlTatooWorks extends CtrlMasterAlbumDefault {
  use TatooMenu;

  protected function init() {
    parent::init();
    $this->initTatooMenu();
    if (Auth::get('id') == $this->req->param(1)) {
      $this->d['menu'][2]['sel'] = true;
    }
    $this->d['basePath'] = $this->req->path();
    $this->d['bodyClass'] = 'bdMaster';
    $this->d['sectionTitle'] = 'работы';
  }

  function action_default() {
    parent::action_default();
    $this->setPageTitle('Работы');
    $this->setPageHeadTitle($this->d['user']['name'].': работы');
  }

}