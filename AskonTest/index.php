<?php
session_start();
ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once("Ayarlar/sitesayfalari.php");

if(isset($_REQUEST["SK"])){
	$SayfaKoduDegeri = SayiliIcerikleriFiltrele($_REQUEST["SK"]);
}else{
	$SayfaKoduDegeri = 0;
}


if(isset($_REQUEST["SYF"])){
	$Sayfalama	= SayiliIcerikleriFiltrele($_REQUEST["SYF"]);
}else{
	$Sayfalama	= 1;
}


?>

<!DOCTYPE html>
<html lang="tr-TR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Language" content="tr">
	<meta charset="utf-8">
	<meta name="Robots" content="index, follow">
	<meta name="googlebot" content="index, follow">
	<meta name="revisit-after" content="7 Days">
	<title><?php echo $SiteTitle; ?></title>
	<link rel="icon" type="image/png" href="Resimler/gear.png">
	<meta name="description" content="<?php echo DonusumleriGeriDondur($SiteDescription); ?>">
	<meta name="keywords" content="<?php echo DonusumleriGeriDondur($SiteKeywords); ?>">
	<script type="text/javascript" src="Frameworks/JQuery/jquery-3.5.1.min.js" language="javascript"></script>
	<link rel="stylesheet" type="text/css" href="Ayarlar/still.css">
	<script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>

	<link href="Frameworks/fontawesome/css/all.css" rel="stylesheet"><!-- Fontawesome eklentisi -->
