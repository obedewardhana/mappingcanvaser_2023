<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        $this->load->model("user_model");
        if ($this->session->auth) {
            $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        }
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Home",
            "dataAdmin" => $this->dataAdmin,
            "user" => $this->user_model->get_total(),
        ];

        $this->template->load(template() . '/template', template() . '/content', $push);
    }

}