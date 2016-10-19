<?php

defined('_JEXEC') or exit();

$controller = JControllerLegacy::getInstance('Dmnd_team');

$input = JFactory::getApplication()->input;
$task = $input->get('task', 'display');

$controller->execute($task);

$controller->redirect();