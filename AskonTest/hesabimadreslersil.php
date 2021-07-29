<?php
if(isset($_SESSION["kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	guvenlik($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID != ""){
		$AdresSilmeSorgusu	=	$VeritabaniBaglantisi->prepare("DELETE FROM adresler WHERE id = ?");
		$AdresSilmeSorgusu->execute([$GelenID]);
		$AdresSilmeSayisi	=	$AdresSilmeSorgusu->rowCount();

		if($AdresSilmeSayisi > 0){
			header("Location:index.php?SK=68");
			exit();
		}else{
			header("Location:index.php?SK=69");
			exit();
		}



	}else{
		header("Location:index.php?SK=69");
		exit();
	}

}else{
	header("Location:index.php");
	exit();
}
?>