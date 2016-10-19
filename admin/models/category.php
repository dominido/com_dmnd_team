<?php

defined('_JEXEC') or exit();

class Dmnd_teamModelCategory extends JModelAdmin {

	public function getForm($data = array(), $loadData = true) {

		$form = $this->loadForm(
			'com_dmnd_team.category',
			'category',
			array(
				'control' => 'jform',
				'load_data' => $loadData
				)
			);

		if (empty($form))
			return false;
		else
			return $form;
	}

	public function getTable($type = 'Category', $prefix = 'Dmnd_teamTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}

	// protected function prepareTable($table) {

	// 	// $table->check();
	// 	// $table->store();

	// }

	public function delete (&$pks) {

		parent::delete($pks);
  }

	protected function loadFormData() {
		$data = $this->getItem();

		return $data;
	}




}