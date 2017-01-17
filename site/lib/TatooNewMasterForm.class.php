<?php

class TatooNewMasterForm extends UserRegPhoneConfirmForm {

  function __construct() {
    parent::__construct([
      [
        'title' => 'Аватар',
        'name' => 'image',
        'required' => true,
        'type'  => 'file'
      ],
//      [
//        'title' => 'Имя',
//        'name' => 'firstName',
//        'required' => true,
//      ],
//      [
//        'title' => 'Фамилия',
//        'name' => 'lastName',
//        'required' => true,
//      ],
    ], [
      'submitTitle' => 'Зарегистрироваться'
    ]);
  }

  protected function userRole() {
    return 'master';
  }

}