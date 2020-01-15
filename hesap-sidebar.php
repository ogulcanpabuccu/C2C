  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
      <ul class="settings-title">
          <li class="active"><a href="javascript:void(0)"> <b>ÜYE İŞLEMLERİ</b></a></li>
          <?php
            if ($kullanicicek['kullanici_magaza'] != 2) { ?>
              <li><a href="magaza-basvuru">Mağaza Başvuru</a></li>

          <?php } ?>
          <li><a href="hesabim">Siparişlerim</a></li>
          <li><a href="hesabim">Hesap Bilgilerim</a></li>
          <li><a href="adres-bilgileri">Adres Bilgilerim</a></li>
          <li><a href="sifre-guncelle">Şifre Değiştir</a></li>


      </ul>
      <?php
        if ($kullanicicek['kullanici_magaza'] == 2) { ?>
          <hr>

          <ul class="settings-title">
              <li class="active"><a href="javascript:void(0)"> <b>MAĞAZA İŞLEMLERİ</b></a></li>
              <li><a href="magaza-basvuru">Ürün Ekle</a></li>
              <li><a href="hesabim">Ürünlerim</a></li>
              <li><a href="adres-bilgileri">Yeni Siparişler</a></li>
              <li><a href="sifre-guncelle">Tamamlanan Siparişler</a></li>
              <li><a href="sifre-guncelle">Mesajlar</a></li>
              <li><a href="sifre-guncelle">Ayarlar</a></li>

          </ul>
      <?php } ?>
  </div>