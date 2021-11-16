<?php

namespace App\Controllers;

//kelas komikModel
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {

        $data = [
            'judul' => 'Data Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->getMahasiswa(),
            'active' => 'mahasiswa'
        ];

        return view('mahasiswa/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->getMahasiswaById($id),
            'active' => 'mahasiswa'
        ];

        // jika mahasiswa tidak ada di tabel
        if (empty($data['mahasiswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Mahasiswa tidak ditemukan.');
        }

        return view('mahasiswa/detail', $data);
    }

    public function create()
    {
        //session();
        $data = [
            'judul' => 'Form Tambah Data Mahasiswa',
            'validation' => \Config\Services::validation(),
            'active' => 'mahasiswa'
        ];

        return view('mahasiswa/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nim' => [
                'rules' => 'required|is_unique[tbl_mhs.nim]',
                'errors' => [
                    'required' => '{field} nim harus diisi.',
                    'is_unique' => '{field} nim sudah terdaftar.'
                ]
            ],
            'namamhs' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi.',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar, max. 2 MB.',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/mahasiswa/create')->withInput();
        }

        // Ambil gambar
        $fileFoto = $this->request->getFile('foto');
        // Apakah tidak ada gambar yang diupload
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.jpeg';
        } else {
            // Generate nama sampul random
            $namaFoto = $fileFoto->getRandomName();
            // Pindahlan file ke folder img
            $fileFoto->move('img', $namaFoto);
        }

        $this->mahasiswaModel->save([
            'nim' => $this->request->getVar('nim'),
            'namamhs' => $this->request->getVar('namamhs'),
            'jk' => $this->request->getVar('jk'),
            'alamat' => $this->request->getVar('alamat'),
            'kota' => $this->request->getVar('kota'),
            'email' => $this->request->getVar('email'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/mahasiswa');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $mahasiswa = $this->mahasiswaModel->find($id);

        // cek jika file gambarnya default.jpeg
        if ($mahasiswa['foto'] != 'default.jpeg') {
            // hapus gambar
            unlink('img/' . $mahasiswa['foto']);
        }

        $this->mahasiswaModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/mahasiswa');
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Form Ubah Data Mahasiswa',
            'validation' => \Config\Services::validation(),
            'mahasiswa' => $this->mahasiswaModel->getMahasiswaById($id),
            'active' => 'mahasiswa'
        ];

        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nim' => [
                'rules' => 'required|is_unique[tbl_mhs.nim, id, ' . $id . ']',
                'errors' => [
                    'required' => '{field} nim harus diisi.',
                    'is_unique' => '{field} nim sudah terdaftar.'
                ]
            ],
            'namamhs' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi.',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar, max. 2 MB.',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/mahasiswa/edit/' . $id)->withInput();
        }
        // Ambil gambar
        $fileFoto = $this->request->getFile('foto');
        // Apakah tidak ada gambar yang diupload
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            // Generate nama foto random
            $namaFoto = $fileFoto->getRandomName();
            // Pindahlan file ke folder img
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $this->mahasiswaModel->save([
            'id' => $id,
            'nim' => $this->request->getVar('nim'),
            'namamhs' => $this->request->getVar('namamhs'),
            'jk' => $this->request->getVar('jk'),
            'alamat' => $this->request->getVar('alamat'),
            'kota' => $this->request->getVar('kota'),
            'email' => $this->request->getVar('email'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/mahasiswa');
    }
}
