<?php

if(isset($_GET["AktivasyonKodu"])){
	$GelenAktivasyonKodu	=	Guvenlik($_GET["AktivasyonKodu"]);
}else{
	$GelenAktivasyonKodu	=	"";
}
if(isset($_GET["EmailAdresi"])){
	$GelenEmail				=	Guvenlik($_GET["EmailAdresi"]);
}else{
	$GelenEmail				=	"";
}

if(($GelenAktivasyonKodu != "" ) and ($GelenEmail != "" )){
	$KontrolSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? AND AktivasyonKodu = ?");
	$KontrolSorgusu->execute([$GelenEmail, $GelenAktivasyonKodu]);
	$KullaniciSayisi	=	$KontrolSorgusu->rowCount();
	$KullaniciKaydi		=	$KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

	if($KullaniciSayisi>0){
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="500" valign="top">
			<form action="index.php?SK=44" method="post">
				<input type="hidden" name="AktivasyonKodu" value="<?php echo $GelenAktivasyonKodu ?>">
				<input type="hidden" name="EmailAdresi" value="<?php echo $GelenEmail; ?>">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color: #FF9900;">
							<h3>Şifre Sıfırlama</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #CCCCCC">
							Aşağıdan Hesabına Giriş Şifreni Değiştirebilirsin.
						</td>
					</tr>


					<tr height="30">
						<td valign="bottom" align="left">
							Yeni Şifre(*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="password" name="Sifre" class="InputAlanlari">
						</td>
					</tr>


					<tr height="30">
						<td valign="bottom" align="left">
							Yeni Şifre Tekrar(*)
						</td>
					</tr>

					<tr>
						<td valign="top">
							<input align="left" type="password" name="SifreTekrar" class="InputAlanlari">
						</td>
					</tr>

					

					<tr><td><br /></td></tr>


					<tr height="30">
						<td align="center">
							<input type="submit" value="Şifremi Güncelle" class="YesilButton">
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
						<h3>Yeni Şifre Oluşturma</h3>
					</td>
				</tr>
				<tr height="30">
					<td valign="top" colspan="2" style="border-bottom: 1px dashed #CCCCCC">
						Çalıştırma ve İşleyiş Açıklaması
					</td>
				</tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-cogs"></i></td>
					<td align="left"><b>Bilgi Kontrolu</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Kullanıcının form alanına girmiş olduğu değer veya değerler veri tabanımızda tam detaylı olarak filtrelenerek kontrol edilir. </td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-cogs"></i></td>
					<td align="left"><b>Email Gönderimi ve İçerik</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Bilgi kontrolü başarılı olur ise, kullanıcının veri tabanımızda kayıtlı olan e-mail adresine yeni şifre oluşturma içerikli bir mail gönderilir.</td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-cogs"></i></td>
					<td align="left"><b>Şifre Sıfırlama ve Oluşturma</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Kullanıcı, kendisine iletilen mail içerisindeki "Yeni Şifre Oluştur" metnine tıklayacak olur ise, site yeni şifre oluşturma sayfası açılır ve kullanıcıdan, yeni hesap şifresi oluşturulması istenir.</td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-cogs"></i></td>
					<td align="left"><b>Sonuç</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Kullanıcı yeni oluşturulmuş heap şifresi ile siteye giriş yapmaya hazırdır.</td>
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

}else{
	header("Location:index.php");
	exit();
}

?>