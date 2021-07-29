<?php

if(isset($_SESSION["kullanici"])){

	$SayfalamaIcinSolVeSagButonSayisi	=	2;
	$SayfaBasinaGosterilecekKayitSayisi	=	10;

	$ToplamKayitSayisiSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UyeId = ? ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute([$KullaniciId]);
	$ToplamKayitSayisiSorgusu	=	$ToplamKayitSayisiSorgusu->rowCount();

	$SayfalamayaBaslanacakKayitSayisi	=	($Sayfalama * $SayfaBasinaGosterilecekKayitSayisi) - $SayfaBasinaGosterilecekKayitSayisi;

	$BulunanSayfaSayisi			=	ceil($ToplamKayitSayisiSorgusu / $SayfaBasinaGosterilecekKayitSayisi);
?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tr>
		<td><hr /></td>
	</tr>
	<tr>
		<td>
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="203" class="uyelikButonlari"><a href="index.php?SK=50">Üyelik Bilgilerim</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" class="uyelikButonlari"><a href="index.php?SK=58">Adresler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" class="uyelikButonlari"><a href="index.php?SK=59">Favoriler</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" class="uyelikButonlari"><a href="index.php?SK=60">Yorumlar</a></td>
					<td width="10">&nbsp;</td>
					<td width="203" class="uyelikButonlari"><a href="index.php?SK=61">Siparişler</a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><hr /></td>
	</tr>

	<tr>
		<td width="1065" valign="top">
			<form action="index.php?SK=51" method="post">
				<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color: #FF9900;" colspan="4">
							<h3>Hesabım > Favoriler</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" colspan="4" style="border-bottom: 1px dashed #CCCCCC">
							Favorilerinize Eklediğiniz Tüm Ürinleri Bu Alanda Görüntüleyebilirsiniz.
						</td>
					</tr>
					

					<tr height="30">						
						<td width="75" style="background: #CCCCCC; color: black" align="left">
							Resmi
						</td>
						<td width="25" style="background: #CCCCCC; color: black" align="left">
							Sil
						</td>
						<td width="865" style="background: #CCCCCC; color: black" align="left">
							Adı
						</td>
						<td width="100" style="background: #CCCCCC; color: black" align="left">
							Fiyatı
						</td>
					</tr>

					<?php

					$FavorilerSorgusu			=	$VeritabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UyeId = ? ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");  // LİMİT VE SAYFALAMA
					$FavorilerSorgusu->execute([$KullaniciId]);					
					$FavoriSayisi	=	$FavorilerSorgusu->rowCount();
					$FavoriKayitlari	=	$FavorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);



					if($FavoriSayisi>0){

						foreach ($FavoriKayitlari as $FavoriSatirlar) {



							$UrunTuru		=	DonusumleriGeriDondur($SiparisSatirlar["UrunTuru"]);

							if($UrunTuru == "Erkek Ayakkabısı"){
								$ResimKlasoruAdi	=	"Erkek";
							}elseif ($UrunTuru	==	"Kadın Ayakkabısı") {
								$ResimKlasoruAdi	=	"Kadin";
							}else{
								$ResimKlasoruAdi	=	"Cocuk";
							}



						?>

							<tr height="30">
								<td width="75" align="left">
									<img src="Resimler/UrunResimleri/
									<?php 
										echo $ResimKlasoruAdi . "/" . DonusumleriGeriDondur($SiparisSatirlar["UrunResmiBir"]);
									?>
									" border="0" width="60">
								</td>
								<td width="25" align="left">
									&nbsp;&nbsp;<a href="index.php?SK=75&UrunID=<?php echo DonusumleriGeriDondur($SiparisSatirlar["UrunId"]); ?>" style="text-decoration: none; color:#646464;"><i class="fas fa-trash-alt"></i></a>
								</td>
								<td width="865" align="left">
									<?php 
										echo DonusumleriGeriDondur($SiparisSatirlar["UrunAdi"]);
									?>
								</td>
								<td width="100" align="left">
									<?php 
										echo FiyatBicimlendir(DonusumleriGeriDondur($SiparisSatirlar["UrunFiyati"])) . " TRY";
									?>
								</td>
								
								<td valign="top" colspan="4" style="border-bottom: 1px dashed #CCCCCC">
									
								</td>
							</tr>



						<tr height="30">
							<td colspan="4"><hr /></td>
						</tr>
						<?php
						}



						if($BulunanSayfaSayisi > 1){

						?>
						
						<tr height="50">
							<td align="center" colspan="4">
								<div class="SayfalamaAlaniKapsayicisi">
									<div class="SayfalamaAlanaiIciMetinAlaniKapsayicisi">
										Toplam <?= $BulunanSayfaSayisi; ?> sayfada, <?= $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır
									</div>
									<div class="SayfalamaAlanaiIciNumaraAlaniKapsayicisi">
										<?php
											if($Sayfalama > 1){
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=1'><<</a></span>";
												$SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama-1;
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
											}

											for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama - $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= $Sayfalama + $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
												if( ($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi) ){
													if($Sayfalama == $SayfalamaIcinSayfaIndexDegeri){
														echo "<span class='SayfalamaAktif'> " . $SayfalamaIcinSayfaIndexDegeri . " </span>";
													}else{
														echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . " </a></span>";
													}
												}
											}


											if($Sayfalama!=$BulunanSayfaSayisi){
												$SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama+1;
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
											}
										?>
									</div>
								</div>
							</td>
						</tr>
						
						<?php
						}

					}else{

					?>

						<tr height="50">
							<td align="left" colspan="4">
								Sisteme Kayıtlı Favori Ürününüz Bulunmamaktadır.
							</td>
						</tr>

					<?php
					}

					?>
					

				</table>
			</form>
		</td>

	</tr>
</table>

<?php

}else{
	header("Location:index.php");
}
?>