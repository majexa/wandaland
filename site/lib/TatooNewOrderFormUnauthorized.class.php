<?php

class TatooNewOrderFormUnauthorized extends UserRegPhoneConfirmForm {

  function __construct() {
    parent::__construct([
      [
        'title' => 'Эскиз',
        'name' => 'outlineImage',
        'required' => true,
        'type'  => 'file'
      ]
    ], [
      'submitTitle' => 'Добавить заказ'
    ]);
  }

  protected function userRole() {
    return 'client';
  }

  protected function _update(array $data) {
    parent::_update($data);
    $im = DdCore::imDefault('orders');
    $im->createData['userId'] = $this->authorizedUser['id'];
    $im->create($data);
  }

}