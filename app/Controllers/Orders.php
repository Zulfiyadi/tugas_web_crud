<?php

namespace App\Controllers;

use App\Libraries\Cart;
use App\Models\Order;
use App\Models\PaketLayanan;

class Orders extends BaseController
{
    protected $orderModel;
    protected $paketModel;
    protected $cart;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->paketModel = new PaketLayanan();
        $this->cart = new Cart();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'orders' => $this->orderModel->findAll(),
            'cartItems' => $this->cart->contents(),
            'cartTotal' => $this->cart->total(),
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

    public function addToCart()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->is('post')) {
            $paket = $this->paketModel->find($this->request->getPost('id_paket'));

            if (!$paket) {
                return redirect()->back()->with('error', 'Paket tidak ditemukan.');
            }

            $item = [
                'id' => $paket['id_paket'],
                'qty' => (int) $this->request->getPost('qty'),
                'price' => (float) $paket['harga'],
                'name' => $paket['nama_paket'],
                'options' => [
                    'estimasi' => $paket['estimasi'],
                ],
            ];

            $this->cart->insert($item);
            return redirect()->to('/orders')->with('success', 'Item ditambahkan ke keranjang.');
        }

        return redirect()->to('/orders');
    }

    public function updateCart()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->is('post')) {
            $rowid = $this->request->getPost('rowid');
            $qty = $this->request->getPost('qty');

            if ($rowid && $qty !== null) {
                $this->cart->update($rowid, ['qty' => $qty]);
            }
        }

        return redirect()->to('/orders');
    }

    public function removeFromCart()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->is('post')) {
            $rowid = $this->request->getPost('rowid');
            if ($rowid) {
                $this->cart->remove($rowid);
            }
        }

        return redirect()->to('/orders');
    }

    public function destroyCart()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $this->cart->destroy();
        return redirect()->to('/orders')->with('success', 'Keranjang berhasil dikosongkan.');
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
