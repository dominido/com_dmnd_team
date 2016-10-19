<?php

defined('_JEXEC') or exit();

class Dmnd_teamControllerTeam extends JControllerAdmin {

	public function __construct($config = array())
    {
        parent::__construct($config);

        $this->registerTask('savelist', 'saveList');
    }

    public function saveList()
    {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $ordering    = $this->input->get('ordering', array(), 'array');

        // Get the model.
        $model = $this->getModel();

        // Change the state of the records.
        if (!$model->savelist($ordering))
        {
            JError::raiseWarning(500, $model->getError());
        }

        $this->setRedirect('index.php?option=com_dmnd_team&view=team');
    }

	public function getModel($name = 'Member', $prefix = 'Dmnd_teamModel', $config = array()) {
		return parent::getModel($name, $prefix, $config);
	}
}