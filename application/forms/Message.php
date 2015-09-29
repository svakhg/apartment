<?php
class Form_Message extends Form_Abstract
{
    public function init(){
        $name = $this->createElement('text', 'name');
        $name->setLabel('Name:')
                ->setRequired();
        $this->addElement($name);
        
        $email = $this->createElement('text', 'email');
        $email->setLabel('E-mail:')
                ->setRequired();
        $this->addelement($email);
        
        $subject= $this->createElement('text', 'subject');
        $subject->setLabel('Subject:')
                ->setRequired();
        $this->addelement($subject);
        
        $comment = $this->createElement('textarea', 'comment');
        $comment->setLabel('Comments:')
                ->setAttrib('cols', '40')
                ->setAttrib('rows', '6');        
        $this->addElement($comment);

        $this->addElement('submit', 'submit', array('label' => 'Send message', 'class' => 'red_button', 'decorators' => array('ViewHelper'))); 
     }
}

?>