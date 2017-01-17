<?php

class CtrlTatooClientUnauthorized extends CtrlTatooClientBase {

  protected $defaultAction = 'add';

  protected function newOrderForm() {
    return new TatooNewOrderFormUnauthorized;
  }

}