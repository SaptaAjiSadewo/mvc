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
