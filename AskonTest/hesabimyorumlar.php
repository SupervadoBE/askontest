<?php

if(isset($_SESSION["kullanici"])){

	$SayfalamaIcinSolVeSagButonSayisi	=	2;
	$SayfaBasinaGosterilecekKayitSayisi	=	10;

	$ToplamKayitSayisiSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UyeId = ? ORDER BY YorumTarihi DESC");
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
						<td style="color: #FF9900;" colspan="2">
							<h3>Hesabım > Yorumlar</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" colspan="2" style="border-bottom: 1px dashed #CCCCCC">
							Tüm Yorumlarınızı Bu Alanda Görüntüleyebilirsiniz.
						</td>
					</tr>
					

					<tr height="30">
						<td width="125" style="background: #CCCCCC; color: black" align="left">
							&nbsp;Puan
						</td>
						<td width="75" style="background: #CCCCCC; color: black" align="left">
							Yorum
						</td>
					</tr>

					<?php

					$YorumlarSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UyeId = ? ORDER BY YorumTarihi DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");  // LİMİT VE SAYFALAMA
					$YorumlarSorgusu->execute([$KullaniciId]);
					$YorumlarSayisi		=	$YorumlarSorgusu->rowCount();
					$YorumlarKayitlari	=	$YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);



					if($YorumlarSayisi>0){

						foreach ($YorumlarKayitlari as $Satirlar) {


							?>

							<tr height="40">

								<td width="80" align="left" style="border-bottom: 1px dashed #CCCCCC; padding-top: 10px;" valign="top">
									<?php
									$VerilenPuan = $Satirlar["Puan"];
									if($VerilenPuan == 1){
										?>
										<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
										<?php
									}elseif($VerilenPuan == 2){
										?>
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
										<?php
									}elseif($VerilenPuan == 3){
										?>
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
										<?php
									}elseif($VerilenPuan == 4){
										?>
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
										<?php
									}else{
										?>
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
										<?php
									}
									?>
								</td>

								<td width="985" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 10px 0px;" valign="top">
									<?php 
										echo DonusumleriGeriDondur($Satirlar["YorumMetni"]);
									?>
								</td>
		
							</tr>


							<?php
							}

						if($BulunanSayfaSayisi > 1){

						?>
						
						<tr height="50">
							<td align="center" colspan="2">
								<div class="SayfalamaAlaniKapsayicisi">
									<div class="SayfalamaAlanaiIciMetinAlaniKapsayicisi">
										Toplam <?= $BulunanSayfaSayisi; ?> sayfada, <?= $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır
									</div>
									<div class="SayfalamaAlanaiIciNumaraAlaniKapsayicisi">
										<?php
											if($Sayfalama > 1){
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=1'><<</a></span>";
												$SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama-1;
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
											}

											for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama - $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= $Sayfalama + $SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
												if( ($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi) ){
													if($Sayfalama == $SayfalamaIcinSayfaIndexDegeri){
														echo "<span class='SayfalamaAktif'> " . $SayfalamaIcinSayfaIndexDegeri . " </span>";
													}else{
														echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . " </a></span>";
													}
												}
											}


											if($Sayfalama!=$BulunanSayfaSayisi){
												$SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama+1;
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
							<td align="left" colspan="2">
								Sisteme Kayıtlı Yorum Bulunmamaktadır.
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