<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model("user_model");
    }

    function index()
    {
        $this->login();
    }


    public function login()
    {
        $loggedin = $this->session->auth;
        if ($loggedin) {
            redirect(base_url("dashboard"));
        }

        $push = [
            "error" => FALSE,
            "username" => NULL,
            "password" => NULL,
            "pageTitle" => "Login",
            "authPage" => TRUE
        ];
        if ($this->input->post()) {
            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $push['username'] = $username;
            $push['password'] = $password;

            $query = $this->user_model->get(["username" => $username, "password" => md5($password)]);

            $error = FALSE;

            if (!$query->num_rows()) {
                $error = "Username yang anda masukkan salah / tidak ditemukan";
            } else {
                $fetch = $query->row();

                $setSession = [
                    "logged_in" => TRUE,
                    "id" => $fetch->id,
                ];

                $this->session->set_userdata("auth", $setSession);

                redirect(base_url("dashboard"));
            }

            if ($error) {
                $push['error'] = $error;
            }
        }

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/login', $push);
        $this->load->view('administrator/footer', $push);
    }

    function logout()
    {
        $this->session->sess_destroy();

        if ($this->session->auth['logged_in']) {
            $this->session->sess_destroy();
            $this->session->unset_userdata("auth");
            redirect(base_url("main"));
        }
    }
}
