<?php

defined('_JEXEC') or exit();

require_once JPATH_COMPONENT.'/helpers/dmnd_team.php';

$controller = JControllerLegacy::getInstance('Dmnd_team');

JFactory::getDocument()->addStyleSheet( JURI::base().'components/com_dmnd_team/assets/style.css' );

$input = JFactory::getApplication()->input;
$task = $input->get('task', 'display');

$controller->execute($task);

$controller->redirect();