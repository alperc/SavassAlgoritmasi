	<?php
	
	class ordular

	/*
		# Bu sınıfta askerler adı altında ki taraflarin verileri tutulacak.
		# Amaç ordular hakkında bilgilerin düzenli olarak tutulması. ve savaşa hazırlanması.
	*/

	{

		public $askerler = []; 		# savasta ve ya tatbikatta yer alacak askerleri tutar.

		public $tarafBilgisi = []; 	# savascak tarafların anahtar kelimelerin yer aldığı sınıf.

		//tek değişkende tutuldugunda boşa çıktı. 
		//public $saldiriSirasi; 		# bu degiskende savaştaki saldırı sırası yer alacak.

		private $torduBilgisi;			# toplam ordu güç verisi yazar.

		public $askeryuklemebittiMi; 		# asker yukleme islemi bittiğinde true değerini alacak ve 
							# ilksaldiracak ve savas sirasını belirleyecek.

		public function tveri()
		
		{
		
			return $this->ToplamAskerSay;
		
		}
		
		public function add($hid=null,$asker)

		{

			$this->askerler[] = $asker;

			if ( !in_array($hid, $this->tarafBilgisi) ) 
	
			{

				array_push( $this->tarafBilgisi,$asker[hid]);
			
			}
					
			return $this;	

		}

		public function siraliveri()
		
		{

			$this->askerler = $this->sirala($this->askerler, array('hiz'=>SORT_DESC)); //kucukten buyuge

			return $this->askerler;

		}

		public function end()

		{

			$this->askeryuklemebittiMi=true;

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

	?>
