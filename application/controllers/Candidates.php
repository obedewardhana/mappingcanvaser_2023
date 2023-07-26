<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidates extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("role_model");
        $this->load->model("hakakses_model");
        $this->load->model("candidate_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        $this->dataHakakses = $this->hakakses_model->find_hakakses($this->dataAdmin->role,7);

        if($this->dataHakakses < 1){
            redirect(base_url("dashboard"));
        }
        
        $this->dataRole = $this->role_model->get_exclude()->result();
        $this->dataModulcek = $this->hakakses_model->find_moduls($this->dataAdmin->role);

        $this->dataParty = $this->candidate_model->get_party()->result();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Candidates",
            "dataAdmin" => $this->dataAdmin,
            "dataRole"  => $this->dataRole,
            "modulcek" => $this->dataModulcek,
            "dataParty" => $this->dataParty
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/candidates', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("kandidat");
        $this->datatables->setColumn([
            '<index>',
            '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
            '<get-name>',
            '[party_name=<get-party>]',
            '<get-location>',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-name="<get-name>" data-location="<get-location>" data-photo="<get-photo>" data-party="<get-party>" ><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" ><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id", "party", "name", "location", NULL]);
        $this->datatables->setSearchField(["party", "name", "location"]);
        $this->datatables->generate();

    }

    function insert()
    {
        $this->process();
    }

    function update($id)
    {
        $this->process("edit", $id);
    }

    private function process($action = "add", $id = 0)
    {
        $party = $this->input->post("party");
        $name = $this->input->post("name");
        $location = $this->input->post("location");

        if (!$party or !$name or !$location) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {

            $config['upload_path'] = '././img/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPEG|JPG|PNG|webp';
            $config['max_size'] = 2048;
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile')) {
                $gbr = $this->upload->data();
                $gambar = $gbr['file_name'];

                $insertData = [
                    "id" => NULL,
                    "name" => $name,                       
                    "photo" => $gambar,                 
                    "party" => $party,
                    "location" => $location,
                    "createdby" => $this->dataAdmin->id
                ];
            } else {
                $insertData = [
                    "id" => NULL,
                    "name" => $name,                    
                    "party" => $party,
                    "location" => $location,
                    "createdby" => $this->dataAdmin->id
                ];
            }

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->candidate_model->post($insertData);
            } else {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->candidate_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    function delete($id)
    {
        $response = '';
        $this->candidate_model->delete($id);
        if (!$this->candidate_model->find($id)) {
            $response = [
                'status' => TRUE,
                'msg' => "Data berhasil dihapus"
            ];
        } else {
            $response = [
                'status' => FALSE,
                'msg' => "Data gagal dihapus"
            ];
        }

        echo json_encode($response);
    }
}