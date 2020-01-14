<?php require_once 'header.php'; ?>
<!-- Main Banner 1 Area Start Here
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <p>Premium WordPress Themes, Web Templates and Many More ...</p>
            <div class="banner-search-area input-group">
                <input class="form-control" placeholder="Search Your Keywords . . ." type="text">
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
    </div>
</div> -->
<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Kayıt</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Üye Kayıt İşlemleri</h2>

        <div class="registration-details-area inner-page-padding">

            <?php

            if ($_GET['durum'] == "farklisifre") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                </div>

            <?php } elseif ($_GET['durum'] == "eksiksifre") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                </div>

            <?php } elseif ($_GET['durum'] == "mukerrerkayit") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
                </div>

            <?php } elseif ($_GET['durum'] == "basarisiz") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
                </div>

            <?php }
            ?>

            <form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Mail Adresiniz *</label>
                            <input type="email" name="kullanici_mail" required placeholder="Mail adresiniz (Kullanıcı adınız olacak!!!)" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Adınız *</label>
                            <input type="text" name="kullanici_ad" required placeholder="Adınızı giriniz." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Soyadınız *</label>
                            <input type="text" name="kullanici_soyad" required placeholder="Soyadınızı giriniz" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Şifre *</label>
                            <input type="password" name="kullanici_passwordone" required placeholder="Şifrenizi giriniz." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Şifre Tekrar *</label>
                            <input type="password" name="kullanici_passwordtwo" required placeholder="Şifre Tekrar giriniz." class="form-control">
                        </div>
                    </div>
                </div>


                <div class="row">


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pLace-order">
                            <button name="musterikaydet" class="update-btn disabled" type="submit">Kaydol</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Registration Page Area End Here -->
<?php require_once 'footer.php'; ?>