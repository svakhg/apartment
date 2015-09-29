<?php

 class Admin_SettingsController extends Zend_Controller_Action
{
    public function init()
    {

    }
    
    public function indexAction()
    {
        $mdlSet = new Model_Settings();
        $arr = $mdlSet->getInfo();
        $arrSet= $arr->toArray();
        $frmContacts = new Form_Contacts();
        
        $this->view->form = $frmContacts;
        $frmContacts->populate($arrSet);
        
        if ($this->_request->isPost())
        {
            if ($frmContacts->isValid($this->_request->getParams()))
            {
                $mdlSet->editInfo($frmContacts->getValues(), 1);
                $this->view->layout()->message = 'Данные сохранены';
            }
        }
        
    }
}
?>