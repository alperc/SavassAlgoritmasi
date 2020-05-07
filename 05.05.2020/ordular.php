	<?php
	
	class ordular
	/*
		# Bu sınıfta askerler adı altında ki taraflarin verileri tutulacak.
		# Amaç ordular hakkında bilgilerin düzenli olarak tutulması. ve savaşa hazırlanması.
	*/

	{

		private $askerler = []; 		# savasta ve ya tatbikatta yer alacak askerleri tutar.

		private $orduBilgisi = [];  # Ordular hakkında kısa bilgilerin yer aldığı bir değişken.

		private $tarafBilgisi = []; 	# Savascak tarafların anahtar kelimelerin yer aldığı sınıf.

		private $saldiriSirasi; 		# bu degiskende savaştaki saldırı sırası yer alacak.

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

		public function siraliveri()
		
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

		public function sirala($array, $cols)  // Bu fonksiyon ile çoklu dizinlerde sıralama yaptırarak hangi birimin daha hızlı olduğunu tespit ediyorum.
		
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

	?>
