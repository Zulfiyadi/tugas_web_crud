<?php

namespace App\Controllers;

use App\Models\PaketLayanan;
use App\Models\Order;

class Home extends BaseController
{
    protected $paketModel;
    protected $orderModel;

    public function __construct()
    {
        $this->paketModel = new PaketLayanan();
        $this->orderModel = new Order();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'total_paket'  => count($this->paketModel->findAll()),
            'total_order'  => count($this->orderModel->findAll()),
            'paket'        => $this->paketModel->limit(5)->findAll(),
            'orders'       => $this->orderModel->limit(5)->findAll(),
        ];
        return $this->view('home/index', $data);
    }

    public function kontak()
    {
        $data = [
            'nama_laundry'     => 'Laundry.In',
            'alamat'           => 'jalan nasional semarang',
            'no_telepon'       => '08226282245',
            'email'            => 'laundryin@gmail.com',
            'jam_operasional'  => 'Senin - Minggu: 08:00 - 20:00',
        ];
        return $this->view('home/kontak', $data);
    }
}
