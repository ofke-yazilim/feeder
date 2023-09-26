## FEEDER PROJESİ
Web servis mimarisini temsil eder. Projenin çalışan web haline [https://feeder.okesmez.com/](https://feeder.okesmez.com/) adresinden ulaşablirsiniz.
projenin **rest api** şeklinde çalışan örneklerine ise aşağıdaki linklerde bulunan postman collectionlarını çalıştırarak ulaşabilirsiniz.
- [Postman v2.0](https://feeder.okesmez.com/postman/v20.json)
- [Postman v2.1](https://feeder.okesmez.com/postman/v21.json)
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
- Terminal ekranı açılır ve proje dizinine girilir. ``php artisan migrate `` komutu çalıştırılarak. Database içerisinde ilgili tabloların oluşturulması sağlanır.
- ``php artisan key:generate`` komudu çalıştırılarak proje için APP_KEY üretilir.
- Hemen ardından ``php artisan serve`` denilerek proje local bilgisayarda ayağıya kaldırılır.
- Projimiz local bilgisayarda [http://127.0.0.1:8000/](http://127.0.0.1:8000/) adresinde çalışmaya başlar. Projenin web halinde çalışan halini bu adresten takip edebilirsiniz.
### Uygulama Hakkında 
- Bir kullanıcı Register edildikten sonra kullanıcının verified edilmesi gerekmektedir. 
Bu işlemi yapmak için öncelikle login olunmalıdır. Ardından profil sekmesine gidilmeli ve 
sekme içindeki onaylama linki kullanılmalıdır. Api versiyonun da ise ilgili verified 
linki response içerisinde gönderilmektedir.
