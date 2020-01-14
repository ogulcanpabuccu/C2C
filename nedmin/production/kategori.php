<?php

include 'header.php';


// Belirli veriyi seçme işlemi
$kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC");

$kategorisor->execute();

?>



<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kategoriler<small>

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
                        <div align="right"> <a href="kategori-ekle.php"><button style="margin-top: 5px;" class="btn btn-success btn-xs ">Yeni Ekle</button></a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- Tablo İçeriği başlangıç -->

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sıra No</th>
                                    <th>Kategori Adı</th>
                                    <th>Kategori Sıra</th>
                                    <th>Kategori Durum</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $say = 0;
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++ ?>


                                    <tr>
                                        <td width="30"><?php echo $say ?></td>
                                        <td><?php echo $kategoricek['kategori_ad'] ?></td>
                                        <td><?php echo $kategoricek['kategori_sira'] ?></td>
                                        <td>

                                            <center>
                                                <?php
                                                //if ile button çektirme
                                                if ($kategoricek['kategori_durum'] == 1) { ?>


                                                    <button class="btn btn-success btn-xs"> Aktif </button>


                                                <?php  } else { ?>


                                                    <button class="btn btn-danger btn-xs"> Pasif </button>

                                                <?php } ?>

                                            </center>

                                        </td>
                                        <td>
                                            <center> <a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center>
                                        </td>

                                        <td>
                                            <center><a href="../netting/islem.php?kategori_id= <?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok "><button class="btn btn-danger btn-xs">Sil</button></a></center>
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