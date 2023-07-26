<?php


function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka);
    return $hasil_rupiah;
}

function reformat_date($date)
{
    if ($date == '') {
        return $date;
    } else {
        $newdate = strtotime($date);
        return date("d-m-Y", $newdate);
    }
}

function reformat_year($date)
{
    if ($date == '') {
        return $date;
    } else {
        $newdate = strtotime($date);
        return date("Y", $newdate);
    }
}

function getyear()
{
    return date("Y");
}

function default_pic($photo)
{
    if ($photo == '') {
        return 'default.png';
    } else {
        return $photo;
    }
}

function default_doc($doc)
{
    if ($doc == '') {
        return 'No Data';
    } else {
        $html = '<a class="links" href="' . base_url() . "" . $doc . '" target="_blank"></a>';
        return $html;
    }
}

function math($ma)
{
    if (preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $ma, $matches) !== FALSE) {
        $operator = $matches[2];

        switch ($operator) {
            case '+':
                $p = $matches[1] + $matches[3];
                break;
            case '-':
                $p = $matches[1] - $matches[3];
                break;
            case '*':
                $p = $matches[1] * $matches[3];
                break;
            case '/':
                $p = $matches[1] / $matches[3];
                break;
        }

        return rupiah($p);
    }
}

function template()
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT judul FROM templates where aktif='Y'");
    $tmp = $query->row_array();
    if ($query->num_rows() >= 1) {
        return $tmp['judul'];
    } else {
        return 'errors';
    }
}

function convertToText($filename)
{

    $fileArray = pathinfo($filename);
    $file_ext = $fileArray['extension'];
    if ($file_ext == "doc") {
        $fileHandle = fopen($filename, "r");
        $line = @fread($fileHandle, filesize($filename));
        $lines = explode(chr(0x0D), $line);
        $outtext = "";
        foreach ($lines as $thisline) {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE) || (strlen($thisline) == 0)) {
            } else {
                $outtext .= $thisline . " ";
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);
        return $outtext;
    } else {
        return "Invalid File Type";
    }
}

function get_role($role)
{
    $CI =& get_instance();
    $query = $CI->db->where('id', $role)->get('role')->row();
    return $query->title;
}

function only_master($role)
{
    $CI =& get_instance();
    $CI->load->library('session');
    $session = $CI->session->userdata('role');
    if ($session == 1) {
        if ($role == 1) {
            return '';
        }
    } else {
        if ($role == 1) {
            return '';
        } else {
            return '<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="'.$role.'" data-title="<get-title>" ><i class="fa fa-trash"></i></button>';
        }
    }
}

function only_masteruser($id)
{
    $CI =& get_instance();
    $CI->load->library('session');
    $session = $CI->session->userdata('role');
    $role = $CI->db->query("SELECT * FROM users WHERE id='" . $id . "'")->row();
    if ($session == 1) {
        if ($role->role == 1) {
            return '';
        } else {
            return '<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="'.$id.'" data-title="<get-title>" ><i class="fa fa-trash"></i></button>';
        }
    } else {
        if ($role->role == 1) {
            return '';
        } else {
            return '<button type="button" class="btn btn-danger btn-sm btn-delete" data-id="'.$id.'" data-title="<get-title>" ><i class="fa fa-trash"></i></button>';
        }
    }
}

function party_name($id){
    $CI =& get_instance();
    $query = $CI->db->query("SELECT name FROM partai WHERE id='" . $id . "'")->row();
    return $query->name;    
}

function get_answers($id){
    $CI =& get_instance();
    $jawaban =  $CI->db->query("SELECT * FROM jawaban WHERE question='" . $id . "'");
    $pertanyaan = $CI->db->query("SELECT * FROM pertanyaan");
    $options = '';

    foreach ($jawaban->result() as $j){
        $options .= "<option value='" . $j->title . "' selected >" . $j->title . "</option>";
    }

    return '<select name="question-' . $id . '" autocomplete="new-question" class="form-control js-select2-multiple-tags"
            multiple="multiple" id="question-' . $id . '">'.$options.'</select>';
}

function privileges($id)
{
    $CI =& get_instance();
    $query = $CI->db->query("SELECT hak_akses.moduls AS modulhak,moduls.title AS modulname,moduls.id AS modulid FROM hak_akses JOIN moduls ON hak_akses.moduls = moduls.id where hak_akses.role='" . $id . "'");
    $tmp = $query->result();
    $moduls = $CI->db->query("SELECT * FROM moduls");
    $options = '';
    $hak = array();

    foreach ($query->result() as $q) {
        array_push($hak, $q->modulhak);
    }

    if ($id == 1) {
        return '<b>Full Access</b>';
    } else {
        foreach ($moduls->result() as $m) {
            $selected = (in_array($m->id, $hak)) ? 'selected' : '';
            $options .= "<option value='" . $m->id . "' " . $selected . ">" . $m->title . "</option>";
        }

        return '<select name="moduls-' . $id . '" autocomplete="new-moduls" class="form-control js-select2-multiple"
            multiple="multiple" id="moduls-' . $id . '">' . $options . '</select>';
    }

}