<?php
if(isset($_GET["MenuID"])){
	$GelenMenuID	=	$_GET['MenuID'];
}else{
	$GelenMenuID	=	"";
}

?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="250" align="left" valign="top">
			<table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height = "50">
								<td bgcolor="#F1F1F1"><b>&nbsp;MENÜLER</b></td>
							</tr>
							
							<tr height="30">
								<td><a href="index.php?SK=84" style="text-decoration: none; <?php if($GelenMenuID == ""){ ?> color: #FF9900; <?php }else{ ?> color: #646464; <?php } ?> font-weight: bold;">&nbsp;Tüm Ürünler (xxx)</a></td>
							</tr>
							
							<?php
							$MenulerSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM menuler WHERE UrunTuru = 'Erkek Ayakkabısı' ORDER BY MenuAdi ASC");
							$MenulerSorgusu->execute();
							$MenulerKayitSayisi	=	$MenulerSorgusu->rowCount();
							$MenuKayitlari		=	$MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

							foreach($MenuKayitlari as $Menu){
							?>
								<tr height="30">
									<td><a href="index.php?SK=84&MenuID=<?php echo $Menu["id"]; ?>" style="text-decoration: none; <?php if($GelenMenuID == $Menu["id"]){ ?> color: #FF9900; <?php }else{ ?> color: #646464; <?php } ?> font-weight: bold;">&nbsp;<?php echo DonusumleriGeriDondur($Menu["MenuAdi"]); ?> (<?php echo DonusumleriGeriDondur($Menu["UrunSayisi"]); ?>)</a></td>
								</tr>

							<?php
							}
							?>

						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td> <!-- Banner Sistemi -->

						<table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height = "50">
								<td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
							</tr>
							
							<?php
							$BannerSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM bannerlar WHERE BannerAlani = 'Manu Altı' ORDER BY GosterimSayisi ASC LIMIT 1");
							$BannerSorgusu->execute();
							$BannerSayisi		=	$BannerSorgusu->rowCount();
							$BannerKaydi		=	$BannerSorgusu->fetch(PDO::FETCH_ASSOC);

							?>

							<tr height="30">
								<td><img src="Resimler/<?= $BannerKaydi['BannerResmi'] ?>" border="0"></td>
							</tr>

							<?php
							$BannerGuncelle		=	$VeritabaniBaglantisi->prepare("UPDATE bannerlar SET GosterimSayisi=GosterimSayisi+1 WHERE id = ? LIMIT 1");
							$BannerGuncelle->execute([$BannerKaydi['id']]);
							?>

						</table>

					</td>
				</tr>
			</table>
		</td>
		<td width="10" align="left">&nbsp;</td>
		<td width="805" align="left" valign="top"> <!-- Ürünler  -->
			<table width="805" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>  <!-- Arama Alanı -->
					<td>
						<div class="AramaAlani">
							<form action="index.php?SK=84" method="post">
								
								<div class="AramaAlaniButtonKapsamaAlani">
									<input type="submit" value="" name="" class="AramaAlaniButtonu">
								</div>
								
								<div class="AramaAlaniInputKapsamaAlani">
									<input type="text" name="Arama" class="AramaAlaniInputu">
								</div>

							</form>
						</div>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>  <!-- Ürün Kartları -->
					<td>
						<table width="805" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<?php
								$UrunlarSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE UrunTuru = 'Erkek Ayakkabısı' AND Durumu = '1' ORDER BY id DESC");
								$UrunlarSorgusu->execute();
								$UrunlerSayisi	=	$UrunlarSorgusu->rowCount();
								$UrunKayitlari	=	$UrunlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

								$DonguSayisi	=	1;
								$SutunAdetSayisi=	4;

								foreach($UrunKayitlari as $kayit){
								?>
								<td width="190">
									<table width="190" align="left" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
										<tr>
											<td align="center"><img src="Resimler/UrunResimleri/Erkek/<?php echo DonusumleriGeriDondur($kayit['UrunResmiBir']); ?>" border=0 width="185"></td>
										</tr>
										<tr height="25">
											<td>ASDASDAS</td>
										</tr>
									</table>
								</td>
								<?php
									if($DonguSayisi<$SutunAdetSayisi){
										?>
										<td width="15">&nbsp;</td>
										<?php
									}
									$DonguSayisi++;
									if($DonguSayisi>$SutunAdetSayisi){
										echo "</tr><tr>";
										$DonguSayisi = 1;
									}
								}
								?>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>