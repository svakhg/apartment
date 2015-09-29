<?php

class Admin_ServicesController extends Zend_Controller_Action
{
    protected $isAjax = false;
    public function init(){
       $this->isAjax = $this->_request->isXmlHttpRequest();
    }
    
    public function indexAction()
    {
        $mdlServ = new Model_Services();         
        $this->view->services = $mdlServ->getServicesList();           
    }
    
    public function sortAction(){
        $order = $this->_getParam('order');
        $this->_helper->ViewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $mdlServices = new Model_Services();
        foreach ($order as $k => $v){
            $mdlServices->updatePosition($v['id'], $v['position']);
        }
    }
    
    public function newServAction()
    {
        $frmServ = new Form_Service();
        $this->view->form = $frmServ;

        if ($this->_request->isPost())
        {
            if ($frmServ->isValid($this->_request->getParams()))
            {   
               $frmServ->photo_1->receive();
               $frmServ->photo_2->receive();              
               $frmServ->imgic->receive();
               $mdlServ = new Model_Services();
               $mdlServ->newService($frmServ->getValues());
               $this->_redirect('/admin/services/'); 
           }                
        }
        
      }

     public function editAction()
    {
        $mdlServ = new Model_Services();
        $id = $this->_getParam('id');
        $arr = $mdlServ->detal($id);
        $arrServ = $arr->toArray();  
        $this->view->service = $arr;
        $frmServ = new Form_Service();
        $this->view->form = $frmServ;
        $frmServ->populate($arrServ);

        if ($this->_request->isPost())
        {
            if ($frmServ->isValid($this->_request->getParams()))
            {
               $frmServ->photo_1->receive();
               $frmServ->photo_2->receive();
               $frmServ->imgic->receive();
               $mdlServ->edit($frmServ->getValues(), $id);                   
               $this->_helper->layout->message = 'Запись обновлена!';
               $this->_redirect('/admin/services/');
           }                
        }
    }
    
    public function delAction(){            
        $mdlServ = new Model_Services();
        if ($this->isAjax){
            $this->_helper->ViewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $id = $this->_getParam('id');
            $mdlServ->del($id);
        }else{
            if ($this->_request->isPost())
            {
                 $id = $this->_request->getPost('ID');
                 $del = $this->_request->getPost('del');

                  if ($del == 'Yes' && $id > 0) 
                  {
                    $mdlServ->del($id);
                  }
                  $this->_redirect('/admin/services/');
             }
             else
             {
                $id = $this->_request->getParam('id');
                $this->view->services = $mdlServ->detal($id);
             }
        }
    }
    
    
    
    public function sortingAction()
    {
        $frmServ = new Form_Sorting();
        $this->view->form = $frmServ;
        
        $mdlServ = new Model_Services();
        $id = $this->_getParam('id');
        $arr = $mdlServ->lefticons();
        $arrServ = $arr->toArray(); 
        
        $frmServ->populate($arrServ);
        
         if ($this->_request->isPost())
        {
            if ($frmServ->isValid($this->_request->getParams()))
            {   
                $mdlServ = new Model_Services();
                $mdlServ->sorting($frmServ->getValues());
                //$this->_redirect('/admin/services/'); 
            }
        }
    }
    
        
        
}

?>