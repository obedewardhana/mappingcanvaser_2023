<?php

class Candidate_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("kandidat", $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("kandidat", $where);
        } else {
            return $this->db->get("kandidat");
        }
    }

    function get_party($where = array())
    {
        if ($where) {
            return $this->db->get_where("partai", $where);
        } else {
            return $this->db->get("partai");
        }
    }

    function get_total()
    {
        $query = $this->db->get('kandidat');
        return $query->num_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('kandidat');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("kandidat", $data);
    }

    function delete($id)
    {
        $this->db->delete("kandidat", ["id" => $id]);
    }
}
