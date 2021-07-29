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

if(isset($_POST["TekrarlananSifre"])){
	$GelenTekrarlananSifre = Guvenlik($_POST["TekrarlananSifre"]);
}else{
	$GelenTekrarlananSifre = "";
}

if(isset($_POST["IsimSoyisim"])){
	$GelenIsimSoyisim = Guvenlik($_POST["IsimSoyisim"]);
}else{
	$GelenIsimSoyisim = "";
}

if(isset($_POST["Cinsiyet"])){
	$GelenCinsiyet = Guvenlik($_POST["Cinsiyet"]);
}else{
	$GelenCinsiyet = "";
}

if(isset($_POST["TelefonNumarasi"])){
	$GelenTelefonNumarasi = Guvenlik($_POST["TelefonNumarasi"]);
}else{
	$GelenTelefonNumarasi = "";
}

if(isset($_POST["SozlesmeOnay"])){
	$GelenSozlesmeOnay = Guvenlik($_POST["SozlesmeOnay"]);
}else{
	$GelenSozlesmeOnay = "";
}

$AktivasyonKodu		=	AktivasyonKoduUret();
$MD5liSifre			=	md5($GelenSifre);



if( ($GelenEmailAdresi != "") and ($GelenSifre != "") and ($GelenTekrarlananSifre != "") and ($GelenIsimSoyisim != "") and ($GelenCinsiyet != "") and ($GelenTelefonNumarasi != "") ){
	if($GelenSozlesmeOnay==0){
		header("Location:index.php?SK=29");
		exit();
	}else{
		if($GelenSifre != $GelenTekrarlananSifre){
			header("Location:index.php?SK=28");
			exit();
		}else{
			$KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ?");
			$KontrolSorgusu->execute([$GelenEmailAdresi]);
			$KullaniciSayisi = $KontrolSorgusu->rowCount();

			if ($KullaniciSayisi>0){
				header("Location:index.php?SK=27");
				exit();
			}else{
				$UyeEklemeSorgusu = $VeritabaniBaglantisi->prepare("INSERT INTO uyeler(EmailAdresi, Sifre, IsimSoyisim, TelefonNumarasi, Cinsiyet, Durumu, KayitTarihi, KayitIpAdresi, AktivasyonKodu) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$UyeEklemeSorgusu->execute([$GelenEmailAdresi, $MD5liSifre, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, 0, $ZamanDamgasi, $IPAdresi, $AktivasyonKodu]);
				$KayitKontrol	=	$UyeEklemeSorgusu->rowCount();

				if($KayitKontrol > 0){


					$MailGonder = new PHPMailer(true);

					try {
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
					    $MailGonder->addAddress(DonusumleriGeriDondur($GelenEmailAdresi), DonusumleriGeriDondur($GelenIsimSoyisim));     // Add a recipient

					    $MailGonder->addReplyTo(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));

					    // Content
					    $MailGonder->isHTML(true);                                  // Set email format to HTML
					    $MailGonder->Subject = DonusumleriGeriDondur($SiteAdi) . ' Yeni Üyelik Aktivasyonu ';
					    $MailGonder->Body    = "Merhaba Sayın	" . $GelenIsimSoyisim ."<br /><br />Sitemize yapmış oldugunuz üyelik kaydını tamalamak için lütfen <a herf='" . $SiteLinki . "/aktivasyon.php?AktivasyonKodu=" . $AktivasyonKodu . "&EmailAdresi=" . $GelenEmailAdresi . "'>BURAYA TIKLAYINIZ</a> <br /><br /> Saygılarımızla İyi Çalışmalar...<br />" . $SiteAdi;

					    $MailGonder->send();

					    header("Location:index.php?SK=24");
						exit();

					} catch (Exception $e) {
					    header("Location:index.php?SK=25");
						exit();
					}

				}else{
					header("Location:index.php?SK=25");
					exit();
				}
			}
		}
	}

}else{
	header("Location:index.php?SK=26");
	exit();
}


?>