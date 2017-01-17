<?php

class CtrlTatooClient extends CtrlTatooClientBase {
  use TatooUserCheckCtrl;

  protected function newOrderForm() {
    return new TatooNewOrderForm;
  }

  function menuPathParamsN() {
    return 2;
  }

  protected function init() {
    parent::init();
    $this->checkUser('client');
  }

  function action_default() {
    $this->d['menu'][1]['sel'] = true;
    $this->d['layout'] = 'cols2';
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['contentTpl'] = 'master/list';
    $this->d['blocksTpl'] = 'empty';
    $this->d['contentTpl'] = 'client/orders';
    //
    $items = (new DdItems('orders'));
    $items->addF('userId', Auth::get('id'));
    $orders = $items->getItems();
    if ($orders) {
      $replyCounts = db()->select(<<<SQL
SELECT
  tagId AS orderId,
  COUNT(*) AS cnt
FROM tagItems, dd_i_replies
WHERE
  strName='replies' AND
  groupName='orderId' AND
  tagId IN (?a) -- orderId
  AND dd_i_replies.id=tagItems.itemId -- проверка на существование записей в таблице dd_i_replies
GROUP BY tagId
SQL
        , array_keys($orders));
      foreach ($replyCounts as $v) {
        $orders[$v['orderId']]['repliesCount'] = $v['cnt'];
      }
    }
    $this->d['items'] = $orders;
  }

  function action_replies() {
    $this->d['layout'] = 'cols2';
    $this->d['blocksTpl'] = 'client/repliesBlock';
    $this->d['contentTpl'] = 'client/replies';
    $this->setPageTitle('Мои отклики');
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['order'] = (new DdItems('orders'))->getItem($this->req->param(2));
    $items = new DdItems('replies');
    $items->addTagFilter('orderId', $this->req->param(2));
    $this->d['items'] = array_values($items->getItems());
    $userIds = Arr::get($this->d['items'], 'userId');
    $r = db()->query(<<<SQL
    SELECT userId, name FROM dd_i_profile WHERE userId IN (?a) ORDER BY FIELD(ID, ?a)
SQL
    , $userIds, $userIds);
    foreach ($r as $n => $v) {
      $this->d['items'][$n]['userName'] = $v['name'];
    }
//    $this->d['pNums'] = $items->pNums;
//    $ddo = new DdoFour('replies', 'siteItems');
//    $ddo->ddddByName['price'] = '(file_exists(UPLOAD_PATH.`/user/sm_`.$authorId.`.jpg`) ? `<img src="/u/user/sm_`.$authorId.`.jpg">` : `<img src="/m/img/empty.png">`).Misc::formatPrice($v).` <span class="currency">Ᵽ</span><p><a href="/works/`.$authorId.`">Работы мастера</a></p>`';
//    $_items = $items->getItems();
//    $this->d['html'] = count($_items) ? $ddo->setItems($_items)->els() : '<div class="noItems">заказов предложений</div>';
  }

}