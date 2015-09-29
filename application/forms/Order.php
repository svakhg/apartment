<?php
class Form_Order extends Form_Abstract
{
    public function init()
    {
        $name = $this->createElement('text', 'name');
        $name->setLabel('Name:')
                ->setAttrib('class', 'field')
                ->setAttrib('class', 'zfz4')
                ->setRequired();
        $this->addElement($name);
        
        $email = $this->createElement('text', 'email');
        $email->setLabel('E-mail:')
                ->addValidator('EmailAddress')
                ->setAttrib('class', 'field')
                ->setAttrib('class', 'zfz4')
                ->setRequired();
        $this->addelement($email);
        
        $phone = $this->createElement('text', 'phone');
        $phone->setLabel('Phone:')
                ->setAttrib('class', 'field')
                ->setAttrib('class', 'zfz4');               
        $this->addElement($phone);
                
        $comment = $this->createElement('textarea', 'comment');
        $comment->setLabel('Comments:')
                ->setAttrib('class', 'field')
                ->setAttrib('class', 'zfz4')
                ->setAttrib('cols', '50')
                ->setAttrib('rows', '8');   
        $this->addElement($comment);
        
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