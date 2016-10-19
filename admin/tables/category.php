<?php

defined('_JEXEC') or exit();

class Dmnd_teamTableCategory extends JTable {

	public function __construct(&$db) {
		parent::__construct('#__dmnd_team_category', 'id', $db);
	}
}