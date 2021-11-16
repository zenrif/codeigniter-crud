<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Form Ubah Data Komik</h2>
            <form action="/mahasiswa/update/<?= $mahasiswa['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $mahasiswa['foto']; ?>">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <!-- Operasi ternary : if dan else dalam satu baris -->
                        <input type="text" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : ''; ?>" id="nim" name="nim" autofocus value="<?= (old('nim')) ? old('nim') : $mahasiswa['nim']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nim'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namamhs" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('namamhs')) ? 'is-invalid' : ''; ?>" id="namamhs" name="namamhs" autofocus value="<?= (old('namamhs')) ? old('namamhs') : $mahasiswa['namamhs']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('namamhs'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="jk" name="jk">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $mahasiswa['alamat']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kota" name="kota" value="<?= (old('kota')) ? old('kota') : $mahasiswa['kota']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= (old('email')) ? old('email') : $mahasiswa['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $mahasiswa['foto'] ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('foto'); ?>
                            </div>
                            <label class="custom-file-label" for="Foto"><?= $mahasiswa['foto'] ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>