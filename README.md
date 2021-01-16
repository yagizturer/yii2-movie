# yii2-movie
Movie Module For Advanced Project  

Hazırlayanlar:  
180202059 - Hüseyin Yılmaz  
180202092 - Yağız Türer  
180202093 - Akın Özbay  

-----------------

Modüller:  
yagiztr/yii2-movie  
huseyinyilmaz/yii2-comment  
xedeer/yii2-watchlist  

-----------------

Yukarıda belirtilen modüllerin hepsi ortak katkıyla yazılmıştır, birlikte notlandırılması rica olunur.  
Movie modülü, diğer iki modül olmadan da çalışmaktadır ancak film sayfalarında yorum ve izleme listesi özelliğinin çalışması için diğer iki modül de kurulmalıdır.  
Diğer iki modül ise yüklenirken movie modülünü otomatik olarak kurmaktadırlar.  
Tüm özelliklerin düzgün çalışması için bu üç modülün birlikte kurulması gerekmektedir.  

-----------------

Tüm modüllerin düzgün kurulması için, advanced projesi dizininde şu kodlar çalıştırılmalıdır:

    php requirements.php
    php init
    composer require yagiztr/yii2-movie "dev-main"
    composer require huseyinyilmaz/yii2-comment "dev-main"
    composer require xedeer/yii2-watchlist "dev-main"

Böylece tüm modüller kurulmuş olur.

-----------------

Bu modüller kurulduktan sonra, projede tanımlı isme sahip bir veritabanınız olduğunu doğrulayın ve advanced projesinde console klasöründe bulunan migration klasörüne, vendor klasöründeki yagiztr altında bulunan yii2-movie dizinindeki src klasöründe yer alan migrations klasörünün içeriği kopyalanmalıdır. Bu migration dosyaları kopyalandıktan sonra ana dizinde "php yii migrate" komutu çalıştırılarak veritabanı uygun hale getirilmektedir. Ancak advanced projesiyle birlikte inmiş olan user tablosu migration dosyası da silinmemiş olmalıdır. Çünkü modüller user tablosunun id sütunu sayesinde bilgi tutmaktadır. Migration esnasında tablolar oluşturulduğu gibi, kategoriler otomatik olarak tanımlanmakta ayrıca demo amacıyla dört adet film eklenmektedir.

-----------------

Daha sonra, fronted dizinindeki config klasöründe yer alan main.php dosyasının return arrayine şu girdi eklenerek modüller uygulamaya tanıtılmalıdır:  


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

Eğer ki proje URL biçimlendirilmesinde bir düzenleme yapılmadıysa http://alanadi/frontend/web/index.php?r=movie adresine giderek film listesi görüntülenebilir. Burada kategoriye göre film listeleme, isme veya yapın yılına göre film arama gibi özellikler bulunmaktadır. Bu açılan sayfadan yeni bir film girdisi oluşturulabileceği gibi her satırın sonunda bulunan işarete tıklanarak filmin sayfasına gidilebilir. Film sayfasında filmin konusu, yapım yılı, ismi, posteri gibi bilgiler görüntülenebileceği gibi, diğer iki modül de kurulduysa film listesi ve yorum özellikleri de kontrol edilebilir. Eğer ki bu iki modülden biri kurulmadıysa, ilgili alanda durumu açıklayan bir uyarı görünmektedir. Ayrıca filmler düzenlenebilir ve kategori gibi bilgileri yeniden belirlenebilir.

-----------------

Yorum modülü ayrı sayfalarda kullanılmak üzere tasarlanmadı. İşlevleri yalnızca film sayfalarından kontrol edilebilmektedir. Eğer ki giriş yapmamış olsanız dahi diğer kullanıcıların yaptığı yorumları görüntüleyebilirsiniz. Ancak yeni bir yorum paylaşmak veya diğer kullanıcıların paylaştığı yorumları beğenmek için siteye giriş yapmış olmanız gerekmektedir. Ayrıca yorumları yalnızca paylaşan kullanıcı silebilmektedir. Bir yorum beğenildiğinde sayfa yenilenmez, bunun yerine anlık olarka beğeni sayısı güncellenir ve bu işlem sırasında bir hata olduysa uyarı penceresi gözüküp hata sebebini kullanıcıya bildirir.

-----------------

İzleme listesi modülü ise yalnızca giriş yapmış kullanıcıların faydalanabileceği bir özelliktir. Yine URL biçimlendirmesinde bir düzenleme yapılmadıysa, siteye giriş yaptıktan sonra http://alanadi/frontend/web/index.php?r=watchlist adresine giderek daha önceden oluşturduğunuz film listeleri görüntülenebilir. Yalnızca o anda giriş yapmış olan kullanıcının listeleri görünür. Bu sayfadan daha önce oluşturduğunuz listelerin sayfasına gidebileceğiniz gibi yukarıdaki butona tıklayarak yeni bir film listesi de oluşturabilirsiniz. Herhangi bir listenin sayfasına girildiğinde o listeye eklenmiş filmler listelenir ve doğrudan film adına tıklanarak filmin sayfasına erişilebilir. Ayrıca film sayfalarında o anda görüntülenen filmi listeye ekleme ve listeden çıkarma özelliği bulunur. Yine burada yalnızca kendi listeleriniz üstünde işlem yapabilirsiniz. Daha önce filmi eklediğiniz listeler ayrı bir alanda, eklemediğiniz listeler ise ayrı bir alanda görünür. Çoklu seçim ile listelere filmi ekleme veya listeden çıkarma işlemleri yapılabilir.



