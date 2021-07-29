<?php

if(isset($_SESSION["kullanici"])){
?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="500" valign="top">
			<form action="index.php?SK=71" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color: #FF9900;">
							<h3>Hesabım > Adresler</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #CCCCCC">
							Tüm Adreslerini Bu Alanda Görüntüleyebilir veya Güncelleyebilirsin.
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>İsim Soyisim (*)</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="IsimSoyisim" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Adres (*)</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="Adres" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>İlçe (*)</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="Ilce" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Şehir (*)</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="Sehir" class="InputAlanlari" >
						</td>
					</tr>
					
					<tr height="30">
						<td valign="bottom" align="left">
							<b>Telefon Numarası (*)</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="tel" name="TelefonNumarasi" class="InputAlanlari" >
						</td>
					</tr>

					<tr height="40">
						<td align="center">
							<input type="submit" class="YesilButton" value="Adresi Kaydet">
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
	exit();
}
?>