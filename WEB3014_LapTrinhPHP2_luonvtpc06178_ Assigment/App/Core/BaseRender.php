<?php

namespace App\Core;

use App\Controllers\BaseController;

class BaseRender extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function renderHeader(){
    //     $this->load->render('layouts/client/header');
    // }

    public function renderAdminFooter(){
        $this->load->render('layout/admin/footer');
    }

    public function renderAdminHeader(){
        $this->load->render('layout/admin/header');
    }

    public function renderAdminNav(){
        $this->load->render('layout/admin/nav');
    }

    // public function renderFooter(){
    //     $this->load->render('layouts/client/footer');
    // }


}