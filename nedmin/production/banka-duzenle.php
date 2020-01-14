<?php

include 'header.php';

// get ile gelen bilgiyi çekme

$bankasor = $db->prepare("SELECT * FROM banka where banka_id=:id");

$bankasor->execute(array(
    'id' => $_GET['banka_id']


));

$bankacek = $bankasor->fetch(PDO::FETCH_ASSOC);



?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Banka Bilgilerini Düzenleyin<small>

                                <?php

                                if ($_GET['durum'] == "ok") { ?>

                                    <b style="color: green;">İşlem Başarılı!</b>

                                <?php } elseif ($_GET['durum'] == "no") { ?>

                                    <b style="color: red;">İşlem Başarısız!</b>

                                <?php
                                }
                                ?>


                            </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        <!-- / => en üst dizine çık  ---- ../ => bir üst dizine çık -->
                        <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Adı: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="banka_ad" value="<?php echo $bankacek['banka_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka İban: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="banka_iban" value="<?php echo $bankacek['banka_iban'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Hesap Adı: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="banka_hesapadsoyad" value="<?php echo $bankacek['banka_hesapadsoyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Durumu: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="banka_durum" required>

                                        <!-- kısa if kullanımı ile select box kullanımı -->

                                        <option value="1" <?php echo $bankacek['banka_durum'] == '1' ? 'selected=""' : ''; ?>> Aktif </option>
                                        <option value="0" <?php echo $bankacek['banka_durum'] == '0' ? 'selected=""' : ''; ?>> Pasif </option>


                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="banka_id" value="<?php echo $bankacek['banka_id'] ?>">

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                    <button type="submit" name="bankaduzenle" class="btn btn-success">Güncelle</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<!-- /page content -->

<?php

include 'footer.php';



?>