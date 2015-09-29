<?php
    class Admin_ApartmentsController extends Zend_Controller_Action
    {
        protected $isAjax = false;
        public function init(){
           $this->isAjax = $this->_request->isXmlHttpRequest();
        }
        
        public function indexAction()
        {
            $mdlApart = new Model_Apartments();
            $this->view->apartments = $mdlApart->getTableApart();
        }
        
        public function newApartAction(){
            $frmNewApart = new Form_EditApart();
            $this->view->form = $frmNewApart;
            
            if ($this->_request->isPost()){
                if ($frmNewApart->isValid($this->_request->getParams())){
                    $mdlApart = new Model_Apartments();
                    $data = $frmNewApart->getValues();
                    unset($data['feature']);
                    
                    $id = $mdlApart->newApart($data);   
                    $features = $this->_request->getParam('feature');
                    $this->setFeatures($id, $features);
                    $this->_helper->layout->message = 'Запись успешно добавлена!';
                    if ($this->_getParam('tophotos')){
                        $this->_redirect('/admin/apartments/edit-photos/id/' . $id);
                    }

                    $this->_redirect('/admin/apartments/');
                }else{
                    $this->view->form = $frmNewApart;
                }
            }
        }
        
        public function delAction(){            
            $mdlApart = new Model_Apartments();
            if ($this->isAjax){
                $this->_helper->ViewRenderer->setNoRender();
                $this->_helper->layout()->disableLayout();
                $id = $this->_request->getParam('id');
                $mdlApart->del($id);
            }else{
                if ($this->_request->isPost()){
                    $id = $this->_request->getPost('ID');
                    $del = $this->_request->getPost('del');
                    if ($del == 'Yes' && $id > 0){
                      $mdlApart->del($id);
                    }
                    $this->_redirect('/admin/apartments/');
                }else{
                    $id = $this->_request->getParam('id');
                    $this->view->apartments = $mdlApart->getDetails($id);
                }
            }
        }
        
        public function deletePhotoAction(){
            $this->_helper->ViewRenderer->setNoRender();
            $this->_helper->layout()->disableLayout();
            $id = $this->_getParam('id');
            $mdlAttachments = new Model_Attachments();
            $mdlAttachments->delete('ID = ' . $id);
            if (!$this->isAjax){
                $this->_redirect('/admin/apartments');
            }
        }
        
        public function editPhotosAction(){
            $id = $this->_getParam('id');
            $mdlApart = new Model_Apartments();
            $apart = $mdlApart->getDetails($id, null);
            $form = new Form_Photos();
            $form->id->setValue('id');
            if ($this->_request->isPost()){
                if ($form->isValid($this->_request->getParams())){
                    $attachments = new Model_Attachments();
                    $adapter = $form->file->getTransferAdapter();
                    foreach ($adapter->getFileInfo() as $file){
                        $adapter->receive($file['name']);
                        $attachments->add($id, $file['name'], 0, 0);
                        $this->view->layout()->message = 'Фотографии загружены';
                    }
                }
            }
            $this->view->id = $id;
            $this->view->form = $form;
            $this->view->photos = $apart->findDependentRowset('Model_Attachments');
        }
        
        public function editAction()
        {
            $frmEdit = new Form_EditApart();
            
            $mdlApart = new Model_Apartments();
            $id = $this->_getParam('id');
            $arr = $mdlApart->getDetails($id, null);
            $arrayApart = $arr->toArray();
            $features = $arr->findDependentRowset('Model_ApartmentFeature');
            foreach ($features as $v){
                $arrayApart['feature'][$v->feature_id] = 1;
                if ($v->value){
                    $arrayApart['feature']['value_' . $v->feature_id] = $v->value;
                }
            }
            $frmEdit->removeElement('tophotos');
            $this->view->form = $frmEdit;
            $frmEdit->populate($arrayApart);  
            $this->view->id = $id;
            if ($this->_request->isPost()){
                if ($frmEdit->isValid($this->_request->getParams())){ 
                    $data = $frmEdit->getValues();
                    unset($data['feature']);
                    $mdlApart->edit($data, $id);
                    $features = $this->_request->getParam('feature');
                    $this->setFeatures($id, $features);
                    $this->_redirect('/admin/apartments/');
                } 
            } 
        }
        
        private function setFeatures($apartment_id, $features){
            $mdlFeatures = new Model_ApartmentFeature();
            $mdlFeatures->deleteByApartment($apartment_id);
            foreach ($features as $k => $v){
                if (strpos($k, 'value') === false){
                    if ($v){
                        $mdlFeatures->add(array(
                            'apartment_id' => $apartment_id,
                            'feature_id' => $k,
                            'value' => isset($features['value_' . $k])? $features['value_' . $k] : ''
                        ));
                    }
                }
            }
        }
        
        public function mapAction()
        {
            $mdlApart = new Model_Apartments();
            $id = $this->_getParam('id');
            $mdlApart->getDetails($id);
           
            if($this->_request->isPost())
            {
                $data = $this->_request->getPost('map_number');
                $mdlApart->map($data, $id);
               // var_dump($data);
                //$this->_redirect('/admin/apartments/');
            }
            else{
            $id = $this->_request->getParam('id');
            $this->view->apartments = $mdlApart->getDetails($id);
        }        
        }
                
        public function hideAction(){
            $mdlApart = new Model_Apartments();
            if ($this->isAjax){
                $this->_helper->ViewRenderer->setNoRender();
                $this->_helper->layout()->disableLayout();
                $id = $this->_request->getParam('id');
                return $this->_helper->json(array(
                    'status' => $mdlApart->toggle($id)->published
                ));
            }
            if ($this->_request->isPost()){
                 $id = $this->_request->getPost('ID');
                 $hide = $this->_request->getPost('published');
                 $pub = $this->_request->getPost('pub'); 
                  if ($hide == 'Yes') 
                    $mdlApart->toggle($id);
                  $this->_redirect('/admin/apartments/');
             }else{
		$id = $this->_request->getParam('id');
		$this->view->apartments = $mdlApart->getDetails($id);
	    }
        }
        
        public function sortAction(){
        $order = $this->_getParam('order');
        $this->_helper->ViewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $mdlApart = new Model_Apartments();
        foreach ($order as $k => $v){
            $mdlApart->updatePosition($v['id'], $v['position']);           
        }
    }
        
    }
?>