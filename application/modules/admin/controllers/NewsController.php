<?php
class Admin_NewsController extends Zend_Controller_Action
{
   protected $isAjax = false;
    public function init()
    {
       $this->isAjax = $this->_request->isXmlHttpRequest();
    }
    
    public function indexAction()
    {
        $mdlNews = new Model_News();
        $this->view->news = $mdlNews->getNews();
    }
    
    public function newsAction()
    {
        $frmNews = new Form_News();
        $this->view->form = $frmNews;
        
        if ($this->_request->isPost())
        {
            if ($frmNews->isValid($this->_request->getParams()))
            {
                $mdlNews = new Model_News();
                $mdlNews->news($frmNews->getValues());
                
                $this->_helper->layout->message = 'Запись успешно добавлена!';
                $this->_redirect('/admin/news/');
            }
        }
    }
    
    public function editAction()
    {
        $mdlNews = new Model_News();
        $frmNews = new Form_News();
        $id = $this->_getParam('id');
        $arr = $mdlNews->detail($id);
        $arrNews = $arr->toArray();
        

        $this->view->form = $frmNews;
        $frmNews->populate($arrNews);  
            
        if ($this->_request->isPost())
        {
            if ($frmNews->isValid($this->_request->getParams()))
            { 
                $mdlNews->edit($frmNews->getValues(), $id);
                $this->_redirect('/admin/news/');
            }
        }
    }
    
    public function delAction()
    {            
            
        $mdlNews = new Model_News();
            
            if ($this->isAjax){
                $this->_helper->ViewRenderer->setNoRender();
                $this->_helper->layout()->disableLayout();
                $id = $this->_getParam('id');
                $mdlNews->del($id);
            }else{
                if ($this->_request->isPost()){
                    $id = $this->_request->getPost('ID');
                    $del = $this->_request->getPost('del');

                     if ($del == 'Yes' && $id > 0){
                       $mdlNews->del($id);
                     }
                     $this->_redirect('/admin/news/');
                }else{
                   $id = $this->_request->getParam('id');
                   $this->view->news = $mdlNews->detail($id);
                }
            }
        }
}
?>