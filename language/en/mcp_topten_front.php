<?php

if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'MSG'           => 'messages',
    'MSG_COUNT'     => 'messages count',
    'SELECT_MONTH'  => 'Select a mouth',
    'LAST_DAYS'     => 'last days',
));
