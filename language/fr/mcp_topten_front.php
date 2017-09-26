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
    'MSG'           => 'messages du mois',
    'MSG_COUNT'     => 'nombre de messages',
    'SELECT_MONTH'  => 'Sélectionner un mois',
    'LAST_DAYS'     => 'derniers jours',
));
