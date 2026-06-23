<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\PaketLayanan;

class Orders extends BaseController
{
    protected $orderModel;
    protected $paketModel;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->paketModel = new PaketLayanan();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'orders' => $this->orderModel->findAll(),
        ];
        return $this->view('orders/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->is('post')) {
            $harga       = $this->paketModel->find($this->request->getPost('id_paket'))['harga'] ?? 0;
            $berat       = $this->request->getPost('berat');
            $total_harga = $harga * $berat;

            $data = [
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'no_hp'          => $this->request->getPost('no_hp'),
                'id_paket'       => $this->request->getPost('id_paket'),
                'berat'          => $berat,
                'total_harga'    => $total_harga,
                'tanggal_masuk'  => $this->request->getPost('tanggal_masuk'),
                'status'         => 'Proses',
            ];

            if ($this->orderModel->insert($data)) {
                return redirect()->to('/orders')->with('success', 'Order berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan order!');
            }
        }

        $data = [
            'paket' => $this->paketModel->findAll(),
        ];

        return $this->view('orders/create', $data);
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $order = $this->orderModel->find($id);

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('post')) {
            $harga       = $this->paketModel->find($this->request->getPost('id_paket'))['harga'] ?? 0;
            $berat       = $this->request->getPost('berat');
            $total_harga = $harga * $berat;

            $data = [
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'no_hp'          => $this->request->getPost('no_hp'),
                'id_paket'       => $this->request->getPost('id_paket'),
                'berat'          => $berat,
                'total_harga'    => $total_harga,
                'tanggal_masuk'  => $this->request->getPost('tanggal_masuk'),
                'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
                'status'         => $this->request->getPost('status'),
            ];

            if ($this->orderModel->update($id, $data)) {
                return redirect()->to('/orders')->with('success', 'Order berhasil diperbarui!');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui order!');
            }
        }

        $data = [
            'order' => $order,
            'paket' => $this->paketModel->findAll(),
        ];

        return $this->view('orders/edit', $data);
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->orderModel->delete($id)) {
            return redirect()->to('/orders')->with('success', 'Order berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus order!');
        }
    }
}
