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
    
 

