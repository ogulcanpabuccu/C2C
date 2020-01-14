<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=c2c;charset=utf8", 'root', '759486as');

    //echo "Veritabanı bağlantısı tamamlandı.";
} catch (PDOException $e) {
    echo $e->getMessage();
}
