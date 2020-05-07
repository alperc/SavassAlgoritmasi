<pre>
<?php

$asker1 = new asker(1,A,333,true); // A takımı 1. tip asker
$asker2 = new asker(2,A,333,true); // A takımı 2. tip asker

$asker3 = new asker(1,B,333,false,4,50); // B takımı 1. tip asker
$asker4 = new asker(2,B,333,false,4,1); // B takımı 2. tip asker

$Ordular 	->add($asker1->hid,$asker1->veri())
 		->add($asker2->hid,$asker2->veri())

		->add($asker3->hid,$asker3->veri())
		->add($asker4->hid,$asker4->veri())
		->end(); // End ile asker girdisini bitirip askerlerin toplan güç ve can gibi degelerini hesaplattırıyorum.

$veriler = $Ordular->siraliveri(); // Bu method ile hız değerine göre savaştaki önceklik sırasını belirleyip bilgileri alıyorum. ve güncelliyorum.

print_r($Ordular);

class Savas
/*
* Bu sınıf içinde savaş sürecini kontrol ettirmeyi planlıyorum. Henüz nasıl yazmam gerektiğini düşünüyor ve geliştirmeye çalışıyorum.
*/
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
