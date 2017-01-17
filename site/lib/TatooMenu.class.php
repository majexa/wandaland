<?php

trait TatooMenu {

  function initTatooMenu() {
    $this->d['menu'] = [
      [
        'title' => 'Мастера',
        'link'  => '/masters'
      ]
    ];
    if (Auth::get('id')) {
      if (Auth::get('role') == 'master') {
        $this->d['menu'][] = [
          'title' => 'Заказы',
          'link'  => '/master/orders'
        ];
        $this->d['menu'][] = [
          'title' => 'Мои работы',
          'link'  => '/works/'.Auth::get('id')
        ];
      }
      else {
        $this->d['menu'][] = [
          'title' => 'Мои заказы',
          'link'  => '/client'
        ];
        $this->d['menu'][] = [
          'title' => 'Добавить заказ',
          'link'  => '/client/add'
        ];
      }
    }
    $this->d['menu'][] = [
      'title' => 'О сервисе',
      'link'  => '/about'
    ];
  }

}