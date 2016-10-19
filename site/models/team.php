<?php

defined('_JEXEC') or exit();

class Dmnd_teamModelTeam extends JModelList {

	protected function getListQuery() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('a.*');
		$query->from('#__dmnd_team as a');
		$query->where('a.published = 1');

		$query->select('b.title AS category')
			->join('LEFT', '#__dmnd_team_category AS b ON b.id = a.catid');

		$query->order('b.id asc, a.ordering desc');

		return $query;
	}

	protected function populateState($ordering = null, $direction = null)
	{
	    $this->setState('list.limit', 0);
	    $this->setState('list.start', $value);
	}
}