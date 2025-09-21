<div class="container">
    <div class="row">
        <div class="col-6">
            <h3 class="mt-5">Daftar Mahasiswa</h3>
            <?php foreach ($data['mhs'] as $mhs) : ?>
            <ul>
                <li><?php echo $mhs['nama']?></li>
                <li><?php echo $mhs['nim']?></li>
                <li><?php echo $mhs['email']?></li>
                <li><?php echo $mhs['jurusan']?></li>
            </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>