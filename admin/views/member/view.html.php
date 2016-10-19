<?php

defined('_JEXEC') or exit();

class Dmnd_teamViewMember extends JViewLegacy {

	protected $form;
	protected $item;

	public function display($tpl = null) {

		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		$this->addToolbar();

		parent::display($tpl);
	}

	protected function addToolbar() {
		JToolBarHelper::title('New Team Member');
		JToolBarHelper::apply('member.apply');
		JToolBarHelper::save('member.save');
		JToolBarHelper::cancel('member.cancel');
	}

	protected function setDocument() {
		$document = JFactory::getDocument();
	}
}