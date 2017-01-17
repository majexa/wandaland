<?php

class TatooNewOrderForm extends Form {

  function __construct() {
    parent::__construct(DdCore::imDefault('orders')->form->fields, [
      'submitTitle' => 'Добавить заказ'
    ]);
  }

  protected function _update(array $data) {
    $im = DdCore::imDefault('orders');
    $im->createData['userId'] = Misc::checkEmpty(Auth::get('id'));
    $im->create($data);
  }

}