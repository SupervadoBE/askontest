<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr height ="50" bgcolor="#FF9900">
		<td align="left"><h2 style="color:white;">&nbsp;BANKA HESAPLARIMIZ</h2></td>
	</tr>
	<tr height ="50">
		<td align="left" style="border-bottom: 1px dashed #CCCCCC;">&nbsp;Ödemeleriniz İçin Çalışmakta Olduğumuz Tüm Banka Hesap Bilgileri Aşağıdadır.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="left">

			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>


					<?php
					$BankalarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz");
					$BankalarSorgusu->execute();
					$BankaSayısı = $BankalarSorgusu->rowCount();
					$BankaKayitlari = $BankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

					$DonguSayisi = 1;
					$SutunAdetSayisi =3;

					foreach ($BankaKayitlari as $kayit) {
					?>

					<td width="348">
						<table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid black; margin-bottom: 10px">
							<tr height="50">
								<td colspan="4" align="center">
									<img src="Resimler/<?php echo DonusumleriGeriDondur($kayit["BankaLogosu"]); ?>" height="30">
								</td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td width="80"><b>Banka Adı</b></td>
								<td width="10"><b>:</b></td>
								<td width="253"><?php echo DonusumleriGeriDondur($kayit["BankaAdi"]); ?></td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td><b>Konum</b></td>
								<td><b>:</b></td>
								<td><?php echo $kayit["KonumSehir"]; ?>/<?php echo DonusumleriGeriDondur($kayit["KonumUlke"]); ?></td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td><b>Şube</b></td>
								<td><b>:</b></td>
								<td><?php echo $kayit["SubeAdi"]; ?>/<?php echo DonusumleriGeriDondur($kayit["SubeKodu"]); ?></td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td><b>Birim</b></td>
								<td><b>:</b></td>
								<td><?php echo DonusumleriGeriDondur($kayit["ParaBirimi"]); ?></td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td><b>Hesap Adı</b></td>
								<td><b>:</b></td>
								<td><?php echo DonusumleriGeriDondur($kayit["HesapSahibi"]); ?></td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td><b>Hesap No</b></td>
								<td><b>:</b></td>
								<td><?php echo DonusumleriGeriDondur($kayit["HesapNumarasi"]); ?></td>
							</tr>
							<tr height="25">
								<td width="5">&nbsp;</td>
								<td><b>İBAN no</b></td>
								<td><b>:</b></td>
								<td><?php echo IBANBicimlendir(DonusumleriGeriDondur($kayit["IbanNumarasi"])); ?></td>
							</tr>
						</table>
					</td>
					<?php
						if($DonguSayisi<$SutunAdetSayisi){
						?>
						<td width="10">&nbsp;</td>
						<?php
						}
					?>

					<?php
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