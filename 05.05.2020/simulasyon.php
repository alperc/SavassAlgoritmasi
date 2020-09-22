<pre>
<?php

$asker1 = new asker(1,"Alper",333,false,2,50); // (Asker Türü	, Kime Ait 	, Sayısı 	, Sql Durumu 	, Saldıracağı Hedef 	, Seviyesi)
$asker2 = new asker(2,"Alper",333,false,2,50); // (Alper 		, Sipahi 	, 333		, false		, 2(Musellem)		, 50)

$asker3 = new asker(1,"Çağlar",333,false,1,50);
$asker4 = new asker(2,"Çağlar",333,false,1,0);

$Ordular 	->add($asker1->hid,$asker1->veri())
 		->add($asker2->hid,$asker2->veri())

		->add($asker3->hid,$asker3->veri())
		->add($asker4->hid,$asker4->veri())
		->end();

$Savas->bilgiler($Ordular->tarafBilgisi,$Ordular->askerler,$Ordular->saldiriSirasi);

$Savas 	->tur(3)
	->baslat();

var_dump($Savas);

?>
</pre>
