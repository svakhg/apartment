<?php
class UserController extends Zend_Controller_Action{
    
    public function logoutAction(){
        $this->_helper->ViewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
            $auth->clearIdentity ();
        $this->_redirect($this->view->baseUrl());
    }
    
    public function loginAction(){
        if (Zend_Auth::getInstance()->hasIdentity() && Zend_Auth::getInstance()->getIdentity()->role == 'admin')
            return $this->_redirect($this->view->baseUrl('/admin'));
        $frmLogin = new Form_Login();
        
        if ($this->_request->isPost()){
            if ($frmLogin->isValid($this->_getAllParams())){
                $login = $frmLogin->getElement('login')->getValue();
                $password = $frmLogin->getElement('password')->getValue();
                $db = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'email', 'password');
                $authAdapter->setIdentity($login);
                $authAdapter->setCredential(md5($password));
                $result = $authAdapter->authenticate();
                
                if ($result->isValid()){
            	    $storage = Zend_Auth::getInstance()->getStorage();
                    $storage->write($authAdapter->getResultRowObject(array('ID','email','role')));
                    if (Zend_Auth::getInstance()->getIdentity()->role == 'admin')
                        $this->_redirect($this->view->baseUrl('/admin'));
                    $this->_redirect($this->view->baseUrl());
                }else{
                    $frmLogin->getElement('login')->addError($this->view->translate('Incorrect user email or password'));
                }
            }
        }
        $this->view->form = $frmLogin;
    }
}

?>