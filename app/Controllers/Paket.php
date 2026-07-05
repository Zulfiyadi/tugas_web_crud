<?php

namespace App\Controllers;

use App\Models\PaketLayanan;

class Paket extends BaseController
{
    protected $paketModel;

    public function __construct()
    {
        $this->paketModel = new PaketLayanan();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'paket' => $this->paketModel->findAll(),
        ];
        return $this->view('paket/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->is('post')) {
            $data = [
                'nama_paket' => $this->request->getPost('nama_paket'),
                'harga'      => $this->request->getPost('harga'),
                'estimasi'   => $this->request->getPost('estimasi'),
                'deskripsi'  => $this->request->getPost('deskripsi'),
            ];

            if ($this->paketModel->insert($data)) {
                return redirect()->to('/paket')->with('success', 'Paket berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan paket!');
            }
        }

        return $this->view('paket/create');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $paket = $this->paketModel->find($id);

        if (!$paket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->is('post')) {
            $data = [
                'nama_paket' => $this->request->getPost('nama_paket'),
                'harga'      => $this->request->getPost('harga'),
                'estimasi'   => $this->request->getPost('estimasi'),
                'deskripsi'  => $this->request->getPost('deskripsi'),
            ];

            if ($this->paketModel->update($id, $data)) {
                return redirect()->to('/paket')->with('success', 'Paket berhasil diperbarui!');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui paket!');
            }
        }

        $data = [
            'paket' => $paket,
        ];

        return $this->view('paket/edit', $data);
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        if ($this->paketModel->delete($id)) {
            return redirect()->to('/paket')->with('success', 'Paket berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus paket!');
        }
    }

    public function exportPdf()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'paket' => $this->paketModel->findAll(),
            'title' => 'Daftar Paket Layanan Laundry'
        ];

        $html = view('paket/pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('daftar_paket_laundry.pdf', ['Attachment' => 1]);
    }
}
