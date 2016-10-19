<?php

defined('_JEXEC') or exit();

class Dmnd_teamViewCategory extends JViewLegacy {

	protected $form;
	protected $item;

	public function display($tpl = null) {

		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		$this->addToolbar();

		parent::display($tpl);
	}

	protected function addToolbar() {
		JToolBarHelper::title('New Category');
		JToolBarHelper::apply('category.apply');
		JToolBarHelper::save('category.save');
		JToolBarHelper::cancel('category.cancel');
	}

	protected function setDocument() {
		$document = JFactory::getDocument();
	}
}