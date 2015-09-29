<?php
    class Admin_RayonsController extends Zend_Controller_Action{
        protected $isAjax = false;
        public function init(){
           $this->isAjax = $this->_request->isXmlHttpRequest();
        }
        
         public function indexAction()
         {
            $mdlRayons = new Model_Rayons();
            $this->view->rayons = $mdlRayons->getRayons();
         }
         
         public function newRayonAction()
         {
             $frmRayon = new Form_Rayons();
             $this->view->form = $frmRayon;
             
             if ($this->_request->isPost())
             {
                 if ($frmRayon->isValid($this->_request->getParams()))
                 {
                    $mdlRayon = new Model_Rayons();
                    $mdlRayon->newRayon($frmRayon->getValues());                   
                    $this->_helper->layout->message = 'Запись успешно добавлена!';
                    $this->_redirect('/admin/rayons/');
                }                
             }
         }
         
         public function editAction()
         {
             $mdlRayon = new Model_Rayons();
             $id = $this->_getParam('id');
             $arr = $mdlRayon->detal($id);
             $arrRayon = $arr->toArray();  
             $this->view->rayon = $arr;
             $frmRayon = new Form_Rayons();
             $this->view->form = $frmRayon;
             $frmRayon->populate($arrRayon);
             
             
             
             if ($this->_request->isPost())
             {
                 if ($frmRayon->isValid($this->_request->getParams()))
                 {
                    $mdlRayon->edit($frmRayon->getValues(), $id);                   
                    $this->_helper->layout->message = 'Запись успешно добавлена!';
                    $this->_redirect('/admin/rayons/');
                }                
             }
         }
         
        public function delAction(){            
            $mdlRayons = new Model_Rayons();
            
            if ($this->isAjax){
                $this->_helper->ViewRenderer->setNoRender();
                $this->_helper->layout()->disableLayout();
                $id = $this->_getParam('id');
                $mdlRayons->del($id);
            }else{
                if ($this->_request->isPost()){
                    $id = $this->_request->getPost('ID');
                    $del = $this->_request->getPost('del');

                     if ($del == 'Yes' && $id > 0){
                       $mdlRayons->del($id);
                     }
                     $this->_redirect('/admin/rayons/');
                }else{
                   $id = $this->_request->getParam('id');
                   $this->view->rayons = $mdlRayons->detal($id);
                }
            }
        }
    }
?>