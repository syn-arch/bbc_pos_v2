<?php 

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {

        $role_id = $ci->session->userdata('role');
        $menu_id = $ci->db->get_where('menu', ['nm_menu' => $ci->uri->segment(1) ])->row_array()['id'];

        $userAccess = $ci->db->get_where('akses_menu', [
            'id_role' => $role_id,
            'id_menu' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            show_404();
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('id_role', $role_id);
    $ci->db->where('id_menu', $menu_id);
    $result = $ci->db->get('akses_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function cek_submenu($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('id_role', $role_id);
    $ci->db->where('id_submenu', $menu_id);
    $result = $ci->db->get('akses_submenu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function auto_id($tbl, $col, $str)
{
    $CI =& get_instance();

    $kode = $CI->db->query("SELECT MAX($col) AS max FROM $tbl")->row_array()['max'];

    $no_urut = (int) substr($kode, 4,3);
    $no_urut++;

    return $str . sprintf("%04s", $no_urut);
}
