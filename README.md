# yii2-comment
Comment Module For Advanced Project  

Hazırlayanlar:  
180202059 - Hüseyin Yılmaz  
180202092 - Yağız Türer  
180202093 - Akın Özbay  

-----------------

Modüller:  
[yagiztr/yii2-movie](https://github.com/yagizturer/yii2-movie)  
[huseyinyilmaz/yii2-comment](https://github.com/Huseyin-Yilmaz-98/yii2-comment)  
[xedeer/yii2-watchlist](https://github.com/akinozbay99/yii2-watchlist)  

-----------------

Yukarıda belirtilen modüller ayrı ayrı yüklenmiş olsa da hepsi aynı derecede ortak katkıyla yazılmıştır, birlikte notlandırılması rica olunur.  
Movie modülü, diğer iki modül olmadan da çalışmaktadır ancak film sayfalarında yorum ve izleme listesi özelliğinin çalışması için diğer iki modül de kurulmalıdır.  
Diğer iki modül ise yüklenirken movie modülünü otomatik olarak kurmaktadırlar.  
Tüm özelliklerin düzgün çalışması için bu üç modülün birlikte kurulması gerekmektedir.  

-----------------

PHP 7 sürümlerinden birini gerektirir. Tüm modüllerin düzgün kurulması için advanced projesi indirildikten sonra önce şu iki komutla proje başlatılmalıdır:


    php requirements.php
    php init


Daha sonra da bu komutlarla modüller kurulmalıdır:


    composer require yagiztr/yii2-movie "dev-main"
    composer require huseyinyilmaz/yii2-comment "dev-main"
    composer require xedeer/yii2-watchlist "dev-main"


Böylece tüm modüller kurulmuş olur.

-----------------

Bu modüller kurulduktan sonra, projede tanımlı isme sahip bir veritabanınız olduğunu doğrulayın ve daha sonra aşağıdaki komutla projenizin ana tablolarını yükleyin:

    php yii migrate

Daha sonra da aşağıdaki komutla üç modül için de gerekli tabloları oluşturabilirsiniz:

    php yii migrate --migrationPath=@vendor/yagiztr/yii2-movie/src/migrations/

Bunun sonucunda tablolar oluştuğu gibi demo amaçlı dört adet de film tanımlanacaktır.

-----------------

Daha sonra, frontend dizinindeki config klasöründe yer alan main.php dosyasının return arrayine şu girdi eklenerek modüller uygulamaya tanıtılmalıdır:  


    "modules" => [
        "movie" => [
            "class" => "yagiztr\movie\Module"
        ],
        "comment" => [
            "class" => "huseyinyilmaz\comment\Module"
        ],
        "watchlist" => [
            "class" => "xedeer\watchlist\Module"
        ]
    ],


Bundan sonra modüller uygulamaya tanıtılmış olur.

-----------------

### Veritabanı Bağlantıları
![Database](https://github.com/yagizturer/yii2-movie/blob/main/src/images/database.png)

-----------------

### Film Modülü
Eğer ki proje URL biçimlendirilmesinde bir düzenleme yapılmadıysa http://alanadi/frontend/web/index.php?r=movie adresine giderek film listesi görüntülenebilir. Burada kategoriye göre film listeleme, isme veya yapın yılına göre film arama gibi özellikler bulunmaktadır. Bu açılan sayfadan yeni bir film girdisi oluşturulabileceği gibi her satırın sonunda bulunan işarete tıklanarak filmin sayfasına gidilebilir. Film sayfasında filmin konusu, yapım yılı, ismi, posteri gibi bilgiler görüntülenebileceği gibi, diğer iki modül de kurulduysa film listesi ve yorum özellikleri de kontrol edilebilir. Eğer ki bu iki modülden biri kurulmadıysa, ilgili alanda durumu açıklayan bir uyarı görünmektedir. Ayrıca filmler düzenlenebilir ve kategori gibi bilgileri yeniden belirlenebilir.

-----------------

### Yorum Modülü
Yorum modülü, kullanıcının yorumlarını listeleme özelliği hariç ayrı sayfalarda kullanılmak üzere tasarlanmadı. Yine URL biçimlendirmesinde bir düzenleme yapılmadıysa, siteye giriş yaptıktan sonra http://alanadi/frontend/web/index.php?r=comment sayfasına giderek kendi yaptığınız yorumları listeleyebilir ve film sayfalarına gidebilirsiniz. Eğer ki giriş yapmamış olsanız dahi film sayfalarında diğer kullanıcıların yaptığı yorumları görüntüleyebilirsiniz. Ancak yeni bir yorum paylaşmak veya diğer kullanıcıların paylaştığı yorumları beğenmek için siteye giriş yapmış olmanız gerekmektedir. Ayrıca yorumları yalnızca paylaşan kullanıcı silebilmektedir. Bir yorum beğenildiğinde sayfa yenilenmez, bunun yerine anlık olarak beğeni sayısı güncellenir ve bu işlem sırasında bir hata olduysa uyarı penceresi gözüküp hata sebebini kullanıcıya bildirir.

-----------------

### İzleme Listesi Modülü
İzleme listesi modülü ise yalnızca giriş yapmış kullanıcıların faydalanabileceği bir özelliktir. Yine URL biçimlendirmesinde bir düzenleme yapılmadıysa, siteye giriş yaptıktan sonra http://alanadi/frontend/web/index.php?r=watchlist adresine giderek daha önceden oluşturduğunuz film listeleri görüntülenebilir. Yalnızca o anda giriş yapmış olan kullanıcının listeleri görünür. Bu sayfadan daha önce oluşturduğunuz listelerin sayfasına gidebileceğiniz gibi yukarıdaki butona tıklayarak yeni bir film listesi de oluşturabilirsiniz. Herhangi bir listenin sayfasına girildiğinde o listeye eklenmiş filmler listelenir ve doğrudan film adına tıklanarak filmin sayfasına erişilebilir. Ayrıca film sayfalarında o anda görüntülenen filmi listeye ekleme ve listeden çıkarma özelliği bulunur. Yine burada yalnızca kendi listeleriniz üstünde işlem yapabilirsiniz. Daha önce filmi eklediğiniz listeler ayrı bir alanda, eklemediğiniz listeler ise ayrı bir alanda görünür. Çoklu seçim ile listelere filmi ekleme veya listeden çıkarma işlemleri yapılabilir.

-----------------

### Film Modülü Resimler


Index sayfasında filmler bu şekilde listelenmektedir, film yaratma, filmi düzenleme ve görüntüleme seçenekleri etkinleşmektedir, ayrıca yıla ve isme göre arama da vardır:
![Index Page](https://github.com/yagizturer/yii2-movie/blob/main/src/images/index.png)



Kategori seçildiğinde yalnızca o kategoriye ait filmler listelenir:
![Index Page Listed By Genre](https://github.com/yagizturer/yii2-movie/blob/main/src/images/indexbygenre.png)



Film düzenleme sayfasında istendiği kadar kategori seçilebilir:
![Edit Page](https://github.com/yagizturer/yii2-movie/blob/main/src/images/update.png)



Film yaratma sayfasında da kategori seçimi, poster linki belirtme gibi özellikler vardır:
![Create Page](https://github.com/yagizturer/yii2-movie/blob/main/src/images/create.png)



Diğer modüller yüklü olmadığı takdirde film bilgileri böyle görüntülenmektedir:
![View Alone](https://github.com/yagizturer/yii2-movie/blob/main/src/images/viewalone.png)



Diğer modüller yüklü olduğunda ise tüm özellikler aktif olmaktadır:
![View With Other Modules](https://github.com/yagizturer/yii2-movie/blob/main/src/images/viewwithothermodules.png)


-----------------

### Yorum Modülü Resimler


Giriş yapılmadığında index sayfası şöyle bir uyarı vermektedir:
![Index Page Logged Out](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/indexloggedout.png)



Giriş yapıldığında da kullanıcının yaptığı yorumlar böyle gözükmekte, film adına tıklanarak film sayfasına gidilebilmekte ve yorum doğrudan listeden silinebilmekte:
![Index Page Logged In](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/index.png)



Film sayfasında hiç yorum yoksa durumu belirten bir yazı çıkmaktadır:
![No comment](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/nocomment.png)



Giriş yapılmadığında film sayfasında başkasının yorumları görüntülenebilmekte ama beğenme ve yeni yorum yapılamamaktadır:
![Logged Out](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/loggedout.png)



Kendi yorumlarımızda yorumu silme seçeneği de aktifleşmektedir:
![Logged In Owner](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/loggedinowner.png)



Başkalarının yorumları beğenilebilmekte ancak silme seçeneği etkisiz kalmaktadır:
![Logged In Not Owner](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/loggedinnotowner.png)



Beğendiğimiz yorumlarda beğeni butonunun rengi değişmektedir:
![Liked](https://github.com/Huseyin-Yilmaz-98/yii2-comment/blob/main/src/images/liked.png)



-----------------

### İzleme Listesi Modülü Resimler


Giriş yapılmadığında izleme listesi özelliği devre dışı kalmaktadır ve index sayfasında şu uyarı çıkmaktadır:
![Logged Out Index](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/indexloggedout.png)



Giriş yapıldığında daha önce yarattığınız izleme listeleri görüntülenebilir, yeni liste yaratılabilir, listeler silinebilir ve düzenlenebilir:
![Index](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/index.png)



Yeni liste yaratmak için isim girmek yeterlidir:
![Create](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/create.png)



Bir film listesi görüntülendiğinde listede ekli olan filmler listelenir, bu sayfadan filmler silinebilir ya da filmin adına tıklanarak filmin sayfasına gidilebilir:
![Watchlist](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/watchlist.png)



Film sayfasında filmin ekli olduğu listeler ayrı, ekli olmadığı listeler ayrı yerlerde listelenir, bu listeler aracılığıyla filmle izleme listelerine eklenebilir veya izleme listelerinden çıkarılabilir.
![moviepage](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/moviepage.png)



Eğer hiç izleme listesi yaratmadıysanız iki listede boş olacaktır:
![nowatchlist](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/nowatchlist.png)



Giriş yapılmadığında bu özellik devre dışı kalmaktadır:
![Logged Out](https://github.com/akinozbay99/yii2-watchlist/blob/main/src/images/loggedout.png)