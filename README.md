#MP3 Preview Codeigniter Angular MySQL UIkit

index.html the main page

js/angular.custom.main.js - custom angular javascript
js/custom.jquery.main.js - custom jquery javascript

js/angular.file.upload.js - custom angular file upload - see credits

js/core - UIkit core js
js/components - UIkit components js

css/ - UIkit layout css
fonts/ - UIkit fonts 

Api controller - Codeigniter main controller

application/config/database.php
	'hostname' => 'your_host',
	'username' => 'your_user',
	'password' => 'your_pass',
	'database' => 'your_database',

application/libraries/Mp3_library.php library to create preview

application/libraries/getID3/ folder to library getID3 extract MP3 information http://getid3.sourceforge.net/

uploads/ - folder to mp3 upload and preview

Database to Test:


CREATE TABLE IF NOT EXISTS `mp3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `preview` text NOT NULL,
  `original` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


Codeigniter:
http://codeigniter.com/

Angularjs
https://angularjs.org/

UIkit
http://getuikit.com/
