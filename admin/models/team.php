<?php

defined('_JEXEC') or exit();

class Dmnd_teamModelTeam extends JModelList {

	protected function getListQuery() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('a.*');
		$query->from('#__dmnd_team as a');

		$query->select('b.title AS category')
			->join('LEFT', '#__dmnd_team_category AS b ON b.id = a.catid');

		$query->order('a.catid asc, a.ordering desc');

		return $query;
	}
  
}