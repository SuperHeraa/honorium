<?php

function is_logged_in()
{
    //cek user harus login dulu
    $ci = get_instance(); // memanggil instance ci
    if (!$ci->session->userdata('hak_akses')) {
        redirect('welcome');
    }
}

// user tidak boleh masuk ke halaman admin
function block_users()
{
    $ci = get_instance(); // memanggil instance ci
    if ($ci->session->userdata('hak_akses') != 1) {
        redirect('welcome/blocked');
    }
}

// admin tidak boleh masuk ke halaman user
function block_admin()
{
    $ci = get_instance(); // memanggil instance ci
    if ($ci->session->userdata('hak_akses') != 2) {
        redirect('welcome/blocked');
    }
}
