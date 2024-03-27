<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelBuku'); // Load model ModelBuku
        $this->load->model('ModelUser'); // Load model ModelUser
    }

    public function index()
    {
        $data = [
            'judul' => "Katalog Buku",
            'buku' => $this->ModelBuku->getBuku()->result(),
        ];

        // Cek apakah sudah login atau belum
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['user'] = $user['nama'];
        } else {
            $data['user'] = 'Pengunjung';
        }

        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('buku/daftarbuku', $data);
        $this->load->view('templates/templates-user/footer', $data);
    }
}