<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("data_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Dashboard",
            "dataAdmin" => $this->dataAdmin,
            "user" => $this->user_model->get_total(),

        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/dashboard', $push);
        $this->load->view('administrator/footer', $push);
    }

}
