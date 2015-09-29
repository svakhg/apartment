<?php
class Form_Reserve extends Form_Abstract
{
    public function init(){
        $name = $this->createElement('text', 'name');
        $name->setLabel('Name:')
                //->setAttrib('class', 'field')
                ->setRequired();
        $this->addElement($name);
        
        $email = $this->createElement('text', 'email');
        $email->setLabel('E-mail:')
                //->setAttrib('class', 'field')
                ->setRequired();
        $this->addelement($email);
        
        $phone = $this->createElement('text', 'phone');
        $phone->setLabel('Phone:');               
        $this->addElement($phone);
        
        $arrival = $this->createElement('text', 'arrival');
        $arrival->setLabel('Arrival date:')
                ->setAttrib('class', 'calendar')
                ->setRequired();     
        $this->addElement($arrival);

        $departure = $this->createElement('text', 'departure');
        $departure->setLabel('Departure date:')
                ->setAttrib('class', 'calendar')
                ->setRequired(); 
        $this->addElement($departure);         
                
        $comment = $this->createElement('textarea', 'comment');
        $comment->setLabel('Comments:')
                //->setAttrib('class', 'field')
                ->setAttrib('cols', '40')
                ->setAttrib('rows', '6');
        
        $this->addElement($comment);

        $this->addElement('submit', 'submit1', array('label' => 'additional services', 'class' => 'red_button', 'id' => 'add-srv', 'decorators' => array('ViewHelper')));
        $sub = new Zend_Form_SubForm();
        $mdlServices = new Model_Services();
        $services = $mdlServices->getShowOnOrder();
        foreach ($services as $service){
            $check = $sub->createElement('checkbox', $service->ID);
            $check->setLabel($service->get('name') .' ' . (Model_Lang::get() == 'rus'? 'от' : 'from') . ' $'. $service->price_usd);
            $sub->addElement($check); 
            $sub->removeDecorator('Label');
        }
        $sub->setAttrib('class', 'hidden');
        $this->addSubForm($sub, 'services');
        
        /*$check1 = $this->createElement('checkbox', 'check1');
        $icons->setLabel('Услуга');
        $this->addElement($check1);*/
        
        $privateKey = '6LftVcISAAAAAOMm6OIPNgeWoQTv6hDKMADGAZGT';
        $publicKey = '6LftVcISAAAAABsptp8242dq7_-mZ1qrwWRH_46g';
        $recaptcha = new Zend_Service_ReCaptcha($publicKey, $privateKey);
        
        $captcha = new Zend_Form_Element_Captcha('captcha', 
                array('captcha'         => 'ReCaptcha',
                      'captchaOptions'   => array('captcha' => 'ReCaptcha', 'service' => $recaptcha)));
        $this->addElement($captcha);

        $this->addElement('submit', 'submit', array('label' => 'Send order', 'class' => 'red_button', 'decorators' => array('ViewHelper'))); 
   
    }
}


?>