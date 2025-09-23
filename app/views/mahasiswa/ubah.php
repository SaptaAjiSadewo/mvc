<div class="container">

    <div class="row mt-3">
        <div class="col-6">
            <?php echo Flasher::Flash() ?>
        </div>
    </div>
    
    <h3 class="mt-3">Ubah Data Mahasiswa</h3>
    <form action="<?php echo BASEURL; ?>/mahasiswa/update" method="post">
        <input type="hidden" name="id" value="<?php echo $data['mhs']['id']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['mhs']['nama']; ?>">
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">Nim</label>
            <input type="number" class="form-control" id="nim" name="nim" value="<?php echo $data['mhs']['nim']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['mhs']['email']; ?>">
        </div>
        <label for="jurusan">Jurusan</label>
        <select class="form-select" id="jurusan" name="jurusan">
            <option value="Teknik Informatika" <?php if($data['mhs']['jurusan']=='Teknik Informatika') echo 'selected'; ?>>Teknik Informatika</option>
            <option value="Teknik Industri" <?php if($data['mhs']['jurusan']=='Teknik Industri') echo 'selected'; ?>>Teknik Industri</option>
            <option value="Teknik Mesin" <?php if($data['mhs']['jurusan']=='Teknik Mesin') echo 'selected'; ?>>Teknik Mesin</option>
            <option value="Teknik Pendingin dan Tata Udara" <?php if($data['mhs']['jurusan']=='Teknik Pendingin dan Tata Udara') echo 'selected'; ?>>Teknik Pendingin dan Tata Udara</option>
        </select>
        <br>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?php echo BASEURL; ?>/mahasiswa" class="btn btn-secondary">Batal</a>
    </form>
</div>
