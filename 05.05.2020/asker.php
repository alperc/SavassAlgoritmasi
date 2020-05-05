<pre>

<?php

session_start();

ob_start();

$askerler = new askerler();

	class askerler
	
	/*
		# Bu sınıf taraflara ait askerlerin verileri yer alacak. 
		# Bu veriler bir üst olacak olan savaş sistemi içinde çekilip kullanılacak.
	*/
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
	# Bu bilgiler bir üstündeki sınıf olan $askerler içinde taraf şartına göre depolanacak. 
	
	->nitelik($hid,$bid) hesap ve birim bilgilerini veri tabanından alıp değikenleri doldurulduğu fonksiyon.

	*/
	{
		
		public $hid; // tarafını belirler.

		public $bid; // türünü belirler.

		private $adi; // sistem veritabandan çekecek.

		public $sayisi;

		private $seviyesi;

		private $guc; // sistem kendi hesaplayacak.

		private $hiz; // sistem kendi hesaplayacak.

		private $can; // sistem kendi hesaplayacak.

		private $otoveri; // otomatik veri doldurma  sistemi aktifse (true) verileri sql'den çeker. ona göre hedefler.
				# bunun kullanılma sebebi savunan ve ya saldıran tarafın hedef ve hız bilgilerini elle girilmesini sağlamaktır.
		private $hedef; // otomatik veri doldurma sistemi (false) kapalıysa hedefi kendin girersin.


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
			
			$birimseviye = $Birim->birimseviyecek($hid); # veritabanında birim seviyelerin çeker.

			if($this->otoveri==true)

			{

				$this->seviyesi = $birimseviye[0][$bid];

				$this->hedef = $Birim->birimhedefcek($hid)[$bid]; # veritabanında hedefleri çeker.
			
			}
				
			$this->guc = $varsayilan[vb_guc] + floor($birimseviye[0][$bid]*($varsayilan[vb_guc]/5));
			
			$this->can = $varsayilan[vb_can] + floor($birimseviye[0][$bid]*($varsayilan[vb_can]/5));
			
			$this->hiz = $varsayilan[vb_hiz] + floor(($birimseviye[0][$bid])*($varsayilan[vb_hiz]/5));
			
			$this->adi = $Birim->birimisim($bid);

			return;

		}

	}

$asker1 = new asker(1,2,333,true); // asker( "birim türü/cinsi","takim id","birim sayısı","veritabanindan verileri cek")
$asker2 = new asker(2,2,333,true); 

$asker3 = new asker(1,58,333,false,1,4); // asker( "birim türü/cinsi","takim id","birim sayısı","verileri cekme","hedef","seviye")
$asker4 = new asker(2,58,333,false,2,4);

$askerler->add($asker1->hid,$asker1); // $askerler-add("askerin ait olduğu taraf","askere ait veriler");
$askerler->add($asker2->hid,$asker2);
$askerler->add($asker3->hid,$asker3);
$askerler->add($asker4->hid,$asker4);

print_r($askerler);

?>
</pre>
