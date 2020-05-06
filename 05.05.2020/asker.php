<pre>
<?php

session_start();

ob_start();

$ordular = new ordular();

	class ordular
	/*
		# Bu sınıfta askerler adı altında ki taraflarin verileri tutulacak.
		# Amaç ordular hakkında bilgilerin düzenli olarak tutulması. ve savaşa hazırlanması.
	*/

	{

		private $askerler = []; 		# savasta ve ya tatbikatta yer alacak askerleri tutar.

		private $orduaskerTurSayisi;

		private $orduBilgisi = [];

		private $tarafBilgisi = [];

		//şu an için gerek kalmadı. private $saldiriSirasi; 		# bu degiskende savaştaki saldırı sırası yer alacak. 

		private $torduBilgisi;			# toplam ordu güç verisi yazar.

		private $askeryuklemebittiMi; 	# asker yukleme islemi bittiğinde true değerini alacak ve 
										# ilksaldiracak ve savas sirasını belirleyecek.

		public function tveri()
		
		{
		
			return $this->ToplamAskerSay;
		
		}
		
		public function add($hid=null,$asker)

		{

			$this->askerler[] = $asker; //  $this->askerler[$hid][] = $asker;

			if ( !in_array($hid, $this->tarafBilgisi) ) 
	
			{

				array_push( $this->tarafBilgisi,$asker[hid]);
			
			}
				
				array_push( $this->orduBilgisi,array("taraf" =>$asker[hid],"asker_turu" =>$asker[bid],"asker_sayisi" =>$asker[sayisi]) );
			
			//$asker->setTakim($this);
			
			return $this;	

		}

		public function veri()
		
		{

			//print_r($this->orduBilgisi);

			

			$hizlidanyavasa = $this->sirala($this->askerler, array('hiz'=>SORT_DESC)); //kucukten buyuge

			return $hizlidanyavasa;

		}

		public function end()

		{

			$this->askeryuklemebittiMi=true;

			

			foreach ($this->askerler as $key => $value) 

			{
				
				for ($tarafid=0; $tarafid < count($this->tarafBilgisi); $tarafid++) 

				{ 
					
					if($this->tarafBilgisi[$tarafid] == $value[hid])	

					{

						$this->torduBilgisi[$this->tarafBilgisi[$tarafid]][sayisi] += $value[sayisi];
						
						$this->torduBilgisi[$this->tarafBilgisi[$tarafid]][tcan] += $value[tcan];
						
						$this->torduBilgisi[$this->tarafBilgisi[$tarafid]][tguc] += $value[tguc];

					}
				}
			
			}

			//print_r($this->torduBilgisi);
		}

		public function sirala($array, $cols) 
		
		{
	   
    		$colarr = array();
    	
    		foreach ($cols as $col => $order) 
	
    		{
    	    
    	    		$colarr[$col] = array();
    	    
    	    		foreach ($array as $k => $row) 
    	    
    	    		{ 
	
    	    			$colarr[$col]['_'.$k] = strtolower($row[$col]); 
	
    	    		}
	
    		}
	
    		$eval = 'array_multisort(';
	
    		foreach ($cols as $col => $order) 
	
    		{
	
    	    		$eval .= '$colarr[\''.$col.'\'],'.$order.',';
	
    		}
	
    		$eval = substr($eval,0,-1).');';
	
    		eval($eval);
	
    		$ret = array();
	
    		foreach ($colarr as $col => $arr) 
	
    		{
	
    	    		foreach ($arr as $k => $v) 
	
    	    		{
    	        
    	        		$k = substr($k,1);
    	        
    	        		if (!isset($ret[$k])) $ret[$k] = $array[$k];
    	       
    	        		$ret[$k][$col] = $array[$k][$col];
    	    
    	    		}
    	
    		}
	
    		return $ret;	

		}

	}

	class asker
	/*
	
		# Bu sınıfta savaşta yer alan askerlerin bilgileri yer alacak örnek (sayisi,seviye,guc,hiz,can,toplamguc,toplamcan,takim vb)
	
	*/
	{
		
		public $hid; // tarafını belirler.

		public $bid; // türünü belirler.

		private $adi; // sistem vertabandan çekecek.

		public $sayisi;

		private $seviyesi;

		private $guc; // sistem kendi hesaplayacak.

		private $hiz; // sistem kendi hesaplayacak.

		private $can; // sistem kendi hesaplayacak.

		private $tguc; // sistem kendi hesaplayacak.

		private $tcan; // sistem kendi hesaplayacak.

		private $otoveri; // otomatik veri doldurma  sistemi aktifse (true) verileri sql'den çeker. ona göre hedefler.
				# bunun kullanılma sebebi savunan ve ya saldıran tarafın hedef ve hız bilgilerini elle girilmesini sağlamaktır.
		private $hedef; // otomatik veri doldurma sistemi (false) kapalıysa hedefi kendin girersin.

		private $asker = []; # asker verisin array halince çıktısıdır.

		function __construct($bid=null,$hid=null,$sayisi=null,$otoveri=true,$hedef=null,$seviye=null)

		{

			$this->otoveri = $otoveri;

			if($otoveri==false)
				
				$this->hedef = $hedef;
			
			$this->bid = $bid;
			
			$this->hid = $hid;

			if($hid=="tatbikat")

			{

				$this->seviyesi = $seviye;

			}
	
			$this->sayisi = $sayisi;
			
			if(isset($bid) or isset($this->hid) or isset($this->sayisi))
			
			{

				$this->nitelik($this->hid,$this->bid);

				# birim seviyesine göre birim niteliklerini guncelle.			

			}			

		}

		public function nitelik($hid,$bid)
		
		{
			
			$Birim = New Birim;
			
			$varsayilan = ($Birim->vbirimcek($bid));
			
			if($this->otoveri==true)

			{

				$birimseviye = $Birim->birimseviyecek($hid); # veritabanında birim seviyelerin çeker.

				$this->seviyesi = $birimseviye[0][$bid];

				$this->hedef = $Birim->birimhedefcek($hid)[$bid]; # veritabanında hedefleri çeker.
			
			}
				
			$this->guc = $varsayilan[vb_guc] + floor($this->seviyesi*($varsayilan[vb_guc]/5));
			
			$this->can = $varsayilan[vb_can] + floor($this->seviyesi*($varsayilan[vb_can]/5));
			
			$this->hiz = $varsayilan[vb_hiz] + floor(($this->seviyesi)*($varsayilan[vb_hiz]/5));
			
			$this->adi = $Birim->birimisim($bid);

			$this->tcan = $this->can * $this->sayisi;

			$this->tguc = $this->guc * $this->sayisi;

			$this->add();

			return;

		}

		public function add()

		{

			$this->asker[] = array(

				"hid" => $this->hid,
				"bid" => $this->bid,
				"adi" => $this->adi,
				"sayisi" => $this->sayisi,
				"seviyesi" => $this->seviyesi,
				"guc" => $this->guc,
				"hiz" => $this->hiz,
				"can" => $this->can,
				"tcan" => $this->tcan,
				"tguc" => $this->tguc,
				"hedef" => $this->hedef,
			 );

			//$asker->setTakim($this);
			return $this;

		}

		public function veri()

		{


			return $this->asker[0];

		}

	}

$asker1 = new asker(1,A,333,true); // A TAKIMI 1 TIPI
$asker2 = new asker(2,A,333,true); // A TAKIMI 2 TIPI

$asker3 = new asker(1,B,333,false,4,44); // B TAKIMI 1 TIPI
$asker4 = new asker(2,B,333,false,4,44); // B TAKIMI 2 TIPI

$ordular 	->add($asker1->hid,$asker1->veri())
 			->add($asker2->hid,$asker2->veri())

			->add($asker3->hid,$asker3->veri())
			->add($asker4->hid,$asker4->veri())
			->end();

$veriler = $ordular->veri();



print_r($ordular );


class Savas

{
	
	public function baslat()
	
	{
		
		$taraf = $this->getSaldiriSiraliAskerArr();
		
		$canliSayisi = $this->getCanliSayisi();
		
		while( $canliSayisi > 1 )
		
		{
			
			foreach( $taraf as $asker)
			
			{
				
				$this->saldir( $asker, $this->hedefBelirle($asker) );
			
			}

			$canliSayisi = $this->getCanliSayisi();

		}

	}

}

?>
</pre>
