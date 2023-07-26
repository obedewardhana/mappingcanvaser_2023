<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
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
        $this->load->model("modul_model");
        $this->load->model("hakakses_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        $this->dataHakakses = $this->hakakses_model->find_hakakses($this->dataAdmin->role,2);

        if($this->dataHakakses < 1){
            redirect(base_url("dashboard"));
        }

        $this->dataModul = $this->modul_model->get()->result();
        $this->dataModulcek = $this->hakakses_model->find_moduls($this->dataAdmin->role);
        $this->dataMod = $this->modul_model->get()->row();
    }


    public function index()
    {

        $push = [
            "pageTitle" => 'Role',
            "dataAdmin" => $this->dataAdmin,
            "dataModul" => $this->dataModul,
            "modulcek" => $this->dataModulcek
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/role', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("role");
        $this->datatables->setColumn([
            '<index>',
            '<get-title>',
            '<div class="privilege-box">[privileges=<get-id>]</div>',
            '<div class="text-center">
                <button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-title="<get-title>"><i class="fa fa-edit"></i></button>
                [only_master=<get-id>]
            </div>'
        ]);
        $this->datatables->setOrdering(["id", "title", NULL]);
        $this->datatables->setSearchField(["title"]);
        $this->datatables->generate();

    }

    function insert()
    {
        $this->process();
    }

    function insert_privilege()
    {
        $this->process_privilege();
    }

    function update($id)
    {
        $this->process("edit", $id);
    }

    private function process($action = "add", $id = 0)
    {

        $title = $this->input->post("title");

        if (!$title) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {

            $insertData = [
                "id" => NULL,
                "title" => $title,
                "created_by" => $this->dataAdmin->id,
            ];

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->role_model->post($insertData);
            } else {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->role_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    private function process_privilege()
    {

        $moduls = $this->input->post("moduls");
        $role = $this->input->post("role");
        $idr = $this->input->post("idr");

        $this->hakakses_model->delete_role($idr);

        $temp = count($moduls);

        $insertData = array();

        for ($i = 0; $i < $temp; $i++) {
            $insertData[] = array(
                "id" => NULL,
                "role" => $role[$i],
                "moduls" => $moduls[$i],
                "created_by" => $this->dataAdmin->id,
            );
        }

        $this->hakakses_model->hakakses_batch($insertData);

        $response['status'] = TRUE;
        $response['msg'] = "Data berhasil ditambahkan";

        echo json_encode($response);

    }


    function delete($id)
    {
        $response = '';
        $this->role_model->delete($id);
        if (!$this->role_model->find($id)) {
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