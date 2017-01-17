<?php

class CtrlTatooMaster extends CtrlTatooMasterBase {
  use TatooUserCheckCtrl;

  function menuPathParamsN() {
    return 2;
  }

  protected function init() {
    parent::init();
    if (!Auth::get('id')) throw new AccessDenied;
    $this->d['menu'][1]['sel'] = true;
    $this->checkUser('master');
  }

  function action_json_edit() {
    return new UsersAuthEditForm(Auth::get('id'));
  }

  function action_orders() {
    $this->setPageTitle('Заказы');
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['html'] = 'Раздел временно не работает. Ожидайте новых заказов через SMS оповещения';
    return;

    $this->d['contentTpl'] = 'master/orders';
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['sectionTitle'] = 'Заказы';
    $items = (new DdItems('orders'));
    $this->d['pNums'] = $items->pNums;
    $ddo = new DdoFour('orders', 'siteItems');
    $ddo->ddddByName['outlineImage'] = '`<div class="thumbCont">'. //
      '<a href="`.$v.`" class="thumb" target="_blank"><div class="thumbHover"></div>'. //
      '<img src="`.Misc::getFilePrefexedPath($v, `sm_`).`" /></a>'. //
      '<p><a href="/master/reply/`.$id.`">Откликнуться</a></p>'. //
      '</div>`';
    $_items = $items->getItems();
    $tagIds = $_items ? array_keys($_items) : [0];
    $replied = db()->select(<<<SQL
SELECT
  tagItems.tagId AS orderId,
  tagItems.itemId AS replyId
FROM
  tagItems,
  dd_i_replies
WHERE
  tagItems.strName='replies' AND
  tagItems.groupName='orderId' AND
  tagItems.tagId IN (?a) AND -- orderId
  dd_i_replies.id=tagItems.itemId AND
  dd_i_replies.userId=?d
SQL
      , $tagIds, Auth::get('id'));
    foreach ($replied as $v) {
      $_items[$v['orderId']]['replyId'] = $v['replyId'];
    }
    $this->d['blocksTpl'] = 'master/ordersBlock';
    $this->d['contentTpl'] = 'master/orders';
    $this->d['items'] = $_items;
  }

  function action_reply() {
    $this->d['order'] = (new DdItems('orders'))->getItem($this->req->param(2));
    if (!$this->d['order']) throw new Error404;
    $replied = db()->selectCell(<<<SQL
SELECT itemId FROM
  tagItems,
  dd_i_replies
WHERE
  tagItems.strName='replies' AND
  tagItems.groupName='orderId' AND
  tagItems.tagId=?d AND
  dd_i_replies.id=tagItems.itemId AND
  dd_i_replies.userId=?d
SQL
      , $this->d['order']['id'], Auth::get('id'));
    if ($replied) throw new Error404('already replied');
    $this->d['layout'] = 'cols2';
    $this->d['blocksTpl'] = 'master/replyHelp';
    $this->d['contentTpl'] = 'master/list';
    $this->d['tpl'] = 'bookmarkContent';
    $this->setPageTitle('Откликнуться на заказ №'.$this->d['order']['id']);
    $this->d['basePath'] = '/master/orders';
    $this->d['sectionTitle'] = 'Заказы';
    $this->d['contentTpl'] = 'master/reply';
    $im = DdCore::imDefault('replies');
    $im->createData['orderId'] = $this->d['order']['id'];
    $im->form->options['submitTitle'] = 'Отправить отклик';
    if ($im->requestCreate()) {
      $this->redirect('/master/replied');
    }
    $this->d['form'] = $im->form->html();
  }

  function action_showReply() {
    $r = (new DdItems('replies'))->getItem($this->req->param(2));
    $this->setPageTitle('Ваш отклик к заказу №'.$r['orderId']['id']);
    $this->d['layout'] = 'cols2';
    $this->d['blocksTpl'] = 'master/replyHelp';
    $this->d['html'] = '<p>Цена: '.$r['price'].'</p><p>Комментарий: '.$r['comment'].'</p>';
    $this->d['tpl'] = 'bookmarkContent';
  }

  function action_replied() {
    $this->d['layout'] = 'cols2';
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['html'] = 'Отправлено';
  }

  function action_works() {
    $this->d['layout'] = 'cols2';
    $this->d['blocksTpl'] = 'empty';
    $this->d['contentTpl'] = 'master/works';
    $this->d['tpl'] = 'bookmarkContent';
  }

}