<?php

require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");



if(isset($_GET["AktivasyonKodu"])){
	$GelenAktivasyonKodu = Guvenlik($_GET["AktivasyonKodu"]);
}else{
	$GelenAktivasyonKodu = "";
}


if(isset($_GET["EmailAdresi"])){
	$GelenEmailAdresi = Guvenlik($_GET["EmailAdresi"]);
}else{
	$GelenEmailAdresi = "";
}



if( ($GelenAktivasyonKodu != "") and ($GelenEmailAdresi != "") ){

	$KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? AND AktivasyonKodu = ? AND Durumu = ?");
	$KontrolSorgusu->execute([$GelenEmailAdresi, $GelenAktivasyonKodu, 0]);
	$KullaniciSayisi = $KontrolSorgusu->rowCount();

	if ($KullaniciSayisi>0){

		$UyeGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE uyeler SET Durumu = ?");
		$UyeGuncellemeSorgusu->execute([1]);
		$Kontrol	=	$UyeGuncellemeSorgusu->rowCount();

		iF($Kontrol > 0){
			header("Location:index.php?SK=30");
			exit();
		}else{
			header("Location:" . $SiteLinki);
			exit();
		}


	}else{
		header("Location:" . $SiteLinki);
		exit();
	}

}else{
	header("Location:" . $SiteLinki);
	exit();
}



$VeritabaniBaglantisi = null;

?>