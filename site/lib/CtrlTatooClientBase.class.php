<?php

abstract class CtrlTatooClientBase extends CtrlTatooBase {

  /**
   * @return TatooNewOrderForm
   */
  abstract protected function newOrderForm();

  function action_add() {
    $this->d['menu'][2]['sel'] = true;
    $form = $this->newOrderForm();
    UploadTemp::extendFormOptions($form);
    if ($form->update()) {
      $this->redirect('/client/orders');
      return;
    }
    $this->setPageTitle('Добавление заказа');
    $this->d['sectionTitle'] = '+ заказ';
    $this->d['blocksTpl'] = 'client/outlineHelp';
    $this->d['tpl'] = 'bookmarkContent';
    $this->d['form'] = $form->html();
    $this->d['contentTpl'] = 'common/form';
    $this->d['colBodyContent'] = true;
  }

}
