<?php
try{
	$VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=askontest;charset=UTF8", "root", "");
}catch(PDOException $Hata){
	echo "Bağlantı Hatası<br />" . $Hata->getMessage();//bu alanı hata değerini görmek için açabilirsin
	die();
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * from ayarlar LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayarlar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi > 0){
	$SiteAdi 				= $Ayarlar["SiteAdi"];
	$SiteTitle 				= $Ayarlar["SiteTitle"];
	$SiteDescription 		= $Ayarlar["SiteDescription"];
	$SiteKeywords 			= $Ayarlar["SiteKeywords"];
	$SiteCopyrightMetni		= $Ayarlar["SiteCopyrightMetni"];
	$SiteLogo 				= $Ayarlar["SiteLogo"];
	$SiteEmailAdresi 		= $Ayarlar["SiteEmailAdresi"];
	$SiteEmailSifresi 		= $Ayarlar["SiteEmailSifresi"];
	$SiteEmailHost			= $Ayarlar["SiteEmailHost"];
	$SosyalLinkFacebook 	= $Ayarlar["SosyalLinkFacebook"];
	$SosyalLinkTwitter	 	= $Ayarlar["SosyalLinkTwitter"];
	$SosyalLinkInstagram 	= $Ayarlar["SosyalLinkInstagram"];
	$SosyalLinkLinkedin 	= $Ayarlar["SosyalLinkLinkedin"];
	$SosyalLinkPinterest 	= $Ayarlar["SosyalLinkPinterest"];
	$SosyalLinkYoutube	 	= $Ayarlar["SosyalLinkYoutube"];
	$SiteLinki				= $Ayarlar["SiteLinki"];
}else{
	die();
}


$MetinlerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * from sozlesmelervemetinler LIMIT 1");
$MetinlerSorgusu->execute();
$MetinlerSayisi = $MetinlerSorgusu->rowCount();
$Metinler = $MetinlerSorgusu->fetch(PDO::FETCH_ASSOC);

if($MetinlerSayisi){
	$HakkimizdaMetni			 	= $Metinler["HakkimizdaMetni"];
	$UyelikSozlesmesiMetni		 	= $Metinler["UyelikSozlesmesiMetni"];
	$KullanimKosullariMetni		 	= $Metinler["KullanimKosullariMetni"];
	$GizlilikSozlesmesiMetni	 	= $Metinler["GizlilikSozlesmesiMetni"];
	$MesafeliSatisSözlesmesiMetni	= $Metinler["MesafeliSatisSözlesmesiMetni"];
	$TeslimatMetni				 	= $Metinler["TeslimatMetni"];
	$IptalIadeDegisimMetni		 	= $Metinler["IptalIadeDegisimMetni"];
}else{
	die();
}



if (isset($_SESSION["kullanici"])) {
	$GelenKullanici = $_SESSION["kullanici"];
	$KullaniciSorgusu = $VeritabaniBaglantisi->prepare("SELECT * from uyeler WHERE EmailAdresi = ? LIMIT 1");
	$KullaniciSorgusu->execute([$GelenKullanici]);
	$KullaniciSayisi = $KullaniciSorgusu->rowCount();
	$Kullanici = $KullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

	if($KullaniciSayisi){
		$KullaniciId		= $Kullanici["id"];
		$EmailAdresi		= $Kullanici["EmailAdresi"];
		$Sifre				= $Kullanici["Sifre"];
		$IsimSoyisim		= $Kullanici["IsimSoyisim"];
		$TelefonNumarasi	= $Kullanici["TelefonNumarasi"];
		$Cinsiyet			= $Kullanici["Cinsiyet"];
		$Durumu				= $Kullanici["Durumu"];
		$KayitTarihi		= $Kullanici["KayitTarihi"];
		$KayitIpAdresi		= $Kullanici["KayitIpAdresi"];
		$AktivasyonKodu		= $Kullanici["AktivasyonKodu"];
	}else{
		die();
	}

}


?>