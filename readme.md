1. Public
File yang bisa diakses oleh user
    1. folder css
    2. folder js
    3. folder image

2. Folder app
Menyimpan folder dan file utama dari aplikasi mvc
    1. folder core = route
    2. folder controllers = 
    3. folder views = 
    4. folder models =

    folder views
        1. 

3. index.php

pengecekan url
http://localhost/mvc/public/index.php?url=2121

di http://localhost/mvc/public/

database : http://localhost/phpmyadmin/


```plaintext
project/
│
├── app/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   ├── RegisterController.php
│   │   │   └── LogoutController.php
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   └── UserController.php
│   │   └── Frontend/
│   │       ├── HomeController.php
│   │       └── ArticleController.php
│   │
│   ├── Models/
│   │   ├── Entities/
│   │   │   ├── User.php
│   │   │   └── Article.php
│   │   ├── Repositories/
│   │   │   ├── UserRepository.php
│   │   │   └── ArticleRepository.php
│   │   └── Database.php
│   │
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── admin/
│   │   │   ├── dashboard.php
│   │   │   └── users.php
│   │   └── frontend/
│   │       ├── home.php
│   │       └── article.php
│   │
│   └── Helpers/
│       ├── SessionHelper.php
│       └── FormHelper.php
│
├── config/
│   ├── database.php
│   ├── app.php
│   └── routes.php
│
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── index.php
│
├── storage/
│   ├── cache/
│   ├── logs/
│   └── uploads/
│
├── vendor/                # composer packages
└── index.php              # Entry point

```

1 controller punya 1 folder sendiri


1. Workflow Model
Masuk ke folder app/controllers lalu file Home.php
Lalu buat statement :
        $data['nama'] = $this->model('User_model')->getUser();
Dan :
        $this->view('home/index', $data);
Lalu ke folder models buat file User_model.php

Lalu bikin modelnya di folder core lalu ke file Controller.php 

Buat Model baru dengan cara manual:
1. Buat viewnya di dalam folder templates
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASEURL; ?>/mahasiswa">Mahasiswa</a>
        </li>

2. Buat Controller baru di folder app/controllers dengan nama Mahasiswa.php
class Mahasiswa extends Controller
{
    public function index() {
        $data['judul'] = 'Daftar Mahasiswa'; 

        $this->view('templates/header', $data);
        $this->view('mahasiswa/index');
        $this->view('templates/footer');
    }
}

3. Buat folder baru di views dengan nama mahasiswa dan buat file baru index.php
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3>Daftar Mahasiswa</h3>
        </div>
    </div>
</div>

4. Lalu buat Model di folder models buat file baru Mahasiswa_model.php
<?php

class Mahasiswa_model
{
    private $mhs = [
        [
            'nama' => 'Sapta',
            'nim' => '22',
            'email' => 'sap@gmail.com',
            'jurusan' => 'Teknik Informatika',
        ], [
            'nama' => 'Fadil',
            'nim' => '21',
            'email' => 'fad@gmail.com',
            'jurusan' => 'Teknik Informatika',
        ], [
            'nama' => 'Samy',
            'nim' => '20',
            'email' => 'Sam@gmail.com',
            'jurusan' => 'Teknik Informatika',
        ]
    ];

    public function getAllMahasiswa(){
        return $this->mhs;
    }

}

5. Lalu ke controllers Mahasiswa.php buat kirimin data
        $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);

6. Lalu ke Views/mahasiswa dan index.php untuk menggunakan data mhs
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3>Daftar Mahasiswa</h3>
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

Buat Model baru dengan Database:

1. ke folder models lalu file Mahasiswa_mode.php
<?php

class Mahasiswa_model
{
    private $dbh;
    private $stmt;

    public function __construct(){
        #data source name = diisi dengan koneksi ke PDO
        $dsn = 'mysql:host=localhost;dbname=php_mvc';

        try {
            $this->dbh = new PDO($dsn, 'root', '') ;
        } catch (PDOExceptions $e) {
            die('Error koneksi'. $e->getMessage());
        }
    }

