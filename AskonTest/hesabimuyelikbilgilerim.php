<?php

if(isset($_SESSION["kullanici"])){
?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tr>
		<td colspan="3"><hr /></td>
	</tr>
	<tr>
		<td colspan="3">
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
		<td colspan="3"><hr /></td>
	</tr>

	<tr>
		<td width="500" valign="top">
			<form action="index.php?SK=51" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<input type="hidden" name="id" value="<?php echo $KullaniciId; ?>">
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
							<?php echo $IsimSoyisim ; ?>
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Email Adresi</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<?php echo $EmailAdresi ; ?>
						</td>
					</tr>
					
					<tr height="30">
						<td valign="bottom" align="left">
							<b>Telefon Numarası</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<?php echo $TelefonNumarasi ; ?>
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Cinsiyet</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<?php echo $Cinsiyet ; ?>
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
						<td valign="top" align="left">
							<input type="submit" value="Bilgilerimi Güncellemek İstiyorum" class="BilgilerimiGuncelleButtonu">
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