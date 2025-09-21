<?php

class About{
    public function index($nama = 'Sapta', $pekerjaan = 'Gamer'){
        echo "Halo saya $nama, saya adalah $pekerjaan";
    }
    public function page(){
        echo 'about/page';
    }   
}