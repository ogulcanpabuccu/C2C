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
                <li>Giriş</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Giriş İşlemleri</h2>

        <div class="registration-details-area inner-page-padding">

            <?php

            if ($_GET['durum'] == "hata") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Yanlış Kullanıcı adı veya şifre.
                </div>

            <?php } elseif ($_GET['durum'] == "exit") { ?>

                <div class="alert alert-success">
                    <strong>Bilgi!</strong> Başarıyla Çıkış yapıldı.
                </div>
            <?php  } elseif ($_GET['durum'] == "kayitok") { ?>

                <div class="alert alert-success">
                    <strong>Bigi!</strong> Kaydınız Yapıldı giriş yapabilirsiniz.
                </div>

            <?php } elseif ($_GET['durum'] == "captchahata") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Güvenlik kodu hatalı.
                </div>

            <?php }


            ?>


            <form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Mail Adresiniz *</label>
                            <input type="email" name="kullanici_mail" required placeholder="Mail adresinizi giriniz." class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Şifre *</label>
                            <input type="password" name="kullanici_password" required placeholder="Şifrenizi giriniz." class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Güvenlik Kodu *</label>

                            <img src="securimage/securimage_show" id="captcha" alt="CAPTCHA image" />
                            <a href="#" onclick="document.getElementById('captcha').src='securimage/securimage_show?'+ Math.random(); return false"> [ Değiştir ]</a>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="first-name">Güvenlik Kodu *</label>
                                <input type="text" name="captcha_code" required placeholder="Güvenlik kodunu giriniz." class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="row">


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pLace-order">
                                <button name="musterigiris" class="update-btn disabled" type="submit">Giriş</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Registration Page Area End Here -->
<?php require_once 'footer.php'; ?>