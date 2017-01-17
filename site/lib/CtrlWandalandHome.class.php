<?php

class CtrlWandalandHome extends CtrlDefault {

  function action_default() {
    if (Auth::get('id')) {
      $this->redirect('/my');
      return;
    }
    $this->d['mainTpl'] = 'home';
  }

}