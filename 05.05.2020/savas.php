<?php

/**
 *  Savaş sınıfıdır.
 */
class savas extends ordular

{

	private $savasTurSayisi = 1; // Savaşın kaç tur tekrarlayacağını belirler.

	private $saldiran = null;

	private $savunan = null;

	private $key = null;

	public function bilgiler($tarafbilgisi=null,$askerler=null) // ,$saldirisirasi=null
	
	{

		$this->tarafBilgisi = $tarafbilgisi;

		$this->askerler = $askerler;

		//$this->saldiriSirasi = $saldirisirasi;

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

				echo " key : " . $this->key = $key;

				echo "<br>";

				$this->saldiran  = $this->askerler[$key];

				$this->savunan = $this->hedefayar($this->askerler[$key])  ; // kontrol için ekran görüntüsü.

				if($this->saldiran['sayisi']<=0 and $this->savunan['sayisi']>0)

				{

					//$this->saldiran = $this->hedefayar($this->savunan);


				}

				elseif($this->savunan['sayisi']<=0 and $this->saldiran['sayisi']>0 )
				
				{

					$this->savunan = $this->savunacakhedefyok($this->saldiran['hid'],$this->askerler);
						
					echo "Savunan asker yok. Yeni Hedef ".$this->savunan['hid']." - ".$this->savunan['adi']." Sayisi:".$this->savunan['sayisi']."<br>";

					echo "Saldırılacak asker var. Yeni Hedef ".$this->saldiran['hid']." - ".$this->saldiran['adi']." Sayisi:".$this->saldiran['sayisi']."<br>";

					echo $this->saldiran['hid']."'in    &#9;".$this->saldiran['adi']." (" . $this->saldiran['sayisi'] . ") &#9;saldırıyor."."&#9;Durum : "; # // kontrol için ekran görüntüsü.	
				
					echo $this->savunan['hid']."'e ait &#9;  ".$this->savunan['adi']." (" . $this->savunan['sayisi'] . ") &#9;ile çatışmaya girdi".". <br>";
				
					# burada catisma fonksiyonu çalışacak.

					echo $this->catisma();

				}

				else
				
				{


					echo $this->saldiran['hid']."'in    &#9;".$this->saldiran['adi']." (" . $this->saldiran['sayisi'] . ") &#9;saldırıyor."."&#9;Durum : "; # // kontrol için ekran görüntüsü.	
				
					echo $this->savunan['hid']."'e ait &#9;  ".$this->savunan['adi']." (" . $this->savunan['sayisi'] . ") &#9;ile çatışmaya girdi".". <br>";
				
					# burada catisma fonksiyonu çalışacak.

					echo $this->catisma();

				}

			}
			
