<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Questionnare extends CI_Controller
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
        $this->load->model("questionnare_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        $this->dataHakakses = $this->hakakses_model->find_hakakses($this->dataAdmin->role,1);

        if($this->dataHakakses < 1){
            redirect(base_url("dashboard"));
        }
        
        $this->dataRole = $this->role_model->get_exclude()->result();
        $this->dataModulcek = $this->hakakses_model->find_moduls($this->dataAdmin->role);
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Questionnare",
            "dataAdmin" => $this->dataAdmin,
            "dataRole"  => $this->dataRole,
            "modulcek" => $this->dataModulcek
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/questionnare', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("pertanyaan");
        $this->datatables->setColumn([
            '<index>',
            '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
            '<get-title>',
            '[get_answers=<get-id>]',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-photo="<get-photo>" data-title="<get-title>" ><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-title="<get-title>" ><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id", "title", NULL]);
        $this->datatables->setSearchField(["title"]);
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
        $title = $this->input->post("title");

        if (!$title ) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {

            $config['upload_path'] = '././img/';
            $config['allowed_types'] = 'jpeg|jpg|png|JPEG|JPG|PNG';
            $config['max_size'] = 2048;
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile')) {
                $gbr = $this->upload->data();
                $gambar = $gbr['file_name'];

                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "photo" => $gambar,
                    "createdby" => $this->dataAdmin->id
                ];
            } else {
                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "createdby" => $this->dataAdmin->id
                ];
            }

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->questionnare_model->post($insertData);
            } else {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->questionnare_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    function insert_answers()
    {
        $this->process_bulk();
    }

    private function process_bulk()
    {

        $title = $this->input->post("title");
        $question = $this->input->post("question");
        $idq = $this->input->post("idq");   

        $this->questionnare_model->delete_answer($idq);

        $temp = count($title);

        $insertData = array();

        for ($i = 0; $i < $temp; $i++) {
            $insertData[] = array(
                "id" => NULL,                
                "title" => $title[$i],
                "question" => $question[$i],
                "createdby" => $this->dataAdmin->id,
            );
        }

        $this->questionnare_model->answer_batch($insertData);

        $response['status'] = TRUE;
        $response['msg'] = "Data berhasil ditambahkan";

        echo json_encode($response);

    }

    function delete($id)
    {
        $response = '';
        $this->questionnare_model->delete($id);
        if (!$this->questionnare_model->find($id)) {
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