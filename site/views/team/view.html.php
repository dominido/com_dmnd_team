<?php

defined('_JEXEC') or exit();

class Dmnd_teamViewTeam extends JViewLegacy {

	protected $items;
	// protected $pagination;

	function display($tpl = null) {
		$this->items = $this->get('Items');
		// $this->pagination = $this->get('Pagination');

		parent::display($tpl);
	}
}