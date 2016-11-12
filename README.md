![free bootstrap template](http://kiber-hotel.ru/images/1000.jpg)
<br/>
1.<br/>
создать таблицу в базе данных feedback на localhost (али еще где)<br/>
CREATE TABLE `pf_message` (<br/>
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,<br/>
  `name` varchar(255) DEFAULT NULL,<br/>
  `email` varchar(255) DEFAULT NULL,<br/>
  `body` text,<br/>
  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;<br/>
2.<br/>
настроить базу данных в файле<br/>
protected/config/database.php<br/>
return array(<br/>
   'connectionString' => 'mysql:host=localhost;dbname=feedback',<br/>
   'emulatePrepare' => true,<br/>
   'username' => 'root',<br/>
   'password' => '22',<br/>
   'charset' => 'utf8',<br/>
   'tablePrefix' => 'pf_'<br/>
);<br/>

