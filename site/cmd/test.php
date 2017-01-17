<?php

$file = TEMP_PATH.'/1.jpg';
copy(NGN_PATH.'/more/lib/test/fixture/1.jpg', $file);
$form = new TatooNewMasterForm;
$form->fromRequest = false;
$form->setElementsData([
  'image' => [
    'tmp_name' => $file
  ],
  'phone' => '79202560776',
  'code' => '123'
]);
if ($form->update()) {
  die2($form->registeredUser);
} else {
  die2(Misc::transit($form->lastError));
}
