<?php

defined('_JEXEC') or exit();

class Dmnd_teamControllerCategories extends JControllerAdmin {

	public function getModel($name = 'Category', $prefix = 'Dmnd_teamModel', $config = array()) {
		return parent::getModel($name, $prefix, $config);
	}
}