<?php

if(isset($_SESSION["kullanici"])){
	if(isset($_GET["UrunID"])){
		$GelenUrunID	=	Guvenlik($_GET["UrunID"]);
	}else{
		$GelenUrunID	=	"";
	}

	if($GelenUrunID != ""){
?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="500" valign="top">
			<form action="index.php?SK=76&UrunID=<?= $GelenUrunID; ?>" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color: #FF9900;">
							<h3>Hesabım > Yorum Yap</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #CCCCCC">
							Satın Almış Olduğunuz Ürin İle Alakalı Aşağıdan Yorumunu Belirtebilirsin.
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Puanlama</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="80"><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></td>
									<td width="25"></td>
									<td width="80"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></td>
									<td width="25"></td>
									<td width="80"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></td>
									<td width="25"></td>
									<td width="80"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></td>
									<td width="25"></td>
									<td width="80"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
								</tr>
								<tr>
									<td width="80" align="center"><input type="radio" name="Puan" value="1"></td>
									<td width="25">&nbsp;</td>
									<td width="80" align="center"><input type="radio" name="Puan" value="2"></td>
									<td width="25">&nbsp;</td>
									<td width="80" align="center"><input type="radio" name="Puan" value="3"></td>
									<td width="25">&nbsp;</td>
									<td width="80" align="center"><input type="radio" name="Puan" value="4"></td>
									<td width="25">&nbsp;</td>
									<td width="80" align="center"><input type="radio" name="Puan" value="5"></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							<b>Yorum Metni</b>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<textarea name="Yorum" class="YorumIcinTextAreaAlanlari"></textarea>
						</td>
					</tr>

					<tr height="30">
						<td valign="top" align="center">
							<input type="submit" name="Guncelle" class="YesilButton" value="Yorumu Gönder">
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
						<h3>Reklam</h3>
					</td>
				</tr>
				<tr height="30">
					<td valign="top" colspan="2" style="border-bottom: 1px dashed #CCCCCC">
						Supervado Reklamları
					</td>
				</tr>

				<tr>
					<td><img src="Resimler/testter.jpg"></td>
				</tr>

			</table>
		</td>
	</tr>
</table>

<?php
	}else{
		header("Location:index.php?SK=78");
	}

}else{
	header("Location:index.php");
}
?>