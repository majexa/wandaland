Form.Validator.add('validate-phoneRequired', {
  errorMsg: 'значение этого поля должно быть изменено',
  test: function(element) {
    //console.debug('>>>>>>>');
    if (!element.get('value')) return false;
    //console.debug(element);
    //if (Ngn.Form.forms[element.getParent('form').get('id')].initValues[element.get('name')] == element.get('value'))
    //  return false; else
    //  return true;
  }
});

  Ngn.Form.ElInit.ConfirmedPhone = new Class({
  Extends: Ngn.Form.ElInit.Phone
});

Ngn.Form.El.ConfirmedPhone = new Class({
  Extends: Ngn.Form.El.Phone,

  init: function() {
    this.parent();
    var ePhoneConfirmationBlock = this.eRow.getNext('.phoneConfirmationBlock');
    var btnConfirmPhone = ePhoneConfirmationBlock.getElement('.confirmPhone');
    btnConfirmPhone.addEvent('click', function(e) {
      e.preventDefault();
      var ePhoneField = this.eRow.getElement('input');
      if (!ePhoneField.get('value')) {
        alert('Заполните телефон');
        return;
      }
      if (!this.form.validator.validateField(ePhoneField)) {
        return;
      }
      new Ngn.Request({
        url: '/confirmedPhone'
      }).send({
          phone: ePhoneField.get('value')
        });
    }.bind(this));
  }
});
