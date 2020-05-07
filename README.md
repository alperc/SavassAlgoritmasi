<style>
body {
  background-color: coral;
}
</style>

# Savaş Algoritmasi

Oluşturulabilecek bir savaş sistemi algoritması üzerinde en sağlıklı ve kullanışlı haliyle geliştirme çalışmasıdır.

# Proje Klasörü : <a href ="https://github.com/alperc58/SavassAlgoritmasi/tree/master/05.05.2020"> 05.05.2020 </a>

#### Demo URL(Eski) : <a href ="http://fetih.online/savas/index.php"> 22.09.2018 </a>

# Olası Savaş Kuralları;

#### Saldıran ülkesi ile Savunan ülkesi arasında çatışma senaryosunu hesaplayacak ve sonucu bize gösterecek.

# Birimler(8 çeşit) : 

###  A, B, C, D, E, F, G, H

# Birim Özellikleri : 

### Can : 5 , 6 , 8 , 10 , 20 , 15 , 10 , 10

### Güç : 1 , 2 , 3 , 4 , 10 , 10 , 15 , 30

## Hız : 2 , 3 , 4 , 2 , 3 , 5 , 2 , 1

## Menzil : (Bu etken şu an için kullanılmamakta).

# Birim Hedef Özelliği : 

Savaş başlamadan önce askerlerin hangi düşman birimine saldıracağı belirlenebilir. Örnek;

### A -> A

### B -> A

### C -> F

### F -> H

### H -> C

gibi, bu durumda düşmanlara saldırırlar. eğer hedef tür yoksa rastgele bir düşman hedefine saldırırlar.

# Savaş sonucuna etki edecek etmenler :

1-) Birim hızı yüksek olan birim düşmana önce saldırır. Örnek verecek olursak;

 A(1.sinif_asker) = 10 hız , A(2.sinif_asker) = 5 hız.
 
 B(1.sinif_asker) = 8 hız , B(2.sinif_asker) = 6 hız.
 

Bu senaryoda saldırı şekli ;  

### A(1.sinif_asker) > B(1.sinif_asker) > B(2.sinif_asker) > A(2.sinif_asker) 

şeklinde olacaktır.

2-) Aynı cins birimlerin toplam saldırı gücü, düşman can değerinden yüksek ve ya eşitse düşman birime hasar verir. Verilen hasara oranlar düşman birim öldürülür. saldırı gücü düşükse çatışmadan kimse hasar almaz.

3-) Saldırının sonunda kayıpların %65 oranında bir kısmı kurturulamazken, %35 oranında bir kısmı yaralı ve ya hasarlı olarak savaştan kurtalır.

4-) Savaş 1 tur gerçekleşir. Yani her birimin 1 kez saldırma hakkı, sınırsız savunma şansı vardır. 

5-) Savaş başlamadan önce girilen veriler

Olası Savaş Sonuçları : 

### A ülkesi kazandı. 

### B ülkesi kazandı. 

### Savaş berabere bitti.

################################################################################################

Test 1 :

Proje Dosyası : <a href ="https://github.com/alperc58/SavassAlgoritmasi/blob/master/22%20%E2%80%8EEyl%C3%BCl%20%E2%80%8E2018.php.test">22 ‎Eylül ‎2018.php.test</a>

22.09.2018 tarihinde amatör olarak denedim. Şimdi tekrardan göz attım fakat çok karmaşık göründü. neyi nasıl kullanmam gerektiğine karar vermeden, sonuca göre yazmıştım. 
Sadece yazdım ve çalıştırdım. Sonunda böyle bir şey çıktı şu an bakıyorum yazdığım satırlardan fazla birşey anlamadım.

Ek olarak aklımda kalan şu ; 
- Bu kodlarla 1 kez similasyondan sonuc alabilidim. 
- Aynı sayfada 2 . denemede php ram yetersiz diye uyarıyor. :) Galiba 2. turda sonsuz döngüye giriyor. Ram şişiyor. inceleyebilirsiniz.
