<?php
class Model_Mailing{
    public function sending($user, $viewScript, $subject, $data){
        $configMail = array(
            'auth' => 'login', 
            'username' => 'test@apartment-kharkov.com', 
            'password' => '34erdSo03'
        );
         
        $mail = new Zend_Mail('utf-8');
        $transport = new Zend_Mail_Transport_Smtp('smtp.apartment-kharkov.com', $configMail);


        if ($user instanceof Zend_Db_Table_Row)
            $mail->addTo($user->email);
        else
            $mail->addTo($user);

        //$mail->setFrom('apartmentkharkov2012@gmail.com', 'Славянка')
        $mail->setFrom('test@apartment-kharkov.com', 'Славянка')
            
        ->setSubject($subject);

        $view = new Zend_View();

        if ($user instanceof Zend_Db_Table_Row)
            $view->client_info = $user;

        
        foreach($data as $key => $value){
            $view->$key = $value;
        }

        $view->setScriptPath(APPLICATION_PATH . '/views/scripts/mails/');

        if (Model_Lang::get() == 'eng')
        $viewScript .= '-eng'; 
        
        $message = $view->render($viewScript.'.phtml');
        $txt = $view->render($viewScript.'-txt.phtml');

        $mail->setBodyHtml($message);
        $mail->setBodyText($txt);
        $mail->send($transport);      
    }
}