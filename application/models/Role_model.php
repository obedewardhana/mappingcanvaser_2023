<?php

class Role_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("role", $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("id", $where);
        } else {
            return $this->db->get("role");
        }
    }

    function get_exclude()
    {
        return $this->db->where('id !=', 1)->get("role");
    }


    function get_total()
    {
        $query = $this->db->get('role');
        return $query->num_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('role');

        if ($result->num_rows() > 0)
            return $result->row();
        else
            return array();
    }

    function put($id, $role)
    {
        $this->db->where("id", $id);
        $this->db->update("role", $role);
    }

    function delete($id)
    {
        $this->db->delete("role", ["id" => $id]);
        $this->db->delete("hak_akses", ["role" => $id]);
    }
}