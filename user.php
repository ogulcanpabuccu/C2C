﻿<?php require_once 'header.php';


$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id and kullanici_magaza=:magaza");

$kullanicisor->execute(array(
    'id' => $_GET['kullanici_id'],
    'magaza' => 2


));


$say = $kullanicisor->rowCount();

if ($say == 0) {
    Header("Location:404.php");
}


$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)



?>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Profile Page Start Here -->
<div class="profile-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">

            <!-- Ust Banner User -->
            <?php require_once 'user-header.php'; ?>

            <!-- Ust Banner User  -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <div class="sidebar-author-img">
                                    <img src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                                </div>
                                <div class="sidebar-author-content">
                                    <h3><?php echo $kullanicicek['kullanici_ad'] ?></h3>
                                    <a href="#" class="view-profile"><i class="fa fa-circle" aria-hidden="true"></i>Online</a>
                                </div>
                            </div>
                            <ul class="sidebar-badges-item">

                                <?php

                                if ($saycek['say'] >= 1 and $saycek['say'] <= 9) { ?>

                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>

                                <?php    } else if ($saycek['say'] >= 10 and $saycek['say'] <= 19) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>

                                <?php    } else if ($saycek['say'] >= 20 and $saycek['say'] <= 39) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>

                                <?php    } else if ($saycek['say'] >= 40 and $saycek['say'] <= 59) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>

                                <?php    } else if ($saycek['say'] >= 60) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>

                                <?php    } else if ($saycek['say'] < 1) { ?>
                                    <li>
                                        <p>Şuan hiç satış yapmamışsınız satış yaptığınız takdirde burada başarımlar kazanacaksınız.</p>
                                    </li>


                                <?php }  ?>


                            </ul>
                        </div>
                    </div>
                    <ul class="social-default">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="sidebar-product-btn">
                        <?php
                        if (empty($_SESSION['userkullanici_id'])) { ?>

                            <li><a href="login.php" class="buy-now-btn" id="buy-button"><i class="fa fa-user" aria-hidden="true"></i> Mesaj göndermek için giriş yapın</a></li>

                        <?php } else if ($_SESSION['userkullanici_id'] == $_GET['kullanici_id']) { ?>

                            <li><button disabled class="buy-now-btn" id="buy-button"><i class="fa fa-ban" aria-hidden="true"></i> Mesaj Gönder</button></li>

                        <?php } else { ?>

                            <li><a href="mesaj-gonder.php?kullanici_gel=<?php echo $_GET['kullanici_id']  ?>" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj Gönder</a></li>

                        <?php  } ?>



                    </ul>

                </div>
            </div>
        </div>
        <div class="row profile-wrapper">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                <?php require_once 'user-sidebar.php'; ?>

            </div>
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="Products">
                        <h3 class="title-inner-section">Ürünleri</h3>
                        <div class="inner-page-main-body">
                            <div class="row more-product-item-wrapper">

                                <?php
                                $urunsor = $db->prepare("SELECT urun.*,kategori.* FROM urun INNER JOIN kategori on urun.kategori_id=kategori.kategori_id where urun.kullanici_id=:kullanici_id");

                                $urunsor->execute(array(
                                    'kullanici_id' => $_GET['kullanici_id']

                                ));


                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {

                                ?>

                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                        <div class="more-product-item">
                                            <div class="more-product-item-img">
                                                <img style="width: 100px; height:90px;" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="<?php echo $uruncek['urun_ad'] ?>" class="img-responsive">
                                            </div>
                                            <div class="more-product-item-details">
                                                <h4 style="font-size: 12px;"><a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'];  ?>"><?php echo mb_substr($uruncek['urun_ad'], 0, 20, 'UTF-8') ?></a></h4>
                                                <div class="p-title"><?php echo $uruncek['kategori_ad'] ?></div>
                                                <div class="p-price"><?php echo $uruncek['urun_fiyat'] ?> <i class="fa fa-try" style="font-size: 16.5px;" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>

                            <!--     <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <ul class="pagination-align-left">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                    </ul>
                                </div>
                            </div> -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End Here -->
<?php require_once 'footer.php' ?>