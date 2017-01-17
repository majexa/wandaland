<?php

class CtrlConfirmedPhone extends CtrlBase {

  function action_json_default() {
    $phone = trim($this->req->rq('phone'), '+ ');
    if (($existing = db()->selectRow("SELECT * FROM userPhoneConfirm WHERE phone=?", $phone))) {
      $code = $existing['code'];
    } else {
      $code = Misc::randNum(4);
      db()->create('userPhoneConfirm', [
        'phone'      => $phone,
        'code'       => $code,
        'attempts'   => 1,
        'dateCreate' => Date::db()
      ]);
    }
    (new Smsc)->sendSms($this->req->rq('phone'), 'CODE: '.$code, 0, 0, 0, 0, SITE_DOMAIN);
    $this->json = ['sent' => true];
  }

}