<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'tbl_mhs';
    protected $useTimestamps = true;
    protected $allowedFields = ['namamhs', 'nim', 'jk', 'alamat', 'kota', 'email',  'foto'];

    public function getMahasiswa()
    {
        return $this->findAll();
    }
    public function getMahasiswaById($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
