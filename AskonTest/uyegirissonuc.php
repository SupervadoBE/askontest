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

if(isset($_POST["Sifre"])){
	$GelenSifre = Guvenlik($_POST["Sifre"]);
}else{
	$GelenSifre = "";
}


$MD5liSifre			=	md5($GelenSifre);



if( ($GelenEmailAdresi != "") and ($GelenSifre != "") ){
	$KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? AND Sifre = ?");
	$KontrolSorgusu->execute([$GelenEmailAdresi, $MD5liSifre]);
	$KullaniciSayisi = $KontrolSorgusu->rowCount();
	$KullaniciKaydi = $KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

	if($KullaniciSayisi>0){
		
		if($KullaniciKaydi['Durumu'] == 1){
			
			$_SESSION["kullanici"] = $GelenEmailAdresi;
			
			if($_SESSION["kullanici"] == $GelenEmailAdresi){
				header("Location:index.php?SK=50");
				exit();
			}else{
				header("Location:index.php?SK=33");
				exit();
			}

		}else{
			
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
				$MailGonder->Subject = DonusumleriGeriDondur($SiteAdi) . ' Yeni ??yelik Aktivasyonu ';
				$MailGonder->Body    = "Merhaba Say??n	" . $KullaniciKaydi['IsimSoyisim'] ."<br /><br />Sitemize yapm???? oldugunuz ??yelik kayd??n?? tamalamak i??in l??tfen <a herf='" . $SiteLinki . "/aktivasyon.php?AktivasyonKodu=" . $KullaniciKaydi['AktivasyonKodu'] . "&EmailAdresi=" . $GelenEmailAdresi . "'>BURAYA TIKLAYINIZ</a> <br /><br /> Sayg??lar??m??zla ??yi ??al????malar...<br />" . $SiteAdi;

				$MailGonder->send();
				header("Location:index.php?SK=36");
				exit();
			} 
			catch (Exception $e) 
			{
				header("Location:index.php?SK=33");
				exit();
			}

		}


	}else{
		header("Location:index.php?SK=34");
		exit();
	}


}else{
	header("Location:index.php?SK=35");
	exit();
}


?>