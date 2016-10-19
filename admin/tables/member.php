<?php

defined('_JEXEC') or exit();

class Dmnd_teamTableMember extends JTable {

	public function __construct(&$db) {
		parent::__construct('#__dmnd_team', 'id', $db);
	}
}