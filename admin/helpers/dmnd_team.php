<?php

defined( '_JEXEC' ) or die;

class Dmnd_teamHelper
{
	static function addSubmenu( $vName )
	{
		JHtmlSidebar::addEntry(
			JText::_( 'Team' ),
			'index.php?option=com_dmnd_team&view=team',
			$vName == 'team' );

		JHtmlSidebar::addEntry(
			JText::_( 'Categories' ),
			'index.php?option=com_dmnd_team&view=categories',
			$vName == 'categories' );
	}
}