<?php

class TatooRouterManager extends ThmFourRouterManager {

  protected function getDefaultRouter() {
    if (isset($this->req->params[0])) {
      if (class_exists('CtrlTatoo'.ucfirst($this->req->params[0]))) {
        return new TatooRouter($this->options['routerOptions']);
      } elseif ($this->req->params[0] == 'my') {
        return new TatooRouterMy;
      } else {
        return parent::getDefaultRouter();
      }
    }
    return new TatooRouter($this->options['routerOptions']);
  }

}