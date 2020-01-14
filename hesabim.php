<?php require_once 'header.php';

islemkontrol();

?>



<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Hesabım</li>
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

                <?php

                if ($_GET['durum'] == "hata") { ?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Güncelleme yapılamadı.
                    </div>

                <?php } elseif ($_GET['durum'] == "ok") { ?>

                    <div class="alert alert-success">
                        <strong>Bilgi!</strong> Değişiklik tamamlandı.
                    </div>
                <?php  } else {
                    # code...
                }



                ?>




                <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Hesap Bilgilerimi Düzenle</h2>
                            <div class="personal-info inner-page-padding">


                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Mail Adresiniz</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" disabled value="<?php echo $kullanicicek['kullanici_mail'] ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Adınız</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_ad" type="text" value="<?php echo $kullanicicek['kullanici_ad'] ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Soyadınız</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_soyad" type="text" value="<?php echo $kullanicicek['kullanici_soyad'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Telefon numaranız</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_gsm" type="number" value="<?php echo $kullanicicek['kullanici_gsm'] ?>">
                                    </div>
                                </div>




                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <center><button class="update-btn" name="musteribilgiguncelle" id="login-update">Bilgilerimi Güncelle</button></center>
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