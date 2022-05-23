<?php

function role($status)

{
    if ($status == "1") {

        echo "fas fa-cog";
    } else if ($status == "2") {
        echo "fas fa-user-tie";
    } else if ($status == "3") {
        echo "fas fa-wrench";
    }
}

function stock($status)

{
    if ($status == "1") {

        echo "fas fa-cog";
    } else if ($status == "2") {
        echo "fas fa-user-tie";
    } else if ($status == "3") {
        echo "fas fa-wrench";
    }
}

function format_hari_tanggal($waktu)

{

    // Senin, Selasa dst.

    $hari_array = array(

        'Minggu',

        'Senin',

        'Selasa',

        'Rabu',

        'Kamis',

        'Jumat',

        'Sabtu'

    );

    $hr = date('w', strtotime($waktu));

    $hari = $hari_array[$hr];
    // Tanggal: 1-31 dst, tanpa leading zero.

    $tanggal = date('j', strtotime($waktu));



    // Bulan: Januari, Maret dst.

    $bulan_array = array(

        1 => 'Januari',

        2 => 'Februari',

        3 => 'Maret',

        4 => 'April',

        5 => 'Mei',

        6 => 'Juni',

        7 => 'Juli',

        8 => 'Agustus',

        9 => 'September',

        10 => 'Oktober',

        11 => 'November',

        12 => 'Desember',

    );

    $bl = date('n', strtotime($waktu));

    $bulan = $bulan_array[$bl];


    // Tahun, 4 digit.

    $tahun = date('Y', strtotime($waktu));

    //$jam = time('Y', strtotime($waktu));


    // Hasil akhir: Senin, 1 Oktober 2014

    return "$hari, $tanggal $bulan $tahun";
}

function check_access($role_id, $menu_id)
{
    $CI = get_instance();
    $result = $CI->db->get_where('tb_user_access_menu', ['menu_id' => $menu_id, 'role_id' => $role_id]);
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_access_crud($role_id ="", $menu_id="", $create="", $read="", $update="", $delete="")
{
    $CI = get_instance();
    $result = $CI->db->get_where('tb_user_access_menu', ['menu_id' => $menu_id, 'role_id' => $role_id]);

    if ($result->num_rows() > 0) {

        $H = "";
        $H .= " <div class='form-inline form-group'>";
        $H .= " <div class='form-check form-check-inline'>";
        $H .= " <input class='form-check-input' type='checkbox' id='create$menu_id' $create>";
        $H .= " <label class='form-check-label'>Create</label>";
        $H .= " </div>";
        $H .= " <div class='form-check form-check-inline'>";
        $H .= " <input class='form-check-input' type='checkbox' id='read$menu_id' $read>";
        $H .= " <label class='form-check-label'>read</label>";
        $H .= " </div>";
        $H .= " <div class='form-check form-check-inline'>";
        $H .= " <input class='form-check-input' type='checkbox' id='update$menu_id' $update>";
        $H .= " <label class='form-check-label'>update</label>";
        $H .= " </div>";
        $H .= " <div class='form-check form-check-inline'>";
        $H .= " <input class='form-check-input' type='checkbox' id='delete$menu_id' $delete>";
        $H .= " <label class='form-check-label'>delete</label>";
        $H .= " </div>";
        $H .= " <button class='Aaccess btn btn-icon btn-sm btn-success' onclick='saveAsNewName(" . $menu_id .")'  type='button'><i class='fas fa-save'></i> Save</button>";
        $H .= " </div>";

        return $H;                                          
    } else {
        return "";
    }
}

function status_stock($stock)
{
    if ($stock <= '10') {
        return "<span class='beep ml-4'></span>";
    }
}

function encode($param)
{
    $CI = get_instance();
    $encrypt  = $CI->encryption->encrypt($param);

    return  str_replace(array('/'), array('~'), $encrypt);
}

function decode($param)
{
    $CI = get_instance();
    $decrypt = str_replace(array('~'), array('/'), $param);
   
    return  $CI->encryption->decrypt($decrypt);
}

function is_logged_in()
{
    $CI = &get_instance();

    if (empty($CI->session->has_userdata('email'))) {
        redirect('auth');
    } else {

        $role_id = decode($CI->session->userdata('role_id'));
        $field_url = $CI->uri->segment('1');
        $subMenu = $CI->db->like('field_url', $field_url, 'both')->get('tb_user_sub_menu')->row_array();
        $menu_id = $subMenu['menu_id'];

        $userAccess = $CI->db->get_where('tb_user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ])->row_array();

        if (empty($userAccess)) {
            redirect('404');
          
        }
    }
}

function stislaButtonMedium($pesan = "", $color = "default", $attr = "", $href = "")
{
    /* default, primary, success, info, warning, danger, dark, link */
    $color = $color == "error" ? "danger" : $color;
    if (empty($href))
        return "<button type='button' class='btn btn-$color' $attr >$pesan</button>";
    return "<a type='button' class='btn btn-$color' $attr href='$href' target='_blank' >$pesan</a>";
}

function stislaInputTextOnly($placeholder = "", $name = "", $value = '', $readonly = FALSE, $attr = "")
{
    $readonly = $readonly ? 'readonly' : '';
    return "<input name='$name' value='$value' $readonly $attr placeholder='$placeholder' class='form-control' type='text'>";
}

function stislaFromDropdownOnly($name = "", $D, $value = "", $tampil = '', $selected = FALSE, $readonly = FALSE, $function = "", $attr = "")
{
    $readonly = $readonly === TRUE ? "readonly disabled" : "";
    $unix = date('YmdHis') . rand(0, 100) . rand(0, 100);
    $H = "";
    $H .= " <div formInput class='col-sm-12'>";
    $H .= "   <select name='$name' class='form-control' id='form-field-select-s{$unix}' placeholder='Pilih ...' $readonly tabindex='2' data-placeholder='Pilih' {$attr}>";
    $H .= "     <option value=''>  </option>";
    $tampil = explode("|", $tampil);
    if (is_array($D)) {
        foreach ($D as $nn => $V) {
            if (count($tampil) <= 1) {
                $VV = $V[$tampil[0]];
            } else {
                $VV = "";
                for ($i = 0; $i < count($tampil); $i++) {
                    if ($i < count($tampil) - 1) {
                        $VV .= $V[$tampil[$i]] . " ~ ";
                    } else {
                        $VV .= $V[$tampil[$i]];
                    }
                }
            }
            $attrU = is_object($function) ? $function($nn, $V) : "";
            if ($selected !== FALSE and $selected !== NULL and $V[$value] == $selected) {
                $H .= "<option $attrU value='" . $V[$value] . "' selected >" . $VV . "</option>";
            } else {
                $H .= "<option $attrU value='" . $V[$value] . "'>" . $VV . "</option>";
            }
        }
    } else {
        $H .= "<option value=''> -- Data tidak sesuai -- </option>";
    }
    $H .= "   </select>";
    $H .= " </div>";
    $H .= "<div class='clearfix' ></div>";
    return $H;
}
