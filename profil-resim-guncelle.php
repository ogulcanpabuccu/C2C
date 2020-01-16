<?php require_once 'header.php';

islemkontrol();

?>



<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Profil Resim Güncelleme</li>
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





                <form action="nedmin/netting/adminislem.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in">
                            <h2 class="title-section">Profil Resim Güncelleme</h2>
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
                                }
                                ?>





                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mevcut Resim</label>
                                    <div class="col-sm-9">
                                        <img src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Profil Resminizi Seçin.</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required name="kullanici_magazafoto" type="file">
                                    </div>
                                </div>

                                <input type="hidden" name="eski_yol" value="<?php echo $kullanicicek['kullanici_magazafoto'] ?>">


                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <center><button class="update-btn" name="kullaniciresimguncelle">Güncelle</button></center>
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