</head>
<body>
	<table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		
		<!-- HEADER BAŞLANGICI -->
		<tr height="40" bgcolor="#353745"><!-- Buradaki bgcolor resim yerinde png atıp sadece yazı olan görseller için -->
			<td><img src="Resimler/HeaderMesajResmi.jpg" border="0" ></td>
		</tr>
		<tr>
			<td height="110">
				<table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0" >
					<tr bgcolor="#0088CC">
						<td>&nbsp;</td>
						<?php
						if(isset($_SESSION["kullanici"])){
						?>
						<td width="80" class="MaviAlanMenusu"><a href="index.php?SK=50"><i class="fas fa-user"></i> Hesabım</a></td>
						<!--<td width="70" class="MaviAlanMenusu"><a href="#">Giriş Yap</a></td>-->
						<td width="20" class="MaviAlanMenusu"><a href="index.php?SK=49"><i class="fas fa-sign-out-alt"></i></a></td>
						<td width="40" class="MaviAlanMenusu"><a href="index.php?SK=49">Çıkış</a></td>
						<?php
						}else{
						?>
						<td width="80" class="MaviAlanMenusu"><a href="index.php?SK=31"><i class="fas fa-user"></i> Giriş Yap</a></td>
						<!--<td width="70" class="MaviAlanMenusu"><a href="#">Giriş Yap</a></td>-->
						<td width="20" class="MaviAlanMenusu"><a href="index.php?SK=22"><i class="fas fa-user-plus"></i></a></td>
						<td width="90" class="MaviAlanMenusu"><a href="index.php?SK=22">Yeni Üye Ol</a></td>
						<?php
						}
						?>
						<td width="20" class="MaviAlanMenusu"><a href="#"><i class="fas fa-shopping-basket"></i></a></td>
						<td width="110" class="MaviAlanMenusu"><a href="#">Alışveriş Sepeti</a></td>
					</tr>
				</table>
				<table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0" >
					<tr bgcolor="#CCCCCC">
						<td width="192"><a href="index.php"><img src="<?php echo "Resimler/" . DonusumleriGeriDondur($SiteLogo) ?>" width="192"></a></td>
						<td>
							<table width="873" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>&nbsp;</td>
									<td width="80" class="AnaMenu"><a href="index.php?SK=0"><b>Anasayfa</b></a></td>
									<td width="145" class="AnaMenu"><a href="index.php?SK=84"><b>Erkek Ayakkabıları</b></a></td>
									<td width="145" class="AnaMenu"><a href="index.php?SK=85"><b>Kadın Ayakkabıları</b></a></td>
									<td width="144" class="AnaMenu"><a href="index.php?SK=86"><b>Çocuk Ayakkabıları</b></a></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- HEADER BİTİŞİ -->

		<!-- BANNER VE İÇERİK ALANI BAŞLAGICI -->
		<tr>
			<td valign="top">
				<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
							<?php
								if((!$SayfaKoduDegeri) or ($SayfaKoduDegeri == "") or ($SayfaKoduDegeri == 0)){
									include($Sayfa[0]);
								}else
								{
									include($Sayfa[$SayfaKoduDegeri]);
								}

							?>
							<br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- BANNER VE İÇERİK ALANI BİTİŞİ -->

		<!-- FOOTER BAŞLANGICI -->
		<tr height="210">
			<td>
				<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
					<tr height="30">
						<td width="250" style="border-bottom: 1px dashed #cccccc;"><b>Kurumsal</b></td>
						<td width="22">&nbsp;</td>
						<td width="250" style="border-bottom: 1px dashed #cccccc;"><b>Üyelik Hizmetleri</b></td>
						<td width="22">&nbsp;</td>
						<td width="250" style="border-bottom: 1px dashed #cccccc;"><b>Sözleşmeler</b></td>
						<td width="21">&nbsp;</td>
						<td width="250" style="border-bottom: 1px dashed #cccccc;"><b>Bizi Takip Edin</b></td>
					</tr>

					<tr height="30" class="FooterMenu">
						<td><a href="index.php?SK=1">Hakkımızda</a></td>
						<td>&nbsp;</td>
						
						<?php
						if(isset($_SESSION["kullanici"])){
						?>
						<td><a href="index.php?SK=50">Hesabım</a></td>
						<?php
						}else{
						?>
						<td><a href="index.php?SK=31">Giriş Yap</a></td>
						<?php
						}
						?>
						
						<td>&nbsp;</td>
						<td><a href="index.php?SK=2">Üyelik Sözleşmesi</a></td>
						<td>&nbsp;</td>
						<td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook) ?>" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a></td>
					</tr>

					<tr height="30" class="FooterMenu">
						<td><a href="index.php?SK=8">Banka Hesaplarımız</a></td>
						<td>&nbsp;</td>

						<?php
						if(isset($_SESSION["kullanici"])){
						?>
						<td><a href="index.php?SK=49">Çıkış</a></td>
						<?php
						}else{
						?>
						<td><a href="index.php?SK=22">Yeni Üye ol</a></td>
						<?php
						}
						?>

						<td>&nbsp;</td>
						<td><a href="index.php?SK=3">Kullanım Koşulları</a></td>
						<td>&nbsp;</td>
						<td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkTwitter) ?>" target="_blank"><i class="fab fa-twitter-square"></i> Twitter</a></td>
					</tr>

					<tr height="30" class="FooterMenu">
						<td><a href="index.php?SK=9">Havale Bildirim Formu</a></td>
						<td>&nbsp;</td>
						<td><a href="index.php?SK=21">Sık Sorulan Sorular</a></td>
						<td>&nbsp;</td>
						<td><a href="index.php?SK=4">Gizlilik Sözleşmesi</a></td>
						<td>&nbsp;</td>
						<td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkInstagram) ?>" target="_blank"><i class="fab fa-instagram-square"></i> Instagram</a></td>
					</tr>

					<tr height="30" class="FooterMenu">
						<td><a href="index.php?SK=14">Kargo Nerede?</a></td>
						<td>&nbsp;</td>
						<td></td>
						<td>&nbsp;</td>
						<td><a href="index.php?SK=5">Mesafeli Satış Sözleşmesi</a></td>
						<td>&nbsp;</td>
						<td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkLinkedin) ?>" target="_blank"><i class="fab fa-linkedin"></i> Linkedin</a></td>
					</tr>

					<tr height="30" class="FooterMenu">
						<td><a href="index.php?SK=16">İletişim</a></td>
						<td>&nbsp;</td>
						<td></td>
						<td>&nbsp;</td>
						<td><a href="index.php?SK=6">Teslimat</a></td>
						<td>&nbsp;</td>
						<td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkPinterest) ?>" target="_blank"><i class="fab fa-pinterest-square"></i> Pinterest</a></td>
					</tr>

					<tr height="30" class="FooterMenu">
						<td></td>
						<td>&nbsp;</td>
						<td></td>
						<td>&nbsp;</td>
						<td><a href="index.php?SK=7">İptal & İade & Değişim</a></td>
						<td>&nbsp;</td>
						<td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkYoutube) ?>" target="_blank"><i class="fab fa-youtube-square"></i> Youtube</a></td>
					</tr>


				</table>
			</td>
		</tr>

		<tr height="30">
			<td>
				<table width="1065" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center"><?php echo DonusumleriGeriDondur($SiteCopyrightMetni); ?></td>
					</tr>
				</table>		
			</td>
		</tr>

		<tr height="30">
			<td>
				<table width="1065" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
							<img src="Resimler/rapidSSL.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/internetteguvenliav.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/3d-secure.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/BonusCard.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/MaximumCard.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/WorldCard.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/CardFinans.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/AxessCard.jpg" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/ParafCard.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/visa.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/MasterCard.png" height="18" style="margin-right: 5px;"> 
							<img src="Resimler/AmericanExpress.png" height="18" style="margin-right: 5px;"> 
						</td>

					</tr>
				</table>		
			</td>
		</tr>
		<!-- FOOTER BİTİŞİ -->

	</table>
</body>
</html>

<?php
$VeritabaniBaglantisi = null;
ob_end_flush();
?>