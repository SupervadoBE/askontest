<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST["EmailAdresi"])){
	$GelenEmailAdresi = Guvenlik($_POST["EmailAdresi"]);
}else{
	$GelenEmailAdresi = "";
}

if(isset($_POST["TelefonNumarasi"])){
	$GelenTelefonNumarasi = Guvenlik($_POST["TelefonNumarasi"]);
}else{
	$GelenTelefonNumarasi = "";
}

if( ($GelenEmailAdresi != "") or ($GelenSifre != "") ){

	$KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? OR TelefonNumarasi = ?");
	$KontrolSorgusu->execute([$GelenEmailAdresi, $GelenTelefonNumarasi]);
	$KullaniciSayisi = $KontrolSorgusu->rowCount();
	$KullaniciKaydi = $KontrolSorgusu->fetch(PDO::FETCH_ASSOC);


	if($KullaniciSayisi>0){

		
		$MailGonder = new PHPMailer(true);

		try
		{
			//Server settings
			$MailGonder->SMTPDebug = 0;                     				 // SMTP::DEBUG_SERVER <- yazarsak -> Enable verbose debug output
			$MailGonder->isSMTP();                                            // Send using SMTP
			$MailGonder->Host       = DonusumleriGeriDondur($SiteEmailHost);                   	   // Set the SMTP server to send through
			$MailGonder->SMTPAuth   = true;														   // Enable SMTP authentication
			$MailGonder->charSet 	= "UTF-8";
			$MailGonder->Username   = DonusumleriGeriDondur($SiteEmailAdresi);                     // SMTP username
			$MailGonder->Password   = DonusumleriGeriDondur($SiteEmailSifresi);                    // SMTP password
			$MailGonder->SMTPSecure = 'tls';         //  PHPMailer::ENCRYPTION_STARTTLS  <- yazarsak -> Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$MailGonder->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			$MailGonder->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
					)
				);
			//Recipients
			$MailGonder->setFrom(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));
			$MailGonder->addAddress(DonusumleriGeriDondur($GelenEmailAdresi), DonusumleriGeriDondur($KullaniciKaydi['IsimSoyisim']));     // Add a recipient
			$MailGonder->addReplyTo(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));
			// Content
			$MailGonder->isHTML(true);                                  // Set email format to HTML
			$MailGonder->Subject = DonusumleriGeriDondur($SiteAdi) . ' Yeni Üyelik Aktivasyonu ';
			$MailGonder->Body    = "Merhaba Sayın	" . $KullaniciKaydi['IsimSoyisim'] ."<br /><br />Sitemiz üzerinde bulunan hesabınızın şifresini sıfırlamak için lütfen <a herf='" . $SiteLinki . "/index.php?SK=43&AktivasyonKodu=" . $KullaniciKaydi['AktivasyonKodu'] . "&EmailAdresi=" . $GelenEmailAdresi . "'>BURAYA TIKLAYINIZ</a> <br /><br /> Saygılarımızla İyi Çalışmalar...<br />" . $SiteAdi;

			$MailGonder->send();
			header("Location:index.php?SK=39");
			exit();
		} 
		catch (Exception $e) 
		{
			header("Location:index.php?SK=40");
			exit();
		}




	}else{
		header("Location:index.php?SK=41");
		exit();
	}
}else{
	header("Location:index.php?SK=42");
	exit();
}


?>