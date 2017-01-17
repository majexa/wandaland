<?php

class TatooRouter extends ThmFourRouter {

  function _getController() {
    if (isset($this->req->params[0])) {
      // /master or /client path
      if (Auth::get('id')) {
        $name = $this->req->params[0];
      }
      else {
        if ($this->req->params[0] == 'master' or $this->req->params[0] == 'client') {
          $name = $this->req->params[0].'Unauthorized';
        } else {
          $name = $this->req->params[0];
        }
      }
      $name = 'CtrlTatoo'.ucfirst($name);
      return new $name($this);
    }
    return parent::_getController();
  }

}
