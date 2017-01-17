<?php

class TatooRepliesNotify {

  protected $sms;

  function __construct() {
    $this->sms = new Smsc;
  }

  protected function sendRepliesSms($order) {
    if (!$order['replies']) return;
    output("Sending sms to {$order['phone']}");
    $this->sms->sendSms($order['phone'], //
      "Вам поступило {$order['replies']} откликов на Тату-Мании http://".SITE_DOMAIN."/my", //
      0, 0, 0, 0, SITE_DOMAIN);
    db()->query("UPDATE dd_i_orders SET inProgress=0 WHERE id=?d", $order['id']);
  }

  protected function sendOrders($orders) {
    foreach ($orders as $order) {
      $this->sendRepliesSms($order);
    }
  }

  protected function extendByReplyCounts(&$orders) {
    $replyCounts = db()->selectCol(<<<SQL
SELECT
  tagId AS ARRAY_KEY,
  COUNT(*)
FROM tagItems, dd_i_replies
WHERE
  strName='replies' AND
  groupName='orderId' AND
  tagId IN (?a) -- orderId
  AND dd_i_replies.id=tagItems.itemId -- проверка на существование записей в таблице dd_i_replies
GROUP BY tagId
SQL
      , Arr::get($orders, 'id'));
    foreach ($orders as &$order) {
      $order['replies'] = isset($replyCounts[$order['id']]) ? $replyCounts[$order['id']] : 0;
    }
  }

  /**
   * Отправляет заказы с откликами, которые были добавлены сутки назад
   */
  protected function sendExpiredOrders() {
    $orders = db()->select(<<<SQL
SELECT
  dd_i_orders.id,
  users.phone
FROM
  dd_i_orders, users
WHERE
  dd_i_orders.userId=users.id AND
  dd_i_orders.inProgress = 1 AND
  dd_i_orders.dateCreate < ?
SQL
      , Date::db(time() - 24 * 60 * 60));
    $this->extendByReplyCounts($orders);
    $this->sendOrders($orders);
  }

  /**
   * Отправляет заказы набравшие 5 откликов
   */
  protected function sendRepliedOrders() {
    $orders = db()->select(<<<SQL
SELECT
  dd_i_orders.id,
  users.phone
FROM
  dd_i_orders, users
WHERE
  dd_i_orders.userId=users.id AND
  dd_i_orders.inProgress = 1
SQL
    );
    $this->extendByReplyCounts($orders);
    $this->sendOrders($orders);
  }

  function send() {
    $this->sendExpiredOrders();
    $this->sendRepliedOrders();
  }

}
