<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class='mt-2'>Detail Mahasiswa</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $mahasiswa['foto']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-title"><b>Nama : </b><?= $mahasiswa['namamhs']; ?></p>
                            <p class="card-text"><b>NIM : </b><?= $mahasiswa['nim']; ?></p>
                            <p class="card-text"><b>Jenis Kelamin : </b><?= $mahasiswa['jk']; ?></p>
                            <p class="card-text"><b>Alamat : </b><?= $mahasiswa['alamat']; ?></p>
                            <p class="card-text"><b>Kota : </b><?= $mahasiswa['kota']; ?></p>
                            <p class="card-text"><b>Email : </b><?= $mahasiswa['email']; ?></p>
                            <form action="/mahasiswa/<?= $mahasiswa['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')" ;>Delete</button>
                            </form>
                            <br> <br>
                            <a href="/mahasiswa" class="card-link" style="text-decoration: none;">Kembali ke daftar mahasiswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>