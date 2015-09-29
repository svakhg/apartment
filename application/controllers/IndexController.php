<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction()
    {
        $mdlText = new Model_Text();
        $this->view->text = $mdlText->getText();       
        $mdlApart = new Model_Apartments();
        $this->view->apartments = $mdlApart->getMainApartments();
        
        if (Model_Lang::get() == 'rus')
        {
            $this->view->headTitle('Посуточно квартиры Харьков, аренда квартир в Харькове');
            $this->view->headMeta()->setName('keywords','Посуточно квартиры Харьков, аренда квартир Харьков, аренда Харьков, дачи Харьков, гостиницы Харьков, сниму квартиру в Харькове, объявления аренда Харьков, гостиницы и мини-отели Харьков, Мир, Украина, недвижимость, аренда, отель, квартира.');
            $this->view->headMeta()->setName('description', 'Квартиры Харькова посуточно. Мы предлагаем большой выбор квартир для посуточной аренды в Харькове – от квартир эконом класса до люкс квартир. Все квартиры евро стандарта, со всеми необходимыми удобствами');
        }
        else
        {
            $this->view->headTitle('Ukraine Apartments, Rental Accommodation In Kharkov, Ukraine – Apartment-kharkov.com');
            $this->view->headMeta()->setName('keywords', 'kharkov ukraine, kharkiv ukraine, ukraine apartments, apartment kharkov, kharkov apartment, apartment in kharkov, kharkov apartments, apartments kharkov, kharkov accommodation, kharkiv apartments, ukraine apartments for rent, travel to kharkov, visit kharkov, apartment for rent in kharkov, apartments in kharkov for rent, apartments rental kharkov, rent kharkov apartments, kharkov apartments renta, l accommodation kharkiv, apartment in kharkiv, rent apartment in kharkov');
            $this->view->headMeta()->setName('description', 'Looking for apartments for rental in Ukraine? You are at the right place. Apartment-kharkov.com provides affordable accommodation services in cities like Kharkov, Kiev along with many others in Ukraine');
        }
    }
    
    public function aboutAction(){
        //$mdlApart = new Model_Text();
        //$this->view->text = $mdlApart->getText('contact_'.Model_Lang::get()); 
        
        $frmMsg = new Form_Message();
        $this->view->form = $frmMsg;
        
        if ($this->_request->isPost())            
        {
            if ($frmMsg->isValid($this->_request->getParams()))
            {  
                $this->sendMessage($frmMsg);
                $this->_redirect('/about/');
            }
        }
        
        if (Model_Lang::get() == 'rus')
        {
            $this->view->headTitle('Контактная информация по аренде квартир, телефон, электронная почта');
            $this->view->headMeta()->setName('description', 'На этой странице вы найдете контактную информацию сайта – номера телефонов, отправка электронных писем, связь через Skype. Свяжитесь с нами и забронируйте лучшую квартиру в Харькове');
            $this->view->headMeta()->setName('keywords', 'квартиры в Харькове. Апартаменты Харьков. Квартира посуточно дешево, сдам дешево квартиру посуточно, Апартаменты недорого, посуточная аренда квартир. Квартиры в Харькове недорого посуточно. Посуточно квартиры в Харькове. Апортаменты Харьков. Гостиница в Украине');

        }
        else
        {
            $this->view->headTitle('Contact Us, Kharkov Apartment rental Services, Ukraine Accomodation – Apartment-kharkov.com');
            $this->view->headMeta()->setName('description', 'Contact us for accommodation rental service in Kharkov along with many other cities in Ukraine. We provide completely professional & affordable services as per visitors’ specific needs and requirements');
            $this->view->headMeta()->setName('keywords', 'kharkov ukraine, kharkiv ukraine, ukraine apartments, apartment kharkov');

        }
    }
    
    protected function sendMessage($form)
    {
        $mdlClient = new Model_Clients();        
        $client = $mdlClient->orderc($form->getValues());
        $mailing = new Model_Mailing();
        $mailing->sending('office@apartment-kharkov.com', 'admin-mess', 'Новое сообщение на вашем сайте', array('client_info' => $client));
       
    }
    
    
    public function loyaltyAction(){
        $mdlApart = new Model_Apartments();
        $this->view->apartments = $mdlApart->getLoyalty();
    }
    
    public function rulesAction(){
        $mdlApart = new Model_Text();
        $this->view->text = $mdlApart->getText('rules_us_'.Model_Lang::get()); 
        
        if (Model_Lang::get() == 'rus')
        {
            $this->view->headTitle('Правила и принципы работы аренды квартир в Харькове');
            $this->view->headMeta()->setName('description', 'На этой странице вы можете найти информацию, о том как забронировать квартиру, как делать предоплату и вносить оплату за посуточную аренду квартир в Харькове, время заселения и время выселения, приезд и выезд из квартиры, доставка из аэропорта');
            $this->view->headMeta()->setName('keywords', 'посуточная квартиры Харьков, аренда квартир Харьков, аренда в Харькове, Гостиница в Украине, аренда в Харькове, аренда машины в Харькове, поселение в Харькове, визит в Харьков');
            
            }
        else
        {
            $this->view->headTitle('Rules, Travel To Kharkov, Visit Kharkov Ukraine – Apartment-kharkov.com');
            $this->view->headMeta()->setName('description', 'If you are making a plan to visit Kharkov, Ukraine, you’ll need hotels or apartments to stay and travel guide so that you couldn’t miss any important places or things here');
            $this->view->headMeta()->setName('keywords', 'travel to kharkov, visit kharkov');
            
         }
    }
    
    public function cityAction()
    {
         if (Model_Lang::get() == 'rus')
        {

            $this->view->headTitle('Информация о Харькове, Украине');
            $this->view->headMeta()->setName('description', 'На этой странице вы можете найти информацию о Харькове, о местах достопримечательностей Харькова, интересных местах. Харьков прекрасный город для бизнеса, отдыха, развлечений и путешествий. В Харькове есть много хороших уютных квартир для посуточной аренды или длительной аренды');
            $this->view->headMeta()->setName('keywords', 'Самолеты в Харьков, виза в Украину, посуточная аренда квартир, аренда квартир в Украине, гостиница в Украине, аренда в Харькове, комфортные апартаменты. Недорого посуточно сдам. Аренда недвижимости в Харькове');     
            
        }
        else
        {
            $this->view->headTitle('Kharkov Accommodation Service, Ukraine Apartments For Rent – Apartment-kharkov.com ');
            $this->view->headMeta()->setName('description', 'Apartment-kharkov.com has been providing apartments rental services in Kharkov, Ukraine for many years. Accommodation services provided by us in Ukraine are affordable in comparison to other service providers');
            $this->view->headMeta()->setName('keywords', 'kharkov accommodation, kharkiv apartments, ukraine apartments for rent'); 
            
        }
    }
    
    public function mailAction()
    {
        
    }
    
    public function imagesAction(){
        $this->_helper->ViewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $mdlApart = new Model_Apartments();
        $apartments = $mdlApart->fetchAll();
        foreach ($apartments as $apart){
            Model_Attachments::add($apart->ID, $apart->photo_1, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_2, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_3, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_4, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_5, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_6, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_7, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_8, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_9, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_10, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_11, 0, 0);
            Model_Attachments::add($apart->ID, $apart->photo_12, 0, 0);
        }
    }
}

