<?php require_once 'header.php';

$urunsor = $db->prepare("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici on urun.kullanici_id=kullanici.kullanici_id where urun_id=:id and urun_durum=:durum ");

$urunsor->execute(array(
    'id' => $_GET['urun_id'],
    'durum' => 1

));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)

?>
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">

            <h2 style="color:white;"><?php echo $uruncek['urun_ad'] ?></h2>

        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>

            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">

                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%">Ürün Adı</th>
                                    <th style="width:10%">Fiyatı</th>

                                    <th style="width:22%" class="text-center">Satıcı</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><img style="width: 60px;  height:60px" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="" class="img-responsive" /></div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin"><?php echo $uruncek['urun_ad'] ?></h4>
                                                <p><?php echo substr($uruncek['urun_detay'], 0, 150); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price"><?php echo $uruncek['urun_fiyat'] ?> <i class="fa fa-try" style="font-size: 16.5px;" aria-hidden="true"></i></td>
                                    <td data-th="Subtotal" class="text-center"><?php echo $uruncek['kullanici_ad'] . " " . $uruncek['kullanici_soyad'] ?></td>

                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="visible-xs">
                                    <td class="text-center"><strong>Total 1.99</strong></td>
                                </tr>
                                <tr>
                                    <td><button onclick="geridon()" class="btn btn-warning"><i class="fa fa-angle-left"></i> Geri Dön</button></td>
                                    <td colspan="2" class="hidden-xs"></td>


                                    <form action="nedmin/netting/kullanici.php" method="POST">
                                        <input type="hidden" name="kullanici_idsatici" value="<?php echo $uruncek['kullanici_id'] ?>">
                                        <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                                        <input type="hidden" name="urun_fiyat" value="<?php echo $uruncek['urun_fiyat'] ?>">


                                        <td><button type="submit" name="sipariskaydet" class="btn btn-success btn-block">Sipariş Ver <i class="fa fa-angle-right"></i></button></td>

                                    </form>
                                </tr>
                            </tfoot>
                        </table>



                    </div>




                </div>
            </div>


        </div>
    </div>
</div>
<!-- Product Details Page End Here -->
<?php require_once 'footer.php'; ?>

<script type="text/javascript">
    function geridon() {

        window.history.back();
    }
</script>