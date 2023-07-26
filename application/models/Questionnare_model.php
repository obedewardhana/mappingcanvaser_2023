<?php

class Questionnare_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("pertanyaan", $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("pertanyaan", $where);
        } else {
            return $this->db->get("pertanyaan");
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

    function question_batch($data)
    {
        $this->db->insert_batch('pertanyaan', $data);
    }
    function answer_batch($data)
    {
        $this->db->insert_batch('jawaban', $data);
    }


    function get_total()
    {
        $query = $this->db->get('pertanyaan');
        return $query->num_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('pertanyaan');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("pertanyaan", $data);
    }

    function delete($id)
    {
        $this->db->delete("pertanyaan", ["id" => $id]);
        $this->db->delete("jawaban", ["question" => $id]);
    }

    function delete_answer($question)
    {
        $this->db->delete("jawaban", ["question" => $question]);
    }
}
