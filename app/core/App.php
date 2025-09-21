<?php

class App
{
    public function __construct()
    {
        $url = $this->ParseURL();
        var_dump($url);
    }

    #Bertugas untuk mengambil url lalu memecah sesuai dengan keinginan kita
    public function ParseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}

