<?php

require_once NGN_ENV_PATH.'/thm4/init.php';

O::replaceInjection('RouterManager', 'TatooRouterManager');

ThmFourModule::init('masterAlbum', 'works');
