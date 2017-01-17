<?php

class FieldEConfirmedPhone extends FieldEPhone {

  protected $originalName;

  protected function beforeInit() {
    $this->originalName = $this->options['name'];
    $this->options['name'] = $this->options['name'].'[phone]';
  }

  protected function validate2() {
    if (!Misc::validPhone('+'.$this->options['value']['phone'])) $this->error = "Неправильный формат телефона";
    $correctCode = db()->selectCell('SELECT code FROM userPhoneConfirm WHERE code=? AND phone=?', $this->options['value']['code'], $this->options['value']['phone']);
    if (!$correctCode) $this->error = "Код введён не верно";
  }

  protected function prepareInputValue($value) {
    return '+'.$value['phone'];
  }

  protected function prepareValue() {
    if (empty($this->options['value'])) return;
    $this->options['value']['phone'] = trim($this->options['value']['phone'], '+ ');
  }

  function postRowHtml() {
    return <<<HTML
<div class="phoneConfirmationBlock">
  <div class="element">
    <p><a href="#" class="pseudoLink confirmPhone">Выслать пароль</a></p>
  </div>
  <div class="element">
    <p class="label">Пароль<b class="reqStar" title="Обязательно для заполнения" style="cursor:help">*</b>:</p>
    <div class="field-wrapper"><input type="text" name="{$this->originalName}[code]"></div>
  </div>
</div>
HTML;
  }



}