<?php

$users = db()->select(<<<SQL
SELECT
  users.id,
  users.phone
FROM
  userStatus,
  users
WHERE
  userStatus.userId=users.id AND
  userStatus.status='master'
SQL
);
$sms = new Smsc;
foreach ($users as $user) {
  $sms->sendSms($user['phone'], 'Новый заказ на Тату-Мании http://'.SITE_DOMAIN.'/my');
  print '.';
}