			echo "<hr> $tur. Tur sonu.<hr>"; // kontrol için ekran görüntüsü.
			


		}

		echo " SON <hr>" ;

	}

	public function kayiphesapla($gucfarki)
	
	{
	
		if($gucfarki==0)

		{
			
			echo "Kayıp yok."; // Eşit güçtelerse;

			return 0;

		}

		elseif($gucfarki<0)

		{
			
			echo "Hedef yokedildi. Kalan : "; // Saldıran güçlüyse çatışmayı kazansın.;

			return ($this->savunan['sayisi']); // savunan asker sayısı - saldıran asker sayısı kalan asker sayısını verir.

		}	

		elseif($gucfarki>0)	
		
		{

			echo "Kalan :"; // Çatışmayı kazanamadıysan vurulan asker sayısını tespit et.
			
			return ($this->savunan['tcan']-$gucfarki)/$this->savunan['sayisi']; // vurulan asker sayısı verir.
		
		}
	
	}

	public function catisma()
	
	{
		
		$gucfarki = $this->savunan['tcan'] - $this->saldiran['tguc'];

		//echo "fark : $gucfarki ";

		$kayip = $this->kayiphesapla($gucfarki);

		echo $kalanasker = floor($this->savunan['sayisi']-$kayip); // Kayıpları hesaplatır.

		if($kalanasker==$this->savunan['sayisi'])
		
		{ 
			
			echo " (Çatışmayı berabere bitti.) <br><br>";
		
		}

		elseif($kalanasker>0) // Saldıran güçsüzse;
		{
		
			$this->askerler=($this->cokluDizinGuncelle($this->askerler,$this->savunan,$kalanasker));

			echo " (Çatışma savunanuldu.) <br><br>";
		
		}
		
		elseif($kalanasker<=0)
		
		{ 
			
			$this->askerler=($this->cokluDizinGuncelle($this->askerler,$this->savunan,0));

			echo " (Çatışmayı saldıran kazandı.) <br><br>";
		
		}



	}

	public function cokluDizinGuncelle($parents, $searched,$yenisayi) 
	{

		$yeniaskerler = [];
  		
  		/*if (empty($searched) || empty($parents)) {
    		
    		return false;
  	
  	}*/

  	foreach ($parents as $key => $value) 

  	{

    	$exists = true;
    	
    	foreach ($searched as $skey => $svalue) 

    	{
      		
      		$exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
    
    	}
    
    	if($exists)

    	{ 
			
			$value['tguc'] = ($value['tguc']/$value['sayisi'])*$yenisayi;

			$value['tcan'] = ($value['tcan']/$value['sayisi'])*$yenisayi;

			$value['tcanguc'] = $value['tcan'] + $value['tguc'];
    		
    		$value['sayisi'] = $yenisayi;

    		array_push($yeniaskerler, $value);

    		

    		//return; 

    	}

    	else array_push($yeniaskerler, $value);



  	}

	return $yeniaskerler;
  

	}

	public function hedefayar($taraf=null) // savaş işlemi burda gerçekleşecek.

	{
	  	
		$hedef = $this->hedefkontrol($taraf['hid'],$taraf['hedef'],$this->askerler); // Seçilen birimin hedefindeki birimi tespit ediyoruz.
		
		if(isset($hedef) and $taraf!=null)

		{

		  	if($hedef['hedef'] != $taraf['bid'] and $hedef['hid'] != $taraf['hid'] and $hedef['sayisi']>0) // Seçilen hedef askerin hedefindeyse
		    	
		    {
		    	
		  		return $hedef; // catisma olsun. #burdakladim
		  		
		  	}

		}

		else
		
		{
		  	
		  	$yenihedef = $this->hedefolustur($taraf['hid'],$this->askerler);
	  		
		  	$hedef = $this->hedefkontrol($taraf['hid'],$yenihedef['hedef'],$this->askerler);

		  	if(isset($hedef) and $taraf!=null)

			{
	
			  	if( $hedef['hid'] != $taraf['hid'] and $hedef['sayisi']>0) // Seçilen hedef askerin hedefindeyse
			    	
			    {

			    	return $hedef; // catisma olsun. #burdakladim
			  		
			  	}
	
			}
		
		}	
			
	}

	public function hedefolustur($taraf=null,$askerler=null) // burada rastgele yeni bir hedef belirlenecek.

	{
		
		$rand = rand(0,count($askerler)-1);

		if($askerler[$rand]['hid'] != $taraf and $askerler[$rand]['sayisi']>0)

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
			
			if($said != $asker['hid'] and $sabid == $asker['bid'] and $asker['sayisi']>0) // Seçilen birimin hedefindeki birimi tespit ediyoruz.
		    	
		   	{
					
					return $asker;

			}

		}
		
	}

	public function savunacakhedefyok($said /* saldiran takım id */, $askerler=[])
	// Bu hedef kontrol ile bir bir aynı. php hafızası doldugunda 3. ve ya 5. turda kalıyor onu aşmak için denemiştim.
	{

		foreach ($askerler as $key => $asker) 

		{
			
			if($said != $asker['hid'] and $asker['sayisi']>0) // Seçilen birimin hedefindeki birimi tespit ediyoruz.
		    	
		   	{
					
				return $asker;

			}

		}
		
	}


}

?>
