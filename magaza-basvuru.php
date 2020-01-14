<?php require_once 'header.php';

islemkontrol();

?>



<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Mağaza Başvuru</li>
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


                <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Mağaza Başvurusu</h2>
                            <div class="personal-info inner-page-padding">

                                <p>Başvuru işleminizi tamamlamak için tüm bilgilerinizin eksiksiz ve doğru olarak girilmesine özen gösteriniz. Eksik yada hatalı bilgi olduğunda başvurunuz iptal edilecektir.</p>



                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Mail Adresiniz</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" disabled value="<?php echo $kullanicicek['kullanici_mail'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Banka Adı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_banka" type="text" value="<?php echo $kullanicicek['kullanici_banka'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">IBAN Numaranız</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="kullanici_iban" type="text" value="<?php echo $kullanicicek['kullanici_iban'] ?>">
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
                                    <label class="col-sm-3 control-label">Üyelik tipiniz</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select name="kullanici_tip" id="kullanici_tip" class='select2'>
                                                <option <?php

                                                        if ($kullanicicek['kullanici_tip'] == "PERSONAL") {
                                                            echo "selected";
                                                        }


                                                        ?> value="PERSONAL">Bireysel</option>
                                                <option <?php

                                                        if ($kullanicicek['kullanici_tip'] == "PRIVATE_COMPANY") {
                                                            echo "selected";
                                                        }


                                                        ?> value="PRIVATE_COMPANY">Kurumsal</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="tc">

                                    <div class="form-group ">
                                        <label class="col-sm-3 control-label">T.C</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div id="kurumsal">
                                    <div class="form-group ">
                                        <label class="col-sm-3 control-label">Firma Ünvan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="kullanici_unvan" value="<?php echo $kullanicicek['kullanici_unvan'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="col-sm-3 control-label">Firma Vergi Dairesi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="kullanici_vdaire" value="<?php echo $kullanicicek['kullanici_vdaire'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="col-sm-3 control-label">Firma Vergi No</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="kullanici_vno" value="<?php echo $kullanicicek['kullanici_vno'] ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Adres</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" required name="kullanici_adres" value="<?php echo $kullanicicek['kullanici_adres'] ?>">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">İl</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" required name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">İlçe</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" required name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Onay</label>
                                    <div class="checkbox">
                                        <div class="col-sm-9">
                                            <label> <input type="checkbox" required name="kullanici_onay" value="<?php echo $kullanicicek['kullanici_onay'] ?>">Kullanım Şartlarını kabul ediyorum.</label>
                                        </div>
                                    </div>
                                </div>




                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <center><button class="update-btn" name="musterimagazabasvuru">Başvuruyu Tamamla</button></center>

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