<pre>
<?php

session_start();
ob_start();

$tatbikat = array(
	
	"saldıran" =>	array(

			"saldiranid"=>"2",
			"askerler"=> array(array("askerid"=>"1","askersayisi"=>10,"askerseviye"=>5,"askerhedef"=>"1"),array("askerid"=>"2","askersayisi"=>2,"askerseviye"=>4,"askerhedef"=>"2"),array("askerid"=>"3","askersayisi"=>3,"askerseviye"=>2,"askerhedef"=>"1"))

	),
	"savunan" =>	array(

			"saldiranid"=>"2",
			"askerler"=> array(array("askerid"=>"1","askersayisi"=>10,"askerseviye"=>5,"askerhedef"=>"1"),array("askerid"=>"2","askersayisi"=>2,"askerseviye"=>4,"askerhedef"=>"2"),array("askerid"=>"3","askersayisi"=>3,"askerseviye"=>2,"askerhedef"=>"1"))

	)

);

/*
Öncelikle sınıflarını oluştur, asker, taraf, savaş, saldırı vs. SOLID prensiplerini göz önünde bulundur (ilk defa görüyorsan bu terimi, araştırman iyi olur.).
Şöyle düşünebilirsin:
$savas = new Savas();
$taraf = new Taraf();
$taraf->add( new Asker( /* Asker oluşturmak için gerekli parametreler */ /* ) );*/
//$savas = new savas();
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

		private $adi; // sistem vertabandan çekecek.

		public $sayisi;

		private $seviyesi;

		private $guc; // sistem kendi hesaplayacak.

		private $hiz; // sistem kendi hesaplayacak.

		private $can; // sistem kendi hesaplayacak.

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

$asker1 = new asker(1,$_SESSION[bilgiler][hid],333); //musellem
$asker2 = new asker(2,$_SESSION[bilgiler][hid],333); //sipahi

$asker3 = new asker(1,58,333); //musellem
$asker4 = new asker(2,58,333); //sipahi

$askerler->add($asker1->hid,$asker1);
$askerler->add($asker2->hid,$asker2);
$askerler->add($asker3->hid,$asker3);
$askerler->add($asker4->hid,$asker4);
/*$asker3 = new Asker(3,a,0); //akinci
$asker4 = new Asker(4,a,1); //okcu
$asker5 = new Asker(5,a,0); //yeniceri
$asker6 = new Asker(6,a,1); //atliokcu
$asker7 = new Asker(7,a,0); //akrep
$asker8 = new Asker(8,a,0);	//mancinik */

print_r($askerler);

// ya da
//$taraf->add( AskerFactory::create(AskterTip::A2) ); //gibi..
// Bu durumda AskerTip sınıfı olup, bu sınıf içinde sabitlerinin olduğunu ve 
//AskerFactory.nin Asker nesnesi üretmek için kullanıldığını düşünmek gerekli
//$savas->setTaraflar($taraf1, $taraf2); // 2 taraf olduğunu düşünüyorum.
//herkes tek ise, taraf diye bir şey yok
//$savas->addAsker( AskerFactory::create(AskerTip::A2) );
//$kazanan = $savas->baslat();
//Başlat methodu, savaş bitene kadar devam eden bir sonsuz döngü. Dikkat et, sonsuz dongüde kalma. 
//Belki turn sayısına göre üst limit belirleyip 1000 turdan sonra berabere demek isteyebilirsin. 
//Her turda, sıradaki saldıracak kişiyi belirleyip, 
//hedefi belirleyip, saldırı methodunu çalıştıracaksın. 
//Saldırı methodu, can düşürecek ve düşman ölmüşse onu belirleyecek. 
//Canlı kalan tek kişi olduğunda savaş biter, döngü sona erer.

class Savas
{
	public function baslat()
	{
		$askerler = $this->getSaldiriSiraliAskerArr();
		$canliSayisi = $this->getCanliSayisi();
		while( $canliSayisi > 1 )
		{
			foreach( $askerler as $asker)
			{
				$this->saldir( $asker, $this->hedefBelirle($asker) );
			}
			$canliSayisi = $this->getCanliSayisi();
		}
	}
}
//Eksik olan method'ları da yazarsan çalışması lazım.
//İşe başlamadan önce, Asker nesnesini bir ORM ile, DB'den gelen bir nesne halinde düzenlersen, 
//DB'den çektiğin Asker nesneleri ile savaş yaptırabilirsin.

/*
function birimseviye($bid=null)

{
	
	$Birim = New Birim;
	
	$varsayilan = ($Birim->vbirimcek($bid));

	$birimseviye = $Birim->birimseviyecek($_SESSION[bilgiler][hid]);

	$bguc = $varsayilan[vb_guc] + floor($birimseviye[0][$bid]*($varsayilan[vb_guc]/5));
	
	$bcan = $varsayilan[vb_can] + floor($birimseviye[0][$bid]*($varsayilan[vb_can]/5));
	
	$bhiz = $varsayilan[vb_hiz] + floor(($birimseviye[0][$bid])*($varsayilan[vb_hiz]/5));
		
	
	return array("guc" => $bguc , "can" => $bcan , "hiz" => $bhiz );

}

var_dump(birimseviye(8));
*/
?>
</pre>
