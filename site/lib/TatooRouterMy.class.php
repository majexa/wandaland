<?php

class TatooRouterMy extends DefaultRouter {

  function init() {
    parent::init();
    if (!Auth::get('role')) throw new Exception('user role not defined');
    //die2(Auth::get('role'));
    redirect('/'.Auth::get('role'));
    die();
  }

}