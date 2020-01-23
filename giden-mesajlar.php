<?php require_once 'header.php';

islemkontrol();

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
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">


        <div class="row settings-wrapper">



            <?php require_once 'hesap-sidebar.php'; ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

                <?php

                if ($_GET['durum'] == "hata") { ?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Mesaj silinemedi yöneticiye başvurun.
                    </div>

                <?php } elseif ($_GET['durum'] == "ok") { ?>

                    <div class="alert alert-success">
                        <strong>Bilgi!</strong> Mesaj Silindi.
                    </div>
                <?php  } ?>




                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Giden Mesajlar</h2>
                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mesaj Tarihi</th>
                                        <th scope="col">Alıcı</th>
                                        <th scope="col">Durum</th>
                                        <th scope="col">Detay</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id
                                     where mesaj.kullanici_gon=:id order by mesaj_zaman DESC");

                                    $mesajsor->execute(array(

                                        'id' => $_SESSION['userkullanici_id']

                                    ));
                                    $say = 0;

                                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {
                                        $say++;

                                        $kullanici_gon = $mesajcek['kullanici_gon'];

                                    ?>

                                        <tr>
                                            <th scope="row"><?php echo $say ?></th>
                                            <td><?php echo $mesajcek['mesaj_zaman'] ?></td>
                                            <td><?php echo $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></td>
                                            <td>

                                                <?php

                                                if ($mesajcek['mesaj_okunma'] == 0) { ?>

                                                    <i style="color: #8BC34A" class="fa fa-circle" aria-hidden="true"></td>

                                        <?php } else { ?>

                                            <i class="fa fa-circle" aria-hidden="true"></td>


                                            <?php   }



                                            ?>




                                            <td><a href="mesaj-detay.php?gidenmesaj=ok&mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>&kullanici_gon=<?php echo $mesajcek['kullanici_gon'] ?>"><button class="btn btn-primary btn-xs">Mesajı Oku</button></a></td>
                                            <td> <a onclick="return confirm ('Bu mesajı silmek istiyormusunuz ? \n İşlem Geri alınamaz ... ')" href="nedmin/netting/kullanici.php?gidenmesajsil=ok&mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>"> <button class="btn btn-danger btn-xs">Sil</button></a></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>





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