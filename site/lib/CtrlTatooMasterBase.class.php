<?php

abstract class CtrlTatooMasterBase extends CtrlTatooBase {

  function action_default() {
    $this->d['blocksTpl'] = 'master/welcomeBlock';
    if (!Auth::get('id')) {
      $form = new TatooNewMasterForm;
      UploadTemp::extendFormOptions($form);
      if ($form->update()) {
        $this->redirect();
        return;
      }
      $this->setPageTitle('Регистрация мастера');
      $this->d['tpl'] = 'bookmarkContent';
      $this->d['form'] = $form->html();
      $this->d['contentTpl'] = 'common/form';
      $this->d['colBodyContent'] = true;
      $this->d['bodyClass'] = 'bdMaster';
      $this->d['sectionTitle'] = 'регистрация';
    }
    else {
      $this->redirect('/master/orders');
    }
  }

}