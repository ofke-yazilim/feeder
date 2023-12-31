## FEEDER PROJESİ
Web servis mimarisini temsil eder. Projenin çalışan web haline [https://feeder.okesmez.com/](https://feeder.okesmez.com/) adresinden ulaşabilirsiniz.
projenin **rest api** şeklinde çalışan örneklerine ise aşağıdaki linklerde bulunan postman collectionlarını çalıştırarak ulaşabilirsiniz.
- [Postman v2.0](https://feeder.okesmez.com/postman/v20.rar)
- [Postman v2.1](https://feeder.okesmez.com/postman/v21.rar)
### Kullanılan Teknolojiler
- Laravel Framework **10.10** versiyonu.
- PHP **8.1** versiyonu.
- Mysql Database.
- File Session, File Cache.
- Bootstrap **3.4.1** versiyonu.
### Kurulum
- Proje dizinine gidilir ****.env.example**** dosyasının adı ****.env**** olarak değiştirilir.
- ****.env**** dosyasında bulunan database ayarları sizin için uygun olacak şekilde girilir. Aşağıda düzenlemeniz gereken alanı görebilirsiniz.
 <pre>
    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=laravel  
    DB_USERNAME=root  
    DB_PASSWORD=
 </pre>
- Terminal ekranı açılır ve proje dizinine girilir. ``php artisan migrate`` komutu çalıştırılarak. Database içerisinde ilgili tabloların oluşturulması sağlanır.
- ``php artisan key:generate`` komutu çalıştırılarak proje için *APP_KEY* üretilir.
- Hemen ardından ``php artisan serve`` denilerek proje local bilgisayarda ayağıya kaldırılır.
- Projemiz local bilgisayarda [http://127.0.0.1:8000/](http://127.0.0.1:8000/) adresinde çalışmaya başlar. Projenin web halinde çalışan halini bu adresten takip edebilirsiniz.
### Uygulama Hakkında 
- Uygulama web servis mimarisinde çalışmaktadır. Hem web hem de api aynı Controller, aynı Model ve aynı fonksiyonları kullanmaktadır. 
- Uygulamada twitter feeder servisleri kullanılmamış yerine mock servis yazılmıştır. Mock servise entegre olmamızı sağlayan 
  class : ``app\Services\FeederService``
- Bir kullanıcı Register edildikten sonra kullanıcının verified edilmesi gerekmektedir. 
Bu işlemi yapmak için öncelikle login olunmalıdır. Ardından profil sekmesine gidilmeli ve 
sekme içindeki onaylama linki kullanılmalıdır. Api versiyonun da ise ilgili verified 
linki response içerisinde gönderilmektedir.
- Api versiyonun nasıl çalıştığını görmek için aşağıdaki Postman collectionlarından size uygun olanını import edebilirsiniz.
   1) [Postman v2.0](https://feeder.okesmez.com/postman/v20.rar)
   2) [Postman v2.1](https://feeder.okesmez.com/postman/v21.rar)
- Apiler ***Bearer Token*** kullanarak çalışmaktadır.
- Api aracılığı ile login olunduktan sonra response içersinde dönen ****access_token**** Bearer Token değerini temsil eder.
### Kullanılan Yazılım Terminolojileri
- Repository desing Pattern kullanıldı. İncelemek için proje içerisinde ``app/services/Repositories`` dizinine göz atabilirsiniz.
- Kullanılan ***Observer*** classları ``app/Observers`` dizini içerisinde bulunmaktadır.
- Loglar **file** içerisine yazıldı. Projeye ait tüm logları. ``storage/logs`` dizini altında takip edebilirsiniz.
- Middleware kullanıldı.
     >Middleware dosyalarına **app/Http/Middleware** dizininnden ulaşabilirsiniz.
   1) ``OneSessionForPerUser middleware`` bir kullanıcı için tek session takibini sağlar.
   2) ``AuthorizationFeeder middeleware`` web ortamı için yetki olaylarını takip eder.
   3) ``AuthorizationApiFeeder middleware`` api ortamı için yetki olaylarını takip eder.

