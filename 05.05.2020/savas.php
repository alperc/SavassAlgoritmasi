<?php

/**
 *  Savaş sınıfıdır.
 */
class savas extends ordular

{

	private $savasTurSayisi = 1; // Savaşın kaç tur tekrarlayacağını belirler.

	public function bilgiler($tarafbilgisi=null,$askerler=null,$saldirisirasi=null)
	
	{

		$this->tarafBilgisi = $tarafbilgisi;

		$this->askerler = $askerler;

		$this->saldiriSirasi = $saldirisirasi;

	}

	public function tur($tursayisi=null)
	
	{

		$this->savasTurSayisi = $tursayisi;
		
		return $this;
	
	}

	public function baslat()
	
	{

		$askerler = $this->siraliveri(); // burda sıralı verileri çekiyoruz.
		
		for ($tur=1; $tur <= $this->savasTurSayisi; $tur++) 
		
		{ 
			
			echo " $tur. Tur Başlangıcı. <hr>"; // kontrol için ekran görüntüsü.
			
			foreach ($askerler as $key => $asker) 
			
			{
	
				echo $asker[hid]."'in    &#9;".$asker[adi]. "  &#9;saldırıyor."."&#9;Durum : "; # // kontrol için ekran görüntüsü.	
				
				echo $savassonu = $this->catisma($asker).". <br>"  ; // kontrol için ekran görüntüsü.
				
				# burada savaş fonksiyonu çalışacak.
	
			}
			
			echo "<hr> $tur. Tur sonu.<hr>"; // kontrol için ekran görüntüsü.

		}

	}

	public function catisma($taraf=null) // savaş işlemi burda gerçekleşecek.

	{
	  	
		$hedef = $this->hedefkontrol($taraf[hid],$taraf[hedef],$this->askerler); // Seçilen birimin hedefindeki birimi tespit ediyoruz.
		  		
		if(isset($hedef) and $taraf!=null)

		{

		  	if($hedef[hedef] != $asker[bid] and $hedef[hid] != $asker[hid]) // Seçilen hedef askerin hedefindeyse
		    	
		    {
		  			
		  		return $hedef[hid]."'e ait &#9;  ".$hedef[adi]."  &#9;ile çatışmaya girdi"; // catisma olsun. #burdakladim
		  		
		  	}

		}

		else
		
		{
		  	
		  	$yenihedef = $this->hedefolustur($taraf[hid],$this->askerler);
	  		
		  	$hedef = $this->hedefkontrol($taraf[hid],$yenihedef[hedef],$this->askerler);

		  	if(isset($hedef) and $taraf!=null)

			{
	
			  	if($hedef[hedef] != $asker[bid] and $hedef[hid] != $asker[hid]) // Seçilen hedef askerin hedefindeyse
			    	
			    {
			  			
			  		return $hedef[hid]."'e ait &#9;  ".$hedef[adi]."  &#9;ile çatışmaya girdi"; // catisma olsun. #burdakladim
			  		
			  	}
	
			}
		
		}	
			
	}

	public function hedefolustur($taraf=null,$askerler=null) // burada rastgele yeni bir hedef belirlenecek.

	{
		
		$rand = rand(0,count($askerler)-1);

		if($askerler[$rand][hid] != $taraf)

		{

			return $askerler[$rand] ;	
		}

		else
		{
			
			return $this->hedefolustur($taraf,$this->askerler);

		}
		

	}

	public function hedefkontrol($said /* saldiran takım id */,$sabid /* savunan birim id */, $askerler=[])
	
	{

		foreach ($askerler as $key => $asker) 

		{
			
			if($said != $asker[hid] and $sabid == $asker[bid]) // Seçilen birimin hedefindeki birimi tespit ediyoruz.
		    	
		   	{
					
					return $asker;

			}

		}
		
	}

}

?>
