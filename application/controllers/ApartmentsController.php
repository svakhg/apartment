<?php

    class ApartmentsController extends Zend_Controller_Action{
        protected $isAjax = false;

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

        public function init(){
            $this->isAjax = $this->_request->isXmlHttpRequest();        
        }
        
        public function indexAction(){
            $mdlApart = new Model_Apartments();
            $mdlApartFeature = new Model_ApartmentFeature();
            $price_from = $this->_getParam('price_from');
            $price_to = $this->_getParam('price_to');
            $rooms = $this->_getParam('rooms'); 
            
            //$this->view->features = $mdlApartFeature->features(array(5,27,15));   
            
            $this->view->apartments = $mdlApart->getApartments($rooms, $price_from, $price_to);
            if ($this->isAjax){
                $this->_helper->ViewRenderer->setNoRender();
                $this->_helper->layout()->disableLayout();
                echo Zend_Json_Encoder::encode(array(
                    'status' => 'ok',
                    'content' => $this->view->render('apartments/index.phtml')
                ));
            }
            
        if (Model_Lang::get() == 'rus')
        {
            $this->view->headTitle('Аренда квартир в Харькове. Квартиры посуточно Харьков. Харьков аренда');
            $this->view->headMeta()->setName('description', 'Комфортабельные апартаменты в Харькове для гостей города - отличная альтернатива гостиницам и отелям. Мы предлагает большой выбор квартир евро стандарта для вашего комфортного пребывания в Харькове');
            $this->view->headMeta()->setName('keywords', 'Гостиница в Украине, гостиницы Харькова, Харьков аренда посуточно, аренда Харьков квартир, аренда в Харькове, харьковская недвижимость, отель Харьков, отели Харькова, аренда квартиры в Харькове, квартиры Харькова');
            
            }
        else
        {
            $this->view->headTitle('Kharkov Apartments For Rental, Ukraine Apartments Rental Service – Apartment-kharkov.com');
            $this->view->headMeta()->setName('descroption', 'If you want to rent apartment in Kharkov at affordable prices, you are at the right destination. Apartment-kharkov.com provides all kinds of apartments in Khatkov, Ukraine along with various other cities');
            $this->view->headMeta()->setName('keywords', 'apartment kharkov, kharkov apartment, apartment in kharkov, kharkov apartments, apartments kharkov');
            
        }
        }
        
        public function detailsAction(){
            $mdlApart = new Model_Apartments();
            $id = $this->_getParam('id');            
            
            if (!$this->view->apartment = $mdlApart->getDetails($id))
                throw new Zend_Http_Exception('Page not found', 404);
            $this->view->features = $this->view->apartment->findDependentRowset('Model_ApartmentFeature');
            $this->view->images = Model_Attachments::get($id);
            foreach ($this->view->features as $feature){
                if ($feature->feature_id == 27){
                    
                    $this->view->rooms = $feature->value;
                }
            }
            $this->view->headTitle($this->view->apartment->get('comment'));
            $this->view->headMeta()->setName('description', $this->view->apartment->get('addinfo'));
        }
        
         public function reserveAction(){
            
            $frmReserve = new Form_Reserve();
            $id = $this->_getParam('id');
            if ($id){
                $mdlApart = new Model_Apartments();
                $apart = $mdlApart->getDetails($id);
                $this->view->apartments = $apart;
            }
            $this->view->isAjax = $this->isAjax;
            if ($this->_request->isPost() && !$this->isAjax){
                if ($frmReserve->isValid($this->_request->getParams())){
                    $this->sendReserve($id, $frmReserve);
                    $this->_redirect('/apartments/');
                }
            }
            if ($this->isAjax){
                $this->_helper->layout()->disableLayout();
                $frmReserve->setAttrib('class', 'ajax-form');
                $frmReserve->setAction('/apartments/reserve');
                $frmReserve->addElement('hidden', 'apartment');
                $frmReserve->removeElement('captcha');
                $frmReserve->getElement('apartment')->setValue($id)->setDecorators(array('ViewHelper'));
                if ($this->performValidation($frmReserve)){
                    $this->_helper->viewRenderer->setNoRender();
                    $services = $this->_getParam('services');
                    $this->sendReserve($frmReserve->getValue('apartment'), $frmReserve, $services);
                    echo $this->_helper->json(array('status' => 'ok', 'message' => $this->view->translate('Thank you, your order was received, our manager will contact you soon. You may do prepayment after your order is confirmed.')));
                }
            }
            $this->view->form = $frmReserve;
        }
         protected function sendReserve($apartId, $form, $services = null){
            $mdlClient = new Model_Clients(); // data about user and order
            $values = $form->getValues();
            if ($services){
                $res = array();
                foreach ($services as $id => $serive){
                    if ($serive)
                        $res[] = $id;
                }
                $values['services'] = implode(':', $res);
            }
            $services = null;
            if (!empty($res)){
                $mdlServices = new Model_Services();
                $services = $mdlServices->getByIds($res);
            }
            $client = $mdlClient->orderc($values);
            $mdlApart = new Model_Apartments();
            $apart = $mdlApart->getDetails($apartId);
            
            $subj = 'Ваш заказ на сайте apartment-kharkov.com.ua';
            if (Model_Lang::get() == 'eng')
            $subj = 'Your order at Charming Apartments apartment-kharkov.com'; 
            
            $mailing = new Model_Mailing();
            $mailing->sending($client, 'reserve', $subj, array(
                'apartments' => $apart,
                'services' => $services
            ));
            
            $mailing->sending('office@apartment-kharkov.com', 'admin', 'Новый заказ на Вашем сайте', array('apartments' => $apart, 'services' => $services, 'client_info' => $client));
        }
        
        public function paypalAction()
        {  
            $mdlApart = new Model_Apartments();
            $id = $this->_getParam('id');
            $this->view->apartment = $mdlApart->getDetails($id);
            $this->_helper->layout()->disableLayout();
        }
    }