<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST["EmailAdresi"])){
	$GelenEmailAdresi	= Guvenlik($_POST["EmailAdresi"]);
}else{
	$GelenEmailAdresi	= "";
}

if(isset($_POST["AktivasyonKodu"])){
	$GelenAktivasyonKodu = Guvenlik($_POST["AktivasyonKodu"]);
}else{
	$GelenAktivasyonKodu = "";
}

if(isset($_POST["Sifre"])){
	$GelenSifre = Guvenlik($_POST["Sifre"]);
}else{
	$GelenSifre = "";
}

if(isset($_POST["SifreTekrar"])){
	$GelenTekrarlananSifre = Guvenlik($_POST["SifreTekrar"]);
}else{
	$GelenTekrarlananSifre = "";
}

$MD5liSifre			=	md5($GelenSifre);



if( ($GelenSifre != "") and ($GelenTekrarlananSifre != "") and ($GelenEmailAdresi != "")and ($GelenAktivasyonKodu != "") ){
	if($GelenSifre != $GelenTekrarlananSifre){
		header("Location:index.php?SK=47");
		exit();


	}else{
		$UyeGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE uyeler SET Sifre = ? WHERE EmailAdresi = ? AND AktivasyonKodu = ? LIMIT 1");
		$UyeGuncellemeSorgusu->execute([$MD5liSifre, $GelenEmailAdresi, $GelenAktivasyonKodu]);
		$Kontrol	=	$UyeGuncellemeSorgusu->rowCount();

		iF($Kontrol > 0){
			header("Location:index.php?SK=45");
			exit();
		}else{
			header("Location:index.php?SK=46");
			exit();
		}

	}

}else{
	header("Location:index.php?SK=48");
	exit();
}


?>