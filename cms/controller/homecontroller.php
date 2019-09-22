<?php

namespace cms\controller;

class homecontroller extends cmscontroller
{
    public function index()
    {
        $data = ['name' => 'Lexa'];
        $this->view->render('index', $data);
        ///echo 'Index Page';
    }

    public function news($id)
    {
        echo $id;
    }

}