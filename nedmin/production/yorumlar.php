<?php

include 'header.php';


// Belirli veriyi seçme işlemi
$yorumsor = $db->prepare("SELECT * FROM yorumlar order by yorum_onay ASC");

$yorumsor->execute();

?>



<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Yorumlar<small>

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

                        <!-- Tablo İçeriği başlangıç -->

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sıra No</th>
                                    <th>Kullanıcı İd</th>
                                    <th>Ürün Ad</th>
                                    <th>Yorumlar</th>
                                    <th>Yorum Onayı</th>

                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $say = 0;
                                while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++ ?>


                                    <tr>
                                        <td width="30"><?php echo $say ?></td>
                                        <td><?php $kullanici_id = $yorumcek['kullanici_id'];

                                            $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id");

                                            $kullanicisor->execute(array(
                                                'id' => $kullanici_id


                                            ));

                                            $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

                                            echo $kullanicicek['kullanici_adsoyad'];

                                            ?>



                                        </td>
                                        <td><?php


                                            $urun_id = $yorumcek['urun_id'];

                                            $urunsor = $db->prepare("SELECT * FROM urun where urun_id=:id");

                                            $urunsor->execute(array(
                                                'id' => $urun_id


                                            ));

                                            $uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

                                            echo $uruncek['urun_ad'];








                                            ?></td>
                                        <td><?php echo $yorumcek['yorum_detay'] ?></td>
                                        <td>
                                            <center><?php

                                                    if ($yorumcek['yorum_onay'] == 0) { ?>

                                                    <a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id'] ?>&yorum_one=1&yorum_onay=ok "> <button class="btn btn-success btn-xs"> Onayla </button></a>


                                                <?php  } elseif ($yorumcek['yorum_onay'] == 1) { ?>

                                                    <a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id'] ?>&yorum_one=0&yorum_onay=ok"> <button class="btn btn-danger btn-xs"> Kaldır </button></a>


                                                <?php    }





                                                ?></center>
                                        </td>

                                        <td>
                                            <center> <a href="yorum-duzenle.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                                        </td>

                                        <td>
                                            <center><a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorumsil=ok "><button class="btn btn-danger btn-xs">Sil</button></a></center>
                                        </td>

                                    </tr>

                                <?php
                                }

                                ?>




                            </tbody>
                        </table>

                        <!-- Tablo İçeriği bitiş -->

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