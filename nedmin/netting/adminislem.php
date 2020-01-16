<?php
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);

require_once 'baglan.php';
require_once '../production/fonksiyon.php';




if (isset($_POST['logoduzenle'])) {

    if ($_FILES['ayar_logo']['size'] > 2097152) {

        header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');

    $ext = strtolower(substr($_FILES['ayar_logo']["name"], strpos($_FILES['ayar_logo']["name"], '.') + 1));
    if (in_array($ext, $izinli_uzantilar) === false) {
        Header("Location:../production/genel-ayar.php?durum=uzantihatali");
        exit;
    }




    $uploads_dir = '../../dimg';

    @$tmp_name = $_FILES['ayar_logo']["tmp_name"];
    @$name = $_FILES['ayar_logo']["name"];

    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");


    $duzenle = $db->prepare("UPDATE ayar SET
         ayar_logo=:logo
            WHERE ayar_id=0");
    $update = $duzenle->execute(array(
        'logo' => $refimgyol
    ));



    if ($update) {

        $resimsilunlink = $_POST['eski_yol'];
        unlink("../../$resimsilunlink");

        Header("Location:../production/genel-ayar.php?durum=ok");
    } else {

        Header("Location:../production/genel-ayar.php?durum=no");
    }
}

//--------------------------------------------------------------------------

if (isset($_POST['adminkullaniciduzenle'])) {

    $kullanici_id = $_POST['kullanici_id'];


    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET

kullanici_ad=:kullanici_ad,
kullanici_soyad=:kullanici_soyad,
kullanici_gsm=:kullanici_gsm,
kullanici_tc=:kullanici_tc,
kullanici_adres=:kullanici_adres,
kullanici_il=:kullanici_il,
kullanici_ilce=:kullanici_ilce,
kullanici_durum=:kullanici_durum

WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $kullaniciguncelle->execute(array(


        'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
        'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
        'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
        'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
        'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
        'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
        'kullanici_durum' => htmlspecialchars($_POST['kullanici_durum'])




    ));

    if ($update) {
        Header("Location:../production/kullanici-duzenle.php?durum=ok&kullanici_id= $kullanici_id");
        exit;
    } else {
        Header("Location:../kullanici-duzenle?durum=no&kullanici_id= $kullanici_id");
        exit;
    }
}

//---------------------------------------------------------------------------------------------


if ($_GET['magazaonay'] == "red") {


    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET


kullanici_magaza=:kullanici_magaza

WHERE kullanici_id={$_GET['kullanici_id']}");

    $update = $kullaniciguncelle->execute(array(


        'kullanici_magaza' => 0

    ));

    if ($update) {
        Header("Location:../production/magazalar.php?durum=ok");
        exit;
    } else {
        Header("Location:../production/magazalar.php?durum=no");
        exit;
    }
}

//--------------------------------------------------------------------------

if (isset($_POST['magazaonaykayit'])) {




    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET

kullanici_ad=:kullanici_ad,
kullanici_soyad=:kullanici_soyad,
kullanici_gsm=:kullanici_gsm,
kullanici_banka=:kullanici_banka,
kullanici_iban=:kullanici_iban,
kullanici_tc=:kullanici_tc,
kullanici_unvan=:kullanici_unvan,
kullanici_vdaire=:kullanici_vdaire,
kullanici_vno=:kullanici_vno,
kullanici_adres=:kullanici_adres,
kullanici_il=:kullanici_il,
kullanici_ilce=:kullanici_ilce,
kullanici_magaza=:kullanici_magaza

WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $kullaniciguncelle->execute(array(


        'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
        'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
        'kullanici_banka' => htmlspecialchars($_POST['kullanici_banka']),
        'kullanici_iban' => htmlspecialchars($_POST['kullanici_iban']),
        'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
        'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
        'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
        'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
        'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
        'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
        'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
        'kullanici_magaza' => 2



    ));

    if ($update) {
        Header("Location:../production/magazalar.php?durum=ok");
        exit;
    } else {
        Header("Location:../production/magazalar.php?durum=no");
        exit;
    }
}

//--------------------------------------------------------------------------



if (isset($_POST['kullaniciresimguncelle'])) {

    if ($_FILES['kullanici_magazafoto']['size'] > 2097152) {

        header("Location:../../profil-resim-guncelle.php?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');

    $ext = strtolower(substr($_FILES['kullanici_magazafoto']["name"], strpos($_FILES['kullanici_magazafoto']["name"], '.') + 1));
    if (in_array($ext, $izinli_uzantilar) === false) {
        Header("Location:../../profil-resim-guncelle.php?durum=formathata");
        exit;
    }
    @$tmp_name = $_FILES['kullanici_magazafoto']["tmp_name"];
    @$name = $_FILES['kullanici_magazafoto']["name"];
    //İmage Resize işlemleri:
    include('SimpleImage.php');
    $image = new SimpleImage();
    $image->load($tmp_name);
    $image->resize(128, 128);
    $image->save($tmp_name);



    $uploads_dir = '../../dimg/userphoto';


    //uniqid(); benzersiz isim oluşturmada daha kullanışlı
    $uniq = uniqid();
    $refimgyol = substr($uploads_dir, 6) . "/" . $uniq . "." . $ext;

    @move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");


    $duzenle = $db->prepare("UPDATE kullanici SET
         kullanici_magazafoto=:kullanici_magazafoto

WHERE kullanici_id={$_SESSION['userkullanici_id']}");

    $update = $duzenle->execute(array(
        'kullanici_magazafoto' => $refimgyol
    ));



    if ($update) {

        $resimsilunlink = $_POST['eski_yol'];
        unlink("../../$resimsilunlink");

        Header("Location:../../profil-resim-guncelle.php?durum=ok");
        exit;
    } else {

        Header("Location:../../profil-resim-guncelle.php?durum=hata");
        exit;
    }
}

//--------------------------Mağaza ürün ekleme------------------------------------------------

if (isset($_POST['magazaurunekle'])) {

    if ($_FILES['urunfoto_resimyol']['size'] > 2097152) {

        header("Location:../../urun-ekle.php?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');

    $ext = strtolower(substr($_FILES['urunfoto_resimyol']["name"], strpos($_FILES['urunfoto_resimyol']["name"], '.') + 1));
    if (in_array($ext, $izinli_uzantilar) === false) {
        Header("Location:../../urun-ekle.php?durum=formathata");
        exit;
    }
    @$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
    @$name = $_FILES['urunfoto_resimyol']["name"];
    //İmage Resize işlemleri:
    include('SimpleImage.php');
    $image = new SimpleImage();
    $image->load($tmp_name);
    $image->resize(829, 422);
    $image->save($tmp_name);



    $uploads_dir = '../../dimg/urunfoto';


    //uniqid(); benzersiz isim oluşturmada daha kullanışlı
    $uniq = uniqid();
    $refimgyol = substr($uploads_dir, 6) . "/" . $uniq . "." . $ext;

    @move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");


    $duzenle = $db->prepare("INSERT INTO urun SET
         kategori_id=:kategori_id,
         kullanici_id=:kullanici_id,
         urun_ad=:urun_ad,
         urun_detay=:urun_detay,
         urun_fiyat=:urun_fiyat,
         urunfoto_resimyol=:urunfoto_resimyol

");

    $update = $duzenle->execute(array(

        'kategori_id' => htmlspecialchars($_POST['kategori_id']),
        'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
        'urun_ad' => htmlspecialchars($_POST['urun_ad']),
        'urun_detay' => htmlspecialchars($_POST['urun_detay']),
        'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
        'urunfoto_resimyol' => $refimgyol
    ));



    if ($update) {


        Header("Location:../../urunlerim.php?durum=ok");
        exit;
    } else {

        Header("Location:../../urun-ekle.php?durum=hata");
        exit;
    }
}
