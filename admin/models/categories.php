<?php

defined('_JEXEC') or exit();

class Dmnd_teamModelCategories extends JModelList {

	protected function getListQuery() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*');
		$query->from('#__dmnd_team_category');
		$query->order('title asc');

		return $query;
	}
}