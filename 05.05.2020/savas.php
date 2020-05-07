<?php

/**
 *  Savaş sınıfıdır.
 */
class savas extends ordular

{

	public function bilgiler($tarafbilgisi=null,$askerler=null,$saldirisirasi=null) // bilgileri al.
	
	{

		$this->tarafBilgisi = $tarafbilgisi;

		$this->askerler = $askerler;

		$this->saldiriSirasi = $saldirisirasi;

	}

	public function baslat() // savaşı başlat.
	
	{

		$Taraflar = $this->siraliveri();

		foreach ($Taraflar as $key => $taraf) 
		
		{
		
			echo $taraf[hid]."'e ait ".$taraf[adi]. " saldırıyor. ". "Hedef : ". $taraf[hedef].". <hr>";
			# burada savaş fonksiyonu çalışacak.
		}

	}
}

?>
