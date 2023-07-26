<?php

class Hakakses_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("hak_akses", $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("id", $where);
        } else {
            return $this->db->get("hak_akses");
        }
    }

    function hakakses_batch($data)
    {
        $this->db->insert_batch('hak_akses', $data);
    }

    function get_total()
    {
        $query = $this->db->get('hak_akses');
        return $query->num_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('hak_akses');

        if ($result->num_rows() > 0)
            return $result->row();
        else
            return array();
    }

    public function find_role($role)
    {
        $result = $this->db->where('role', $role)->get('hak_akses');

        if ($result->num_rows() > 0)
            return $result->row();
        else
            return array();
    }

    public function find_moduls($role)
    {
        $result = $this->db->where('role', $role)->order_by('moduls','asc')->get('hak_akses');

        if ($result->num_rows() > 0)
            return $result->result();
        else
            return array();
    }

    public function find_hakakses($role,$moduls)
    {
        $array = array('role =' => $role, 'moduls =' => $moduls);
        $result = $this->db->where($array)
            ->limit(1)
            ->get('hak_akses');

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    function put($id, $hak_akses)
    {
        $this->db->where("id", $id);
        $this->db->update("hak_akses", $hak_akses);
    }

    function delete($id)
    {
        $this->db->delete("hak_akses", ["id" => $id]);
    }

    function delete_role($role)
    {
        $this->db->delete("hak_akses", ["role" => $role]);
    }
}