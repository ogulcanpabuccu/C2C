<?php
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);

include 'baglan.php';
include '../production/fonksiyon.php';









if (isset($_POST['sliderkaydet'])) {


    $uploads_dir = '../../dimg/slider';
    @$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
    @$name = $_FILES['slider_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
        slider_aciklama=:slider_aciklama,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_resimyol=:slider_resimyol
		");
    $insert = $kaydet->execute(array(
        'slider_ad' => $_POST['slider_ad'],
        'slider_aciklama' => $_POST['slider_aciklama'],
        'slider_sira' => $_POST['slider_sira'],
        'slider_link' => $_POST['slider_link'],
        'slider_resimyol' => $refimgyol
    ));

    if ($insert) {

        Header("Location:../production/slider.php?durum=ok");
        exit;
    } else {

        Header("Location:../production/slider.php?durum=no");
        exit;
    }
}


//benimmm

if (isset($_POST['sliderduzenle'])) {

    $slider_id = $_POST['slider_id'];


    //Slider düzenleme işlemi için örnek başlangıç
    if ($_FILES['slider_resimyol']["size"] > 0) {

        $uploads_dir = '../../dimg/slider';
        @$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
        @$name = $_FILES['slider_resimyol']["name"];
        //resmin isminin benzersiz olması
        $benzersizsayi1 = rand(20000, 32000);
        $benzersizsayi2 = rand(20000, 32000);
        $benzersizsayi3 = rand(20000, 32000);
        $benzersizsayi4 = rand(20000, 32000);
        $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
        $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
        @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



        $ayarkaydet = $db->prepare("UPDATE slider SET 
        slider_ad=:slider_ad,
        slider_aciklama=:slider_aciklama,
        slider_sira=:slider_sira,
        slider_link=:slider_link,
        slider_durum=:slider_durum,
        slider_resimyol=:slider_resimyol
       
        WHERE slider_id={$_POST['slider_id']}");

        $update = $ayarkaydet->execute(array(
            'slider_ad' => $_POST['slider_ad'],
            'slider_aciklama' => $_POST['slider_aciklama'],
            'slider_sira' => $_POST['slider_sira'],
            'slider_link' => $_POST['slider_link'],
            'slider_durum' => $_POST['slider_durum'],
            'slider_resimyol' => $refimgyol

        ));

        $slider_id = $_POST['slider_id'];
        if ($update) {

            $resimsilunlink = $_POST['slider_resimyol'];
            unlink("../../$resimsilunlink");

            Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
        } else {

            Header("Location:../production/slider-duzenle.php?durum=no");
        }
    } else {

        $ayarkaydet = $db->prepare("UPDATE slider SET 
        slider_ad=:slider_ad,
        slider_aciklama=:slider_aciklama,
        slider_sira=:slider_sira,
        slider_link=:slider_link,
        slider_durum=:slider_durum
        WHERE slider_id={$_POST['slider_id']}");

        $update = $ayarkaydet->execute(array(

            'slider_ad' => $_POST['slider_ad'],
            'slider_aciklama' => $_POST['slider_aciklama'],
            'slider_sira' => $_POST['slider_sira'],
            'slider_link' => $_POST['slider_link'],
            'slider_durum' => $_POST['slider_durum']

        ));
        $slider_id = $_POST['slider_id'];
    }

    if ($update) {
        header("Location:../production/slider.php?slider_id=$slider_id&durum=ok");
    } else {
        header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=no");
    }
}



// bitişşş
if ($_GET['slidersil'] == "ok") {


    //yetkili girişi olmayan get ve postların engellenmesi
    islemkontrol();

    $sil = $db->prepare("DELETE from slider where slider_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['slider_id']
    ));

    if ($kontrol) {
        $resimsilunlink = $_GET['slider_resimyol'];
        unlink("../../$resimsilunlink");
        header("location:../production/slider.php?sil=ok");
    } else {
        header("location:..production/slider.php?sil=no");
    }
}






if (isset($_POST['admingiris'])) {


    $kullanici_mail = $_POST['kullanici_mail'];
    $kullanici_password = md5($_POST['kullanici_password']);

    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:pasword and kullanici_yetki=:yetki ");

    $kullanicisor->execute(array(
        'mail' => $kullanici_mail,
        'pasword' => $kullanici_password,
        'yetki' => 5,

    ));

    echo $say = $kullanicisor->rowCount();

    if ($say == 1) {

        $_SESSION['kullanici_mail'] = $kullanici_mail;
        header("Location:../production/index.php");
        exit;
    } else {
        header("Location:../production/login.php?durum=no");
        exit;
    }
}



if (isset($_POST['genelayarkaydet'])) {
    // tablo güncelleme işlemi kodları

    $ayarkaydet = $db->prepare("UPDATE ayar SET
ayar_title=:ayar_title,
ayar_description=:ayar_description,
ayar_keywords=:ayar_keywords,
ayar_author=:ayar_author
WHERE ayar_id=0");


    $update = $ayarkaydet->execute(array(

        'ayar_title' => $_POST['ayar_title'],
        'ayar_description' => $_POST['ayar_description'],
        'ayar_keywords' => $_POST['ayar_keywords'],
        'ayar_author' => $_POST['ayar_author']
    ));


    if ($update) {

        header("location:../production/genel-ayar.php?durum=ok");
    } else {
        header("location:../production/genel-ayar.php?durum=no");
    }
}


if (isset($_POST['iletisimayarkaydet'])) {
    // tablo güncelleme işlemi kodları

    $ayarkaydet = $db->prepare("UPDATE ayar SET
ayar_tel=:ayar_tel,
ayar_gsm=:ayar_gsm,
ayar_faks=:ayar_faks,
ayar_mail=:ayar_mail,
ayar_ilce=:ayar_ilce,
ayar_il=:ayar_il,
ayar_adres=:ayar_adres,
ayar_mesai=:ayar_mesai
WHERE ayar_id=0");


    $update = $ayarkaydet->execute(array(

        'ayar_tel' => $_POST['ayar_tel'],
        'ayar_gsm' => $_POST['ayar_gsm'],
        'ayar_faks' => $_POST['ayar_faks'],
        'ayar_mail' => $_POST['ayar_mail'],
        'ayar_ilce' => $_POST['ayar_ilce'],
        'ayar_il' => $_POST['ayar_il'],
        'ayar_adres' => $_POST['ayar_adres'],
        'ayar_mesai' => $_POST['ayar_mesai']
    ));


    if ($update) {

        header("location:../production/iletisim-ayarlar.php?durum=ok");
    } else {
        header("location:../production/iletisim-ayarlar.php?durum=no");
    }
}



if (isset($_POST['apiayarkaydet'])) {
    // tablo güncelleme işlemi kodları

    $ayarkaydet = $db->prepare("UPDATE ayar SET
ayar_analystic=:ayar_analystic,
ayar_maps=:ayar_maps,
ayar_zopim=:ayar_zopim
WHERE ayar_id=0");


    $update = $ayarkaydet->execute(array(

        'ayar_analystic' => $_POST['ayar_analystic'],
        'ayar_maps' => $_POST['ayar_maps'],
        'ayar_zopim' => $_POST['ayar_zopim']
    ));


    if ($update) {

        header("location:../production/api-ayarlar.php?durum=ok");
    } else {
        header("location:../production/api-ayarlar.php?durum=no");
    }
}



if (isset($_POST['sosyalayarkaydet'])) {
    // tablo güncelleme işlemi kodları

    $ayarkaydet = $db->prepare("UPDATE ayar SET
ayar_facebook=:ayar_facebook,
ayar_twitter=:ayar_twitter,
ayar_google=:ayar_google,
ayar_youtube=:ayar_youtube
WHERE ayar_id=0");


    $update = $ayarkaydet->execute(array(

        'ayar_facebook' => $_POST['ayar_facebook'],
        'ayar_twitter' => $_POST['ayar_twitter'],
        'ayar_google' => $_POST['ayar_google'],
        'ayar_youtube' => $_POST['ayar_youtube']
    ));


    if ($update) {

        header("location:../production/sosyal-ayarlar.php?durum=ok");
    } else {
        header("location:../production/sosyal-ayarlar.php?durum=no");
    }
}


if (isset($_POST['mailayarkaydet'])) {
    // tablo güncelleme işlemi kodları

    $ayarkaydet = $db->prepare("UPDATE ayar SET
ayar_smtphost=:ayar_smtphost,
ayar_smtpuser=:ayar_smtpuser,
ayar_smtppassword=:ayar_smtppassword,
ayar_smtpport=:ayar_smtpport
WHERE ayar_id=0");


    $update = $ayarkaydet->execute(array(

        'ayar_smtphost' => $_POST['ayar_smtphost'],
        'ayar_smtpuser' => $_POST['ayar_smtpuser'],
        'ayar_smtppassword' => $_POST['ayar_smtppassword'],
        'ayar_smtpport' => $_POST['ayar_smtpport']
    ));


    if ($update) {

        header("location:../production/mail-ayarlar.php?durum=ok");
    } else {
        header("location:../production/mail-ayarlar.php?durum=no");
    }
}

if (isset($_POST['hakkimizdakaydet'])) {
    // tablo güncelleme işlemi kodları

    $hakkimizdakaydet = $db->prepare("UPDATE hakkimizda SET
hakkimizda_baslik=:hakkimizda_baslik,
hakkimizda_icerik=:hakkimizda_icerik,
hakkimizda_video=:hakkimizda_video,
hakkimizda_vizyon=:hakkimizda_vizyon,
hakkimizda_misyon=:hakkimizda_misyon
WHERE hakkimizda_id=0");


    $update = $hakkimizdakaydet->execute(array(

        'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
        'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
        'hakkimizda_video' => $_POST['hakkimizda_video'],
        'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
        'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
    ));


    if ($update) {

        header("location:../production/hakkimizda.php?durum=ok");
    } else {
        header("location:../production/hakkimizda.php?durum=no");
    }
}




if (isset($_POST['hesabduzenle'])) {

    $kullanici_id = $_POST['kullanici_id'];

    $ayarkaydet = $db->prepare("UPDATE kullanici SET 
 kullanici_tc=:kullanici_tc,
 kullanici_gsm=:kullanici_gsm,
 kullanici_il=:kullanici_il,
 kullanici_ilce=:kullanici_ilce,
 kullanici_adres=:kullanici_adres

 WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $ayarkaydet->execute(array(

        'kullanici_tc' => $_POST['kullanici_tc'],
        'kullanici_gsm' => $_POST['kullanici_gsm'],
        'kullanici_il' => $_POST['kullanici_il'],
        'kullanici_ilce' => $_POST['kullanici_ilce'],
        'kullanici_adres' => $_POST['kullanici_adres']

    ));


    if ($update) {
        header("Location:../../hesabim.php?durum=ok");
    } else {
        header("Location:../../hesabim.php?durum=no");
    }
}


if ($_GET['kullanicisil'] == "ok") {
    //yetkili girişi olmayan get ve postların engellenmesi
    islemkontrol();
    $sil = $db->prepare("DELETE from kullanici where kullanici_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['kullanici_id']
    ));

    if ($kontrol) {
        header("location:../production/kullanici.php?sil=ok");
    } else {
        header("location:..production/kullanici.php?sil=no");
    }
}


if (isset($_POST['menuduzenle'])) {

    $menu_id = $_POST['menu_id'];

    $menu_seourl = seo($_POST['menu_ad']);

    $ayarkaydet = $db->prepare("UPDATE menu SET 
 menu_ad=:menu_ad,
 menu_detay=:menu_detay,
 menu_url=:menu_url,
 menu_sira=:menu_sira,
 menu_seourl=:menu_seourl,
 menu_durum=:menu_durum

 WHERE menu_id={$_POST['menu_id']}");

    $update = $ayarkaydet->execute(array(

        'menu_ad' => $_POST['menu_ad'],
        'menu_detay' => $_POST['menu_detay'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seourl' => $menu_seourl,
        'menu_durum' => $_POST['menu_durum']

    ));


    if ($update) {
        header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
    } else {
        header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
    }
}



if ($_GET['menusil'] == "ok") {

    //yetkili girişi olmayan get ve postların engellenmesi
    islemkontrol();
    $sil = $db->prepare("DELETE from menu where menu_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['menu_id']
    ));

    if ($kontrol) {
        header("location:../production/menu.php?sil=ok");
    } else {
        header("location:..production/menu.php?sil=no");
    }
}


if (isset($_POST['menukaydet'])) {

    $menu_seourl = seo($_POST['menu_ad']);

    $ayarekle = $db->prepare("INSERT INTO menu SET 
 menu_ad=:menu_ad,
 menu_detay=:menu_detay,
 menu_url=:menu_url,
 menu_sira=:menu_sira,
 menu_seourl=:menu_seourl,
 menu_durum=:menu_durum

");

    $insert = $ayarekle->execute(array(

        'menu_ad' => $_POST['menu_ad'],
        'menu_detay' => $_POST['menu_detay'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seourl' => $menu_seourl,
        'menu_durum' => $_POST['menu_durum']

    ));


    if ($insert) {
        header("Location:../production/menu.php?durum=ok");
    } else {
        header("Location:../production/menu.php?durum=no");
    }
}



if (isset($_POST['kategoriekle'])) {


    $kategori_seourl = seo($_POST['kategori_ad']);


    $kaydet = $db->prepare("INSERT INTO kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		");
    $insert = $kaydet->execute(array(
        'ad' => $_POST['kategori_ad'],
        'kategori_durum' => $_POST['kategori_durum'],
        'seourl' => $kategori_seourl,
        'sira' => $_POST['kategori_sira']
    ));

    if ($insert) {

        Header("Location:../production/kategori.php?durum=ok");
    } else {

        Header("Location:../production/kategori.php?durum=no");
    }
}


if ($_GET['kategorisil'] == "ok") {
    //yetkili girişi olmayan get ve postların engellenmesi
    islemkontrol();

    $sil = $db->prepare("DELETE from kategori where kategori_id=:kategori_id");
    $kontrol = $sil->execute(array(
        'kategori_id' => $_GET['kategori_id']
    ));

    if ($kontrol) {

        Header("Location:../production/kategori.php?durum=ok");
    } else {

        Header("Location:../production/kategori.php?durum=no");
    }
}



if ($_GET['urunsil'] == "ok") {
    //yetkili girişi olmayan get ve postların engellenmesi
    islemkontrol();

    $sil = $db->prepare("DELETE from urun where urun_id=:urun_id");
    $kontrol = $sil->execute(array(
        'urun_id' => $_GET['urun_id']
    ));

    if ($kontrol) {

        Header("Location:../production/urun.php?durum=ok");
    } else {

        Header("Location:../production/urun.php?durum=no");
    }
}

if (isset($_POST['urunekle'])) {


    $urun_seourl = seo($_POST['urun_ad']);


    $kaydet = $db->prepare("INSERT INTO  urun SET
    kategori_id=:kategori_id,
    urun_ad=:urun_ad,
    urun_detay=:urun_detay,
    urun_fiyat=:urun_fiyat,
    urun_video=:urun_video,
    urun_onecikar=:urun_onecikar,
    urun_keyword=:urun_keyword,
    urun_durum=:urun_durum,
    urun_stok=:urun_stok,
    urun_seourl=:seourl	
    ");
    $insert = $kaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],
        'urun_ad' => $_POST['urun_ad'],
        'urun_detay' => $_POST['urun_detay'],
        'urun_fiyat' => $_POST['urun_fiyat'],
        'urun_video' => $_POST['urun_video'],
        'urun_onecikar' => $_POST['urun_onecikar'],
        'urun_keyword' => $_POST['urun_keyword'],
        'urun_durum' => $_POST['urun_durum'],
        'urun_stok' => $_POST['urun_stok'],
        'seourl' => $urun_seourl

    ));

    if ($insert) {

        Header("Location:../production/urun.php?durum=ok");
    } else {

        Header("Location:../production/urun.php?durum=no");
    }
}


if (isset($_POST['urunduzenle'])) {
    $urun_id = $_POST['urun_id'];
    $urun_seourl = seo($_POST['urun_ad']);


    $kaydet = $db->prepare("UPDATE  urun SET
		kategori_id=:kategori_id,
        urun_ad=:urun_ad,
        urun_detay=:urun_detay,
        urun_fiyat=:urun_fiyat,
        urun_video=:urun_video,
        urun_onecikar=:urun_onecikar,
        urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
        urun_stok=:urun_stok,
		urun_seourl=:seourl	
		WHERE urun_id={$_POST['urun_id']}");
    $update = $kaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],
        'urun_ad' => $_POST['urun_ad'],
        'urun_detay' => $_POST['urun_detay'],
        'urun_fiyat' => $_POST['urun_fiyat'],
        'urun_video' => $_POST['urun_video'],
        'urun_onecikar' => $_POST['urun_onecikar'],
        'urun_keyword' => $_POST['urun_keyword'],
        'urun_durum' => $_POST['urun_durum'],
        'urun_stok' => $_POST['urun_stok'],
        'seourl' => $urun_seourl

    ));

    if ($update) {

        Header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");
    } else {

        Header("Location:../production/urun-duzenle.php?durum=no&urun_id=$urun_id");
    }
}



if ($_GET['urun_onecikar'] == "ok") {



    $duzenle = $db->prepare("UPDATE urun SET
		urun_onecikar=:urun_onecikar
WHERE urun_id= {$_GET['urun_id']}");
    $update = $duzenle->execute(array(
        'urun_onecikar' => $_GET['urun_one']
    ));

    if ($update) {



        Header("Location:../production/urun.php?durum=ok");
    } else {

        Header("Location:../production/urun.php?durum=no");
    }
}


if (isset($_POST['yorumkaydet'])) {


    $gelen_url = $_POST['gelen_url'];


    $ayarekle = $db->prepare("INSERT INTO yorumlar SET 
        yorum_detay=:yorum_detay,
        kullanici_id=:kullanici_id,
        urun_id=:urun_id
        ");



    $insert = $ayarekle->execute(array(

        'yorum_detay' => $_POST['yorum_detay'],
        'kullanici_id' => $_POST['kullanici_id'],
        'urun_id' => $_POST['urun_id']

    ));


    if ($insert) {
        header("Location:$gelen_url?durum=ok");
    } else {
        header("Location:$gelen_url?durum=no");
    }
}


if ($_GET['yorum_onay'] == "ok") {



    $duzenle = $db->prepare("UPDATE yorumlar SET
		yorum_onay=:yorum_onay
WHERE yorum_id= {$_GET['yorum_id']}");
    $update = $duzenle->execute(array(
        'yorum_onay' => $_GET['yorum_one']
    ));

    if ($update) {



        Header("Location:../production/yorumlar.php?durum=ok");
    } else {

        Header("Location:../production/yorumlar.php?durum=no");
    }
}


if ($_GET['yorumsil'] == "ok") {
    //yetkili girişi olmayan get ve postların engellenmesi
    islemkontrol();

    $sil = $db->prepare("DELETE from yorumlar where yorum_id=:yorum_id");
    $kontrol = $sil->execute(array(
        'yorum_id' => $_GET['yorum_id']
    ));

    if ($kontrol) {

        Header("Location:../production/yorumlar.php?durum=ok");
    } else {

        Header("Location:../production/yorumlar.php?durum=no");
    }
}



if (isset($_POST['sepetekle'])) {



    $ayarekle = $db->prepare("INSERT INTO sepet SET 
        urun_adet=:urun_adet,
        kullanici_id=:kullanici_id,
        urun_id=:urun_id
        ");



    $insert = $ayarekle->execute(array(

        'urun_adet' => $_POST['urun_adet'],
        'kullanici_id' => $_POST['kullanici_id'],
        'urun_id' => $_POST['urun_id']

    ));


    if ($insert) {
        header("Location:../../sepet.php?durum=ok");
    } else {
        header("Location:../../sepet.php?durum=no");
    }
}


if ($_GET['sepetsil'] == "ok") {
    $sil = $db->prepare("DELETE from sepet where sepet_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['sepet_id']
    ));

    if ($kontrol) {
        header("location:../../sepet.php?sil=ok");
    } else {
        header("location:../../sepet.php?sil=no");
    }
}



if (isset($_POST['bankaekle'])) {


    $kaydet = $db->prepare("INSERT INTO banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_iban=:banka_iban,
		banka_hesapadsoyad=:banka_hesapadsoyad
		");
    $insert = $kaydet->execute(array(
        'ad' => $_POST['banka_ad'],
        'banka_durum' => $_POST['banka_durum'],
        'banka_iban' => $_POST['banka_iban'],
        'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad']
    ));

    if ($insert) {

        Header("Location:../production/banka.php?durum=ok");
    } else {

        Header("Location:../production/banka.php?durum=no");
    }
}


if (isset($_POST['bankaduzenle'])) {

    $banka_id = $_POST['banka_id'];

    $kaydet = $db->prepare("UPDATE banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_iban=:banka_iban,
		banka_hesapadsoyad=:banka_hesapadsoyad

        WHERE banka_id={$_POST['banka_id']}

		");
    $update = $kaydet->execute(array(
        'ad' => $_POST['banka_ad'],
        'banka_durum' => $_POST['banka_durum'],
        'banka_iban' => $_POST['banka_iban'],
        'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad']


    ));

    if ($update) {

        Header("Location:../production/banka.php?banka_id=$banka_id&durum=ok");
    } else {

        Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=no");
    }
}

if ($_GET['bankasil'] == "ok") {
    $sil = $db->prepare("DELETE from banka where banka_id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['banka_id']
    ));

    if ($kontrol) {

        header("location:../production/banka.php?sil=ok");
    } else {
        header("location:..production/banka.php?sil=no");
    }
}


if (isset($_POST['kullanicisifreguncelle'])) {

    echo $kullanici_eskipassword = trim($_POST['kullanici_eskipassword']);
    echo "<br>";
    echo $kullanici_passwordone = trim($_POST['kullanici_passwordone']);
    echo "<br>";
    echo $kullanici_passwordtwo = trim($_POST['kullanici_passwordtwo']);
    echo "<br>";

    $kullanici_password = md5($kullanici_eskipassword);


    $kullanicisor = $db->prepare("select * from kullanici where kullanici_password=:password");
    $kullanicisor->execute(array(
        'password' => $kullanici_password
    ));

    //dönen satır sayısını belirtir
    $say = $kullanicisor->rowCount();



    if ($say == 0) {

        header("Location:../../sifre-guncelle?durum=eskisifrehata");
    } else {



        //eski şifre doğruysa başla


        if ($kullanici_passwordone == $kullanici_passwordtwo) {


            if (strlen($kullanici_passwordone) >= 6) {


                //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                $password = md5($kullanici_passwordone);



                $kullanicikaydet = $db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");


                $insert = $kullanicikaydet->execute(array(
                    'kullanici_password' => $password
                ));

                if ($insert) {


                    header("Location:../../sifre-guncelle.php?durum=sifredegisti");
                } else {


                    header("Location:../../sifre-guncelle.php?durum=no");
                }





                // Bitiş



            } else {


                header("Location:../../sifre-guncelle.php?durum=eksiksifre");
            }
        } else {

            header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");

            exit;
        }
    }

    exit;

    if ($update) {

        header("Location:../../sifre-guncelle?durum=ok");
    } else {

        header("Location:../../sifre-guncelle?durum=no");
    }
}


//Sipariş İşlemleri

if (isset($_POST['bankasiparisekle'])) {


    $siparis_tip = "Banka Havalesi";


    $kaydet = $db->prepare("INSERT INTO siparis SET
		kullanici_id=:kullanici_id,
		siparis_tip=:siparis_tip,	
		siparis_banka=:siparis_banka,
		siparis_toplam=:siparis_toplam
		");
    $insert = $kaydet->execute(array(
        'kullanici_id' => $_POST['kullanici_id'],
        'siparis_tip' => $siparis_tip,
        'siparis_banka' => $_POST['siparis_banka'],
        'siparis_toplam' => $_POST['siparis_toplam']
    ));

    if ($insert) {


        echo $siparis_id = $db->lastInsertId();
        echo "<hr>";

        $kullanici_id = $_POST['kullanici_id'];
        $sepetsor = $db->prepare("SELECT * FROM sepet where kullanici_id=:id");

        $sepetsor->execute(array(
            'id' => $kullanici_id


        ));



        while ($sepetcek = $sepetsor->fetch(PDO::FETCH_ASSOC)) {


            $urun_id = $sepetcek['urun_id'];
            $urun_adet = $sepetcek['urun_adet'];


            $urunsor = $db->prepare("SELECT * FROM urun where urun_id=:id");

            $urunsor->execute(array(
                'id' => $urun_id

            ));
            $uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

            $urun_fiyat = $uruncek['urun_fiyat'];

            $kaydet = $db->prepare("INSERT INTO siparis_detay SET
            siparis_id=:siparis_id,
            urun_id=:urun_id,	
            urun_fiyat=:urun_fiyat,
            urun_adet=:urun_adet
            
            ");
            $insert = $kaydet->execute(array(
                'siparis_id' => $siparis_id,
                'urun_id' => $urun_id,
                'urun_fiyat' => $urun_fiyat,
                'urun_adet' => $urun_adet

            ));
        }

        if ($insert) {



            //Sipariş detay kayıtta başarıysa sepeti boşalt

            $sil = $db->prepare("DELETE from sepet where kullanici_id=:kullanici_id");
            $kontrol = $sil->execute(array(
                'kullanici_id' => $kullanici_id
            ));


            Header("Location:../../siparislerim?durum=ok");
        }
    } else {

        echo "başarısız";

        Header("Location:../production/siparislerim.php?durum=no");
    }
}


if (isset($_POST['urunfotosil'])) {

    $urun_id = $_POST['urun_id'];


    echo $checklist = $_POST['urunfotosec'];


    foreach ($checklist as $list) {

        $sil = $db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
        $kontrol = $sil->execute(array(
            'urunfoto_id' => $list
        ));
    }

    if ($kontrol) {

        Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");
    } else {

        Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
    }
}
