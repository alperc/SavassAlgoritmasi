<pre>
<?php

session_start();
ob_start();

$askerler = new askerler();

	class askerler

	{

		private $askerler = [];

		public function add($hid=null,$asker)

		{

		$hid;

		$this->askerler[$hid][] = $asker;

		//$asker->setTakim($this);

		}

	}

	class asker
	/*
	
	# Bu sınıfta savaşta yer alan askerlerin bilgileri yer alacak örnek (sayisi,seviye,guc,hiz,can,toplamguc,toplamcan,takim vb)
	
	*/
	{
		
		public $hid; // tarafını belirler.

		public $bid; // türünü belirler.

		private $adi; // sistem veritabandan çekecek.

		public $sayisi;

		private $seviyesi;

		private $guc; // sistem kendi hesaplayacak. Birim güç değeri

		private $hiz; // sistem kendi hesaplayacak. Birim hız değeri

		private $can; // sistem kendi hesaplayacak. Birim can değeri

		private $hedef;

		function __construct($bid=null,$hid=null,$sayisi=null)

		{

			$this->bid = $bid;
	
			$this->hid = $hid;
	
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
		
			$birimseviye = $Birim->birimseviyecek($hid);

			$this->seviyesi = $birimseviye[0][$bid];

			$this->hedef = $Birim->birimhedefcek($hid)[$bid];
		
			$this->guc = $varsayilan[vb_guc] + floor($birimseviye[0][$bid]*($varsayilan[vb_guc]/5));
			
			$this->can = $varsayilan[vb_can] + floor($birimseviye[0][$bid]*($varsayilan[vb_can]/5));
			
			$this->hiz = $varsayilan[vb_hiz] + floor(($birimseviye[0][$bid])*($varsayilan[vb_hiz]/5));
			
			$this->adi = $Birim->birimisim($bid);

			return;

		}

	}

$asker1 = new asker(1,2,333); // asker( "birim türü/cinsi","takim id","birim sayısı")
$asker2 = new asker(2,2,333); 

$asker3 = new asker(1,58,333);
$asker4 = new asker(2,58,333);

$askerler->add($asker1->hid,$asker1); // $askerler-add("askerin ait olduğu taraf","askere ait veri");
$askerler->add($asker2->hid,$asker2);
$askerler->add($asker3->hid,$asker3);
$askerler->add($asker4->hid,$asker4);

print_r($askerler);

?>
</pre>
