<?php

if(isset($_SESSION["kullanici"])){
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
						<td style="color: #FF9900;" colspan="5">
							<h3>Hesabım > Adresler</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" colspan="5" style="border-bottom: 1px dashed #CCCCCC">
							Tüm Adreslerini Bu Alanda Görüntüleyebilir veya Güncelleyebilirsin.
						</td>
					</tr>
					

					<tr height="30">
						<td colspan="1" style="background: #CCCCCC; color: black; font-weight: bold" align="left">
							&nbsp;Adresler
						</td>
						<td colspan="4" style="background: #CCCCCC; color: black; font-weight: bold" align="right">
							<a href="index.php?SK=70" style="text-decoration: none;
							color: black;">+ Yeni Adres Ekle</a>
						</td>
					</tr>

					<?php

					$AdreslerSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE UyeId = ?");
					$AdreslerSorgusu->execute([$KullaniciId]);
					$AdreslerSayisi		=	$AdreslerSorgusu->rowCount();
					$AdreslerKayitlari	=	$AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

					$BirinciRenk	=	"#FFFFFF";
					$IkinciRenk 	=	"#F1F1F1";
					$RenkSayisi		=	1;


					if($AdreslerSayisi>0){

						foreach ($AdreslerKayitlari as $Kayit) {
							if($RenkSayisi % 2){
								$ArkaplanRengi	=	$BirinciRenk;
							}else{
								$ArkaplanRengi	=	$IkinciRenk;
							}

							?>

								<tr height="50" bgcolor="<?php echo $ArkaplanRengi; ?>">
									<td align="left">
										<?php echo $Kayit["AdiSoyadi"] ; ?>
										<?php echo "-" ; ?>
										<?php echo $Kayit["Adres"] ; ?>
										<?php echo $Kayit["Ilce"] ; ?>
										<?php echo "/" ; ?>
										<?php echo $Kayit["Sehir"] ; ?>
										<?php echo "-" ; ?>
										<?php echo $Kayit["TelefonNumarasi"] ; ?>
									</td>
									<td width="10"><i class="fas fa-edit"></i></td>
									<td width="80"><a href="index.php?SK=62&ID=<?php echo $Kayit['id']; ?>" style="text-decoration: none; color: #646464;">Güncelle</a></td>
									<td width="10"><i class="fas fa-trash-alt"></i></td>
									<td width="15"><a href="index.php?SK=67&ID=<?php echo $Kayit['id']; ?>"  style="text-decoration: none; color: #646464;">Sil</a></td>
								</tr>


							<?php
							$RenkSayisi++;
						}
					

					}else{

					?>

						<tr height="50">
							<td align="left" colspan="5">
								Sisteme Kayıtlı Adresiniz Bulunmamaktadır.
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