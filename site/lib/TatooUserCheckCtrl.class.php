<?php

/**
 * Проверка текущего пользователя на нужный тип
 */
trait TatooUserCheckCtrl {

  protected function checkUser($expectedStatus) {
    if (!Auth::get('role')) throw new AccessDenied;
    if (Auth::get('role') != $expectedStatus) throw new AccessDenied;
  }

}