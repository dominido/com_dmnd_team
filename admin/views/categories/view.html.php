<?php

defined('_JEXEC') or exit();

class Dmnd_teamViewCategories extends JViewLegacy {

	protected $items;
	protected $pagination;

	public function display($tpl = null) {

		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->addToolbar();

		$this->loadHelper( 'dmnd_team' );
		dmnd_teamHelper::addSubmenu( 'categories' );
		$this->sidebar = JHtmlSidebar::render();

		parent::display($tpl);
	}

	protected function addToolbar() {
		JToolBarHelper::title('Categories');
		JToolBarHelper::addNew('category.add');
		JToolBarHelper::editList('category.edit');

		JToolBarHelper::deleteList('', 'categories.delete');
	}

	protected function setDocument() {
		$document = JFactory::getDocument();
	}
}