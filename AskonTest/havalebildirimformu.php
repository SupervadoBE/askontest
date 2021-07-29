<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="500" valign="top">
			<form action="index.php?SK=10" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color: #FF9900;">
							<h3>Havale Bildirim Formu</h3>
						</td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #CCCCCC">
							Tamamlanmış Olan Ödeme İşleminizi Aşağıdaki Formadan İletiniz
						</td>
					</tr>
					
					<tr height="30">
						<td valign="bottom" align="left">
							İsim Soyisim(*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="IsimSoyisim" class="InputAlanlari">
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							Email Adresi(*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="EmailAdresi" class="InputAlanlari">
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							Telefon Numarası(*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<input type="text" name="TelefonNumarasi" maxlength="11" class="InputAlanlari">
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							Ödeme Yapılan Banka(*)
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<select name="BankaSecimi" class="SelectAlanlari">
								<?php
									$BankalarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz ORDER BY BankaAdi ASC");
									$BankalarSorgusu->execute();
									$BankaSayisi = $BankalarSorgusu->rowCount();
									$BankalarKayitlari = $BankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

									foreach ($BankalarKayitlari as $Bankalar) {
									
								?>
								<option value="<?php echo $Bankalar["id"]; ?>"><?php echo DonusumleriGeriDondur($Bankalar["BankaAdi"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>

					<tr height="30">
						<td valign="bottom" align="left">
							Açıklama
						</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left">
							<textarea name="Aciklama" class="TextAreaAlanlari"></textarea>
						</td>
					</tr>

					<tr height="30">
						<td align="center">
							<input type="submit" value="Bildirimi Gönder" class="YesilButton">
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
						<h3>İşleyiş</h3>
					</td>
				</tr>
				<tr height="30">
					<td valign="top" colspan="2" style="border-bottom: 1px dashed #CCCCCC">
						Havale / EFT İşlemlerinin Kontrolü
					</td>
				</tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-university"></i></td>
					<td align="left"><b>Havale / EFT Işlemi</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Müşteri tarafından öncelikle banka hesaplarımız sayfasında bulunan herhangi bir hesaba ödeme işlemi gerçekleştirilir.</td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-file-signature"></i></td>
					<td align="left"><b>Bildirim İşlemi</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Ödeme işlemizi tamamladıktan sonra "Havale Bildirim Fromu" sayfasından müşteri yapmış olduğu ödeme için bildirim formunu doldurarak online olarak gönderir.</td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-cogs"></i></td>
					<td align="left"><b>Kontroller</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">"Havale Bildirim Formu"'nuz tarafımıza ulaştığı anda ilgili departman tarafından yapmış oldugunuz havale / EFT işlemi ilgili banka üzerinden kontrol edilir.</td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-users"></i></td>
					<td align="left"><b>Onay / Red</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Havale bildirimi geçerli ise yani hesaba ödeme geçmiş ise, yönetici ilgili ödeme onayını vererek, siparişiniz teslimat birimine iletilir.</td>
				</tr>

			<tr><td colspan="2">&nbsp;</td></tr>

				<tr height="30">
					<td align="left" width="30"><i class="fas fa-stopwatch"></i></td>
					<td align="left"><b>Sipariş Hazırlama & Teslimat</b></td>
				</tr>
				<tr>
					<td colspan="2" align="left">Yönetici ödeme onayından sonra sayfamız üzerinden vermiş olduğunuz sipariş en kısa sürede hazırlanarak kargoya teslim edilir ve tarafınıza ulaştırılır.</td>
				</tr>

			</table>
		</td>
	</tr>
</table>