    public function getAllMahasiswa(){
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        #dikembalikan sebagai apa?
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

8. Database Wrapper
1. Bikin folder baru di folder app
    Bikin folder config 
        Bikin file config.php yang berisi data-data dari database berupa constanta
2. Lalu cut/pindahkan isi dari Constants.php yang ada di dalam core
    3. Lalu di folder app init.php 
        Lalukan penyesuaian
        require_once 'config/config.php';
 4. Lalu ke config.php
    //DB
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','php_mvc');

5. Lalu membuat file baru di folder core, beri nama Database.php
<?php

class Database
{
    private $host = 'DB_HOST';
    private $user = 'DB_USER';
    private $password = 'DB_PASSWORD';
    private $db_name = 'DB_NAME';
    private $dbh;
    private $stmt;

    public function __construct()
    {
        // data source name = diisi dengan koneksi ke PDO
        $dsn = 'mysql:host=' . $this->host . 'dbname=' . $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $option);
        } catch (PDOExceptions $e) {
            die('Error koneksi' . $e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // binding data
    public function bind($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}

6. buka file init.php

7. Ke folder models di Mahasiswa_model.php
<?php

class Mahasiswa_model
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAllMahasiswa(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

}

8. ke folder views/mahasiswa dan file index.php
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3 class="mt-5">Daftar Mahasiswa</h3>
            <ul class="list-group">
                <?php foreach ($data['mhs'] as $mhs): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center" >
                        <?php echo $mhs['nama'] ?>
                        <a href="<?php echo BASEURL; ?>/mahasiswa/detail/<?php echo $mhs['id']; ?>" class="badge text-bg-primary">detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

9. Ke controlles ke Mahasiswa.php untuk buat method baru
    public function detail($id)
    {

        $data['judul'] = 'Detail Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

10. Lalu ke models ke Mahasiswa_model.php
    public function getMahasiswaById($id){
        $this->db->query('SELECT * FROM '. $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

11. Ke folder controllers Mahasiswa.php   
     $this->view('mahasiswa/detail', $data);

12. Lalu di folder views ke mahasiswa buat file baru detail.php
<div class="container mt-5">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $data['mhs']['nama'] ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $data['mhs']['nim'] ?></h6>
                    <p class="card-text"><?php echo $data['mhs']['email'] ?></p>
                    <p class="card-text"><?php echo $data['mhs']['jurusan'] ?></p>
    <a href="<?php echo BASEURL; ?>/mahasiswa" class="card-link">Kembali</a>
  </div>
</div>

</div>
    

# 9. Menambahkan insert Data

<div class="container">
    <div class="row">
        <div class="col-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#formModal">
                Tambah Data Mahasiswa
            </button>
            <h3 class="mt-3">Daftar Mahasiswa</h3>
            <ul class="list-group">
                <?php foreach ($data['mhs'] as $mhs): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $mhs['nama'] ?>
                        <a href="<?php echo BASEURL; ?>/mahasiswa/detail/<?php echo $mhs['id']; ?>"
                            class="badge text-bg-primary">detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Tambah Data Mahasiswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="<?php echo BASEURL; ?>/mahasiswa/tambah" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">Nim</label>
                        <input type="number" class="form-control" id="nim" name="nim">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <label for="jurusan">Jurusan</label>
                    <select class="form-select" aria-label="Default select example" id="jurusan" name="jurusan">
                        <option selected>Open this select menu</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Pendingin dan Tata Udara">Teknik Pendingin dan Tata Udara</option>
                    </select>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

2. ke folder controllers dan file Mahasiswa.php
    public function tambah(){
        #var_dump($_POST);  
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        } 
    }

 3. Ke folder models lalu file Mahasiswa_model.php

    public function tambahDataMahasiswa($data){
        $query = "INSERT INTO mahasiswa VALUES ('', :nama, :nim, :email, :jurusan)";

        $this->db->query($query);   
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        
        $this->db->execute();

        return $this->db->rowCount();
    }

 4. ke folder core cara Database.php
     public function rowCount(){
        return $this->stmt->rowCount();
    }

# 10 Flash message
1. Di dalam folder core menambahkan class Flaser.php
<?php

class Flasher
{
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function Flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
  Data Mahasiswa <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
            unset($_SESSION['flash']);
        }
    }
}

2. Panggil di file init.php di folder app
require_once 'core/Flasher.php';

3. Ke file index.php paling luar
<?php
if (!session_id()) {
    session_start();
}

4. ke halaman index.php di folder mahasiswa
    <div class="row">
        <div class="col-6">
            <?php echo Flasher::Flash() ?>
        </div>
    </div>

5. ke controllers ke Mahasiswa.php
    public function tambah()
    {

        #var_dump($_POST);  
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }    

