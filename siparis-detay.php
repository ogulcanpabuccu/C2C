<?php require_once 'header.php';

islemkontrol();

?>

<head>

    <style>
        input {

            margin-left: 20px !important;

        }
    </style>


</head>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Ürünlerim</li>
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

                if ($_GET['durum'] == "no") { ?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Yorum gönderilemedi.Yöneticinize Başvurun.
                    </div>

                <?php } elseif ($_GET['durum'] == "ok") { ?>

                    <div class="alert alert-success">
                        <strong>Bilgi!</strong> Yorumunuz gönderildi onaylandıktan sonra ürün sayfasından görebilirsiniz.
                    </div>
                <?php  }  ?>





                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section"><?php echo $_GET['siparis_id'] ?> numaralı sipariş detayı</h2>
                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ürün Adı</th>
                                        <th scope="col">Satıcı</th>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">Onay Durumu</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $siparissor = $db->prepare("SELECT urun.*,kullanici.*,siparis.*,siparis_detay.* FROM siparis INNER JOIN siparis_detay ON
                                     siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON 
                                     kullanici.kullanici_id=siparis_detay.kullanici_idsatici where siparis.siparis_id=:siparis_detay_id ");

                                    $siparissor->execute(array(
                                        'siparis_detay_id' => $_GET['siparis_id']

                                    ));
                                    $say = 0;

                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                                        $say++;

                                        $siparisdetay_onay = $sipariscek['siparisdetay_onay'];
                                        $siparisdetay_yorum = $sipariscek['siparisdetay_yorum'];
                                        $urun_id = $sipariscek['urun_id'];

                                    ?>

                                        <tr>
                                            <th scope="row"><?php echo $say ?></th>
                                            <td><?php echo $sipariscek['urun_ad'] ?></td>
                                            <td><?php echo $sipariscek['kullanici_ad'] . " " . $sipariscek['kullanici_soyad'] ?></td>
                                            <td><?php echo $sipariscek['urun_fiyat'] ?> <i class="fa fa-try" style="font-size: 12px;" aria-hidden="true"></i></td>
                                            <td>



                                                <?php

                                                if ($sipariscek['siparisdetay_onay'] == 1) { ?>

                                                    <a onclick="return confirm ('Ürüne Onay veriyorsunuz bu işlem geri alınamaz !!! \n Ürün Fiyatı : <?php echo $sipariscek['urun_fiyat'] ?> Türk lirası')" href="nedmin/netting/kullanici.php?urunonay=ok&siparisdetay_id=<?php echo $sipariscek['siparisdetay_id'] ?>&siparis_id=<?php echo $sipariscek['siparis_id'] ?>"> <button class="btn btn-warning btn-xs"> Onay ver </button></a>


                                                <?php   } else if ($sipariscek['siparisdetay_onay'] == 2) {  ?>

                                                    <button class="btn btn-success btn-xs"> Onaylandı </button>
                                                <?php    } else if ($sipariscek['siparisdetay_onay'] == 0) {  ?>

                                                    <button class="btn btn-warning btn-xs"> Siparişin Teslim Edilmesi bekleniyor </button>
                                                <?php    }


                                                ?></td>



                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>

                            <!-- Yorum Aalanı başlangıç -->

                            <?php
                            if ($siparisdetay_onay == 2 and $siparisdetay_yorum == 0) { ?>


                                <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                                    <div class="settings-details tab-content">
                                        <div class="tab-pane fade active in" id="Personal">
                                            <h2 class="title-section">Deneyimini bizimle paylaşırmısın</h2>
                                            <div class="personal-info inner-page-padding">




                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Puanla</label>
                                                    <div class="col-sm-9">
                                                        <input type="radio" name="yorum_puan" value="1"> 1
                                                        <input type="radio" name="yorum_puan" value="2"> 2
                                                        <input type="radio" name="yorum_puan" value="3"> 3
                                                        <input type="radio" name="yorum_puan" value="4"> 4
                                                        <input type="radio" name="yorum_puan" value="5"> 5
                                                    </div>
                                                </div>
                                                <input type="hidden" name="urun_id" value="<?php echo $urun_id ?>">
                                                <input type="hidden" name="siparis_id" value="<?php echo $_GET['siparis_id'] ?>">



                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Yorumunuz</label>
                                                    <div class="col-sm-9">
                                                        <textarea style="height: 200px;" class="form-control" name="yorum_detay" type="text" required placeholder="Yorumunuzu giriniz."></textarea>
                                                    </div>
                                                </div>




                                                <div class="form-group">

                                                    <div class="col-sm-12">

                                                        <center><button class="update-btn" name="puanyorumekle" id="login-update">Gönder</button></center>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>

                                </form>

                            <?php  } elseif ($siparisdetay_onay == 2 and $siparisdetay_yorum == 1) {  ?>



                                <p class="alert alert-success">Bu ürün için yorum yapılmıştır.Yorumunuzu ürün sayfasında görüntüleyemiyorsanız ya onaylanmamıştır yada iptal edilmiştir.</p>

                            <?php } ?>
                            <!-- Yorum Aalanı bitiş -->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>

<script>
    $(document).ready(function() {


        $("#kullanici_tip").change(function() {




            var tip = $("#kullanici_tip").val();

            if (tip == "PERSONAL") {

                $("#kurumsal").hide();
                $("#tc").show();


            } else if (tip == "PRIVATE_COMPANY") {

                $("#kurumsal").show();
                $("#tc").hide();

            }

        }).change();


    });
</script>