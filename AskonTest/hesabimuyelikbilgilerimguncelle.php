<?php

if(isset($_SESSION["kullanici"])){
?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="500" valign="top">
			<form action="index.php?SK=52" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color: #FF9900;">
							<h3>Hesabım > Üyelik Bilgileri</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #CCCCCC">
							Aşağıdan Üyelik Bilgilerini Görüntüleyebilir veya Güncelleyebilirsin.
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>İsim Soyisim</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="IsimSoyisim" value="<?php echo $IsimSoyisim ; ?>" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Email Adresi</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="Email" name="EmailAdresi" value="<?php echo $EmailAdresi ; ?>" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Şifre</b> Bu Bölgeyi Şifrenizi Değiştirmek İstiyorsanız Doldurun (*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="password" name="Sifre" class="InputAlanlari" value="EskiSifre" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Tekrar Şifre</b> Bu Bölgeyi Şifrenizi Değiştirmek İstiyorsanız Doldurun (*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="password" name="TekrarlananSifre" class="InputAlanlari" value="EskiSifre" >
						</td>
					</tr>
					
					<tr height="30">
						<td valign="bottom" align="left">
							<b>Telefon Numarası</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="tel" name="TelefonNumarasi" value="<?php echo $TelefonNumarasi ; ?>" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Cinsiyet</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<select name="Cinsiyet" class="SelectAlanlari">
								<option value="Erkek" <?php if($Cinsiyet=="Erkek"){ ?> selected="selected"; <?php } ?>>Erkek</option>
								<option value="Kadın" <?php if($Cinsiyet=="Kadın"){ ?> selected="selected"; <?php } ?>>Kadın</option>
							</select>
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Kayıt Tarihi</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<?php echo TarihBul($KayitTarihi) ; ?>
						</td>
					</tr>

					<tr height="30">
						<td valign="top" align="center">
							<input type="submit" name="Guncelle" class="BilgilerimiGuncelleButtonu" value="Bilgilerimi Güncelle">
						</td>
					</tr>

				</table>
			</form>
		</td>

		<td width="20">
			&nbsp;
		</td>




		<td width="545" valign="top">
			<table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td style="color: #FF9900;" colspan="2">
						<h3>Reklam</h3>
					</td>
				</tr>
				<tr height="30">
					<td valign="top" colspan="2" style="border-bottom: 1px dashed #CCCCCC">
						Supervado Reklamları
					</td>
				</tr>

				<tr>
					<td><img src="Resimler/testter.jpg"></td>
				</tr>

			</table>
		</td>
	</tr>
</table>

<?php

}else{
	header("Location:index.php");
}
?>