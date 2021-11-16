<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8">
            <a href="/mahasiswa/create" class="btn btn-primary mt-3 mb-3">Tambah Data Mahasiswa</a>
            <!-- <h2 class="mt-2 mb-3">Daftar Mahasiswa</h2> -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col" style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $mhs) : ?>
                        <tr>
                            <th scope="row" style="text-align: center"><?= $i++; ?></th>
                            <td><?= $mhs['nim'] ?></td>
                            <td><?= $mhs['namamhs'] ?></td>
                            <td><img src="/img/<?= $mhs['foto'] ?>" alt="" class="foto"></td>
                            <td style="text-align: center">
                                <form action="/mahasiswa/<?= $mhs['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="badge badge-danger float-right ml-1" onclick="return confirm('Apakah anda yakin?')" ;>Hapus</button>
                                </form>
                                <a href="/mahasiswa/edit/<?= $mhs['id']; ?>" class="badge badge-success float-right ml-1"> Ubah </a>
                                <a href="/mahasiswa/detail/<?= $mhs['id']; ?>" class="badge badge-primary float-right ml-1 mr-1"> Detail </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>



<?= $this->endSection(); ?>