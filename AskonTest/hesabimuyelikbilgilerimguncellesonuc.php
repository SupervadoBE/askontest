<?php

if(isset($_SESSION["kullanici"])){

	if(isset($_POST["id"])){
		$GelenId = Guvenlik($_POST["id"]);
	}else{
		$GelenId = "";
	}

	if(isset($_POST["IsimSoyisim"])){
		$GelenIsimSoyisim = Guvenlik($_POST["IsimSoyisim"]);
	}else{
		$GelenIsimSoyisim = "";
	}

	if(isset($_POST["EmailAdresi"])){
		$GelenEmailAdresi = Guvenlik($_POST["EmailAdresi"]);
	}else{
		$GelenEmailAdresi = "";
	}

	if(isset($_POST["Sifre"])){
		$GelenSifre = Guvenlik($_POST["Sifre"]);
	}else{
		$GelenSifre = "";
	}

	if(isset($_POST["TekrarlananSifre"])){
		$GelenTekrarlananSifre = Guvenlik($_POST["TekrarlananSifre"]);
	}else{
		$GelenTekrarlananSifre = "";
	}

	if(isset($_POST["TelefonNumarasi"])){
		$GelenTelefonNumarasi = Guvenlik($_POST["TelefonNumarasi"]);
	}else{
		$GelenTelefonNumarasi = "";
	}

	if(isset($_POST["Cinsiyet"])){
		$GelenCinsiyet = Guvenlik($_POST["Cinsiyet"]);
	}else{
		$GelenCinsiyet = "";
	}

	$MD5liSifre			=	md5($GelenSifre);





	if( ($GelenEmailAdresi != "") and ($GelenSifre != "") and ($GelenTekrarlananSifre != "") and ($GelenIsimSoyisim != "") and ($GelenCinsiyet != "") and ($GelenTelefonNumarasi != "") ){

		if($GelenSifre != $GelenTekrarlananSifre){
			header("Location:index.php?SK=57");
			exit();
		}else{
			if($GelenSifre == "EskiSifre"){
				$SifreDegistirmeDurumu = 0;
			}else{
				$SifreDegistirmeDurumu = 1;
			}

			if($EmailAdresi != $GelenEmailAdresi){
				$KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ?");
				$KontrolSorgusu->execute([$GelenEmailAdresi]);
				$KullaniciSayisi = $KontrolSorgusu->rowCount();
				if ($KullaniciSayisi>0){
					header("Location:index.php?SK=55");
					exit();
				}else{

				}
			}

			if($SifreDegistirmeDurumu == 1){

				$KullaniciGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE uyeler SET EmailAdresi = ?, Sifre = ?, IsimSoyisim = ?, TelefonNumarasi = ?, Cinsiyet=  ? WHERE id = ?");
				$KullaniciGuncellemeSorgusu->execute([$GelenEmailAdresi, $MD5liSifre, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, $KullaniciId]);

			}else{

				$KullaniciGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE uyeler SET EmailAdresi = ?, IsimSoyisim = ?, TelefonNumarasi = ?, Cinsiyet=  ? WHERE id = ?");
				$KullaniciGuncellemeSorgusu->execute([$GelenEmailAdresi, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, $KullaniciId]);

			}

			$KayitKontrol	=	$KullaniciGuncellemeSorgusu->rowCount();

			if($KayitKontrol > 0){
				$_SESSION["kullanici"] = $GelenEmailAdresi;

			    header("Location:index.php?SK=53");
				exit();
			}else{
				header("Location:index.php?SK=54");
				exit();
			}
			
		}
		

	}else{
		header("Location:index.php?SK=56");
		exit();
	}


}else{
	header("Location:index.php");
	exit();
}
?>