<?php

defined('_JEXEC') or exit();


class Dmnd_teamViewTeam extends JViewLegacy {

	protected $items;
	protected $pagination;

	public function display($tpl = null) {

		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->addToolbar();

		$this->loadHelper( 'dmnd_team' );
		dmnd_teamHelper::addSubmenu( 'team' );
		$this->sidebar = JHtmlSidebar::render();

		parent::display($tpl);
	}

	protected function addToolbar() {
		JToolBarHelper::title('Team');

		JToolBarHelper::addNew('member.add');
		JToolBarHelper::editList('member.edit');
		JToolBarHelper::deleteList('', 'team.delete');
		JToolBarHelper::apply('team.savelist');
	}

	protected function setDocument() {
		$document = JFactory::getDocument();
	}
}