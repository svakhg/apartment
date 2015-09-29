<?php

    class ServicesController extends Zend_Controller_Action{
        protected $isAjax;
        
        public function init(){
             $this->isAjax = $this->_request->isXmlHttpRequest();
        }
        
        public function indexAction()
        {
            $mdlServ = new Model_Services();         
            $this->view->services = $mdlServ->getServicesList();           
        }
        
        public function ServicesMenuAction()
        {
            $mdlServ = new Model_Services();
            $this->view->services = $mdlServ->getServicesMenu();
        }
        
        public function ServicesListAction()
        {
            $mdlServ = new Model_Services();
            $this->view->services = $mdlServ->getServicesList();
        }
        
        public function showServiceAction()
        {
            $mdlServ = new Model_Services();
            $id = $this->_getParam('id');
            $this->view->services = $mdlServ->getShowService($id);
        }
        
        
        public function orderAction(){
            $frmOrd = new Form_Order();
            if ($id = $this->_getParam('id')){
                $mdlServ = new Model_Services();
                $srv = $mdlServ->detal($id);
                $this->view->service = $srv;
            }
            $this->view->isAjax = $this->isAjax;
            if ($this->_request->isPost() && !$this->isAjax){
                if ($frmOrd->isValid($this->_request->getParams())){
                    $this->sendOrder($id, $frmOrd);
                    $this->_redirect('/services/');
                }
            }
            if ($this->isAjax){
                $this->_helper->layout()->disableLayout();
                $frmOrd->setAttrib('class', 'ajax-form');
                $frmOrd->setAction('/services/order');
                $frmOrd->addElement('hidden', 'service');
                $frmOrd->removeElement('captcha');
                $frmOrd->getElement('service')->setValue($id)->setDecorators(array('ViewHelper'));
                if ($this->performValidation($frmOrd)){
                    $this->_helper->viewRenderer->setNoRender();
                    $this->sendOrder($frmOrd->getValue('service'), $frmOrd);
                    //$services = $this->_getParam('services');
                    echo $this->_helper->json(array('status' => 'ok', 'message' => $this->view->translate('Your order is send')));
                }
            }
            $this->view->form = $frmOrd;
        }
        
       protected function sendOrder($serviceId, $form)
       {
            $mdlClient = new Model_Clients(); // data about user and order
            $values = $form->getValues();
            $mdlServ = new Model_Services();
            if (strpos($serviceId, ',') === false){
                $srv = $mdlServ->detal($serviceId);
                $tpl = "order"; 
            }else{
                $res = array();
                foreach (explode(',', $serviceId) as $id){
                    $res[] = $id;
                }
                $srv = $mdlServ->getByIds($res);
                $tpl = "order-big";
            }
            $mdlClient->orderc($form->getValues());
            $client = $mdlClient->orderc($form->getValues());

            $mailing = new Model_Mailing();
            $mailing->sending($client, $tpl, 'Ваш заказ на сайте apartment-kharkov.com.ua', array('service' => $srv));
            
            $mailing->sending('office@apartment-kharkov.com', 'admin-order', 'Новый заказ на Вашем сайте', array('service' => $srv, 'client_info' => $client));
       
        }


        protected function performValidation(Zend_Form $form){
            if ($this->_request->isPost()){
                if (!$form->isValid($this->_request->getPost())){
                    $this->_helper->viewRenderer->setNoRender();
                    echo $this->_helper->json(array('status' => 'fail', 'errors' => $form->getMessages()));
                    return false;
                }
                return true;
            }
        }
        
        public function lefticonsAction()
        {
            $mdlServ = new Model_Services();
            $this->view->services = $mdlServ->lefticons();                 
        }
        
    }

?>
