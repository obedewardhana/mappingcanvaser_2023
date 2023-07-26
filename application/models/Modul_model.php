<?php

class Modul_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("moduls", $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("id", $where);
        } else {
            return $this->db->get("moduls");
        }
    }

    function get_total()
    {
        $query = $this->db->get('moduls');
        return $query->num_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('moduls');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function put($id, $moduls)
    {
        $this->db->where("id", $id);
        $this->db->update("moduls", $moduls);
    }

    function delete($id)
    {
        $this->db->delete("moduls", ["id" => $id]);
    }
}
