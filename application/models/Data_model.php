<?php

class Data_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("data", $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("data", $where);
        } else {
            return $this->db->get("data");
        }
    }

    function get_total()
    {
        $query = $this->db->get('data');
        return $query->num_rows();
    }

    function get_kesehatan(){
        $query = $this->db->get('data');
        return $query->result_array();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('data');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("data", $data);
    }

    function delete($id)
    {
        $this->db->delete("data", ["id" => $id]);
    }
}
