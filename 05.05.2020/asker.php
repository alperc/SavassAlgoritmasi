	<?php
	
	class asker
	/*
	
		# Bu sınıfta savaşta yer alan askerlerin bilgileri yer alacak örnek (sayisi,seviye,guc,hiz,can,toplamguc,
		toplamcan,takim vb)
	
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
				# bunun kullanılma sebebi savunan ve ya saldıran tarafın hedef ve hız bilgilerini elle girilmesini 
				# sağlamaktır.
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

		public function nitelik($hid,$bid) # bu method iyileştirilecek.
		
		{
			
			$Birim = New Birim;
			
			$varsayilan = ($Birim->vbirimcek($bid));
			
			if($this->otoveri==true)

			{

				$birimseviye = $Birim->birimseviyecek($hid); # veritabanında birim seviyelerin çeker.

				$this->seviyesi = $birimseviye[0][$bid];

				$this->hedef = $Birim->birimhedefcek($hid)[$bid]; # veritabanında hedefleri çeker.
			
			}
				
			$this->guc = $varsayilan[vb_guc] + $this->seviyesi;//floor($this->seviyesi*($varsayilan[vb_guc]/5));
			
			$this->can = $varsayilan[vb_can] + $this->seviyesi;//floor($this->seviyesi*($varsayilan[vb_can]/5));
			
			$this->hiz = $varsayilan[vb_hiz] + $this->seviyesi;//floor(($this->seviyesi)*($varsayilan[vb_hiz]/5));
			
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
				"tcanguc" => $this->tguc + $this->tcan,
				"hedef" => $this->hedef
			 );

			//$asker->setTakim($this);
			return $this;

		}

		public function veri()

		{
	
			return $this->asker[0];

		}

	}

	?>
