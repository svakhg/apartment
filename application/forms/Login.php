<?php

class Form_Login extends Form_Abstract
{
    public function init()
    {
        $login = $this->createElement('text', 'login');
        $login->setLabel('Login:')
                ->setRequired()
                ->addFilter('StripTags')
                ->setAttrib('class', 'pole');
        $this->addElement($login);
        
        $password = $this->createElement('password', 'password');
        $password->setLabel('Password:')
                ->setRequired()
                ->setAttrib('class', 'pole');
        $this->addElement($password);
        $this->addElement('button', 'loginsubmit', array(
            'label' => 'Login',
            'type' => 'submit'));
    }
    
}
?>