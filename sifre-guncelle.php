<?php require_once 'header.php';

islemkontrol();

?>



<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Şifre değiştirme</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">


        <div class="row settings-wrapper">



            <?php require_once 'hesap-sidebar.php'; ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">





                <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Şifrenizi buradan değiştirebilirsiniz.</h2>
                            <div class="personal-info inner-page-padding">
                                <?php

                                if ($_GET['durum'] == "hata") { ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> İşlem başarısız.
                                    </div>

                                <?php } else if ($_GET['durum'] == "ok") { ?>

                                    <div class="alert alert-success">
                                        <strong>Bilgi!</strong> İşlem başarılı.
                                    </div>
                                <?php
                                } else if ($_GET['durum'] == "eskisifrehata") { ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Eski Şifreniz hatalı !!!
                                    </div>
                                <?php
                                } else if ($_GET['durum'] == "sifreleruyusmuyor") { ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Şifreleriniz uyuşmuyor laa !!!
                                    </div>
                                <?php
                                } else if ($_GET['durum'] == "eksiksifre") { ?>

                                    <div class="alert alert-danger">
                                        <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                                    </div>
                                <?php
                                }
                                ?>



                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Eski Şifre </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_eskipassword" type="password" placeholder="Eski Şifrenizi giriniz.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Yeni Şifre </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_passwordone" type="password" placeholder="Yeni Şifrenizi giriniz.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Yeni Şifre Tekrar </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_passwordtwo" type="password" placeholder="Yeni Şifrenizi tekrar giriniz.">
                                    </div>
                                </div>


                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <center><button class="update-btn" name="musterisifreguncelle">Şifremi Değiştir.</button></center>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>