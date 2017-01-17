<?php

return [
  'album'   => [
    [
      'name'     => 'image',
      'title'    => 'Работа',
      'type'     => 'imagePreview',
      'required' => 1
    ],
    [
      'name' => 'oid',
      'title' => 'Порядок',
      'type' => 'integer',
      'system' => 1
    ]
  ],
  'orders'  => [
    [
      'name'     => 'outlineImage',
      'title'    => 'Эскиз',
      'type'     => 'imagePreview',
      'required' => 1
    ],
    [
      'name'  => 'inProgress',
      'title' => 'Набирает отклики',
      'type'  => 'boolCheckbox'
    ]
  ],
  'profile' => [
    [
      'name'  => 'image',
      'title' => 'Аватар',
      'type'  => 'ddUserImage'
    ],
    [
      'name'  => 'about',
      'title' => 'О себе',
      'type'  => 'typoTextarea'
    ],
  ],
  'replies' => [
    [
      'name'     => 'orderId',
      'title'    => 'Заказ',
      'type'     => 'ddItemSelect',
      'required' => 1
    ],
    [
      'name'  => 'price',
      'title' => 'Приблизительная стоимость работ',
      'type'  => 'price'
    ],
    [
      'name'  => 'comment',
      'title' => 'Комментарий',
      'type'  => 'typoTextarea'
    ]
  ]
];
