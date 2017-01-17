<?php

abstract class CtrlTatooBase extends CtrlThemeFourBase {
  use TatooMenu;

  protected function init() {
    parent::init();
    $this->d['layout'] = 'cols2';
    $this->d['logoutPath'] = '/';
    $this->initTatooMenu();
  }

}