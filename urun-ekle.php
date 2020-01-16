<?php require_once 'header.php';

islemkontrol();

?>



<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">Anasayfa</a><span> -</span></li>
                <li>Adres Bilgilerim</li>
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
                <?php  }  ?>


                <form action="nedmin/netting/adminislem.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="personal-info-form">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Ürün Ekleme</h2>
                            <div class="personal-info inner-page-padding">


                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Fotoğraf</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="urunfoto_resimyol">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select name="kategori_id" class='select2'>
                                                <?php
                                                $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC");

                                                $kategorisor->execute();

                                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                                ?>

                                                    <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>







                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Adı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" required name="urun_ad" placeholder="Ürün Adını giriniz.">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Açıklama</label>
                                    <div class="col-sm-9">


                                        <textarea class="ckeditor" id="editor1" name="urun_detay" placeholder="Ürün Açıklamasını giriniz."></textarea>


                                    </div>
                                </div>

                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1',

                                        {

                                            filebrowserBrowseUrl: 'ckfinder/ckfinder.html',

                                            filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',

                                            filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',

                                            filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                                            filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                                            filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                                            forcePasteAsPlainText: true

                                        }

                                    );
                                </script>
                                <div class="form-group ">
                                    <label class="col-sm-3 control-label">Fiyat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" required name="urun_fiyat" placeholder="Ürün Fiyatını giriniz.">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <center><button class="update-btn" name="magazaurunekle">Ürünü Ekle</button></center>
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