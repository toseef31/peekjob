<?php 
namespace App\CustomHelper;
use DB;
class JobCallMe{
	public function getUser($userId){
		return DB::table('jcm_users')->where('userId','=',$userId)->first();
	}
	public function getReadlikes($post_id,$tablename){
		return count(DB::table('jcm_likes')->where('parent_table',$tablename)->where('post_id',$post_id)->get());
	}
	public function getUserLikes($post_id,$user_id,$tablename){
		$count = count(DB::table('jcm_likes')->where('parent_table',$tablename)->where('post_id',$post_id)->where('user_id',$user_id)->get());
		if($count > 0){
			return "fa-red";
		}
	}

	public function getUserMeta($userId){
		return DB::table('jcm_users_meta')->where('userId','=',$userId)->first();
	}

	public function userName($userId){
		$rec = DB::table('jcm_users')->select('firstName','lastName')->where('userId','=',$userId)->first();
		return $rec->firstName.' '.$rec->lastName;
	}

	public function isAdminLoggedIn(){
		if(session()->has('jcmAdmin')){
			return true;
		}else{
			return false;
		}
	}

	public function isUserLoggedIn(){
		if(session()->has('jcmUser')){
			return true;
		}else{
			return false;
		}
		//return false;
	}

	public function getAccountNotification($userId){
		return DB::table('jcm_account_alert')->where('userId','=',$userId)->first();
	}

	public function getPrivacySetting($userId){
		return DB::table('jcm_privacy_setting')->where('userId','=',$userId)->first();
	}

	public function getCompany($companyId){
		if($companyId == '0'){
			$app = \Session::get('jcmUser');
			$user = $this->getUser($app->userId);
			if($user->companyId == '0'){
				$cInput = array('companyName' => $app->firstName.' '.$app->lastName, 'companyEmail' => $app->email, 'companyPhoneNumber' => $app->phoneNumber, 'companyCountry' => $app->country, 'companyState' => $app->state, 'companyCity' => $app->city, 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
				$companyId = DB::table('jcm_companies')->insertGetId($cInput);
				DB::table('jcm_users')->where('userId','=',$app->userId)->update(array('companyId' => $companyId));
			}else{
				$companyId = $user->companyId;
			}
		}
		return DB::table('jcm_companies')->where('companyId','=',$companyId)->first();
	}

	public function necessaryPages(){
		$tText = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
		/* about */
		$isAbout = DB::table('jcm_cms_pages')->where('slug','=','about')->get();
		if(count($isAbout) == 0){
			$input = array('title' => 'About Us', 'slug' => 'about', 'createdTime' => date('Y-m-d H:i:s'), 'modifiedTime' => date('Y-m-d H:i:s'), 'pageData' => $tText);
			DB::table('jcm_cms_pages')->insert($input);
		}

		/* privacy policy */
		$isPrivacy = DB::table('jcm_cms_pages')->where('slug','=','privacy-policy')->get();
		if(count($isPrivacy) == 0){
			$input = array('title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'createdTime' => date('Y-m-d H:i:s'), 'modifiedTime' => date('Y-m-d H:i:s'), 'pageData' => $tText);
			DB::table('jcm_cms_pages')->insert($input);
		}

		/* term & conditions */
		$isCond = DB::table('jcm_cms_pages')->where('slug','=','term-conditions')->get();
		if(count($isCond) == 0){
			$input = array('title' => 'Terms & Conditions', 'slug' => 'term-conditions', 'createdTime' => date('Y-m-d H:i:s'), 'modifiedTime' => date('Y-m-d H:i:s'), 'pageData' => $tText);
			DB::table('jcm_cms_pages')->insert($input);
		}
	}

	public function timeZones(){
		//Africa
		$sub_zone = 
		array('Africa/Abidjan','Africa/Accra','Africa/Addis_Ababa','Africa/Algiers','Africa/Asmara','
		Africa/Asmera','Africa/Bamako','Africa/Bangui','Africa/Banjul','Africa/Bissau','
		Africa/Blantyre','Africa/Brazzaville','Africa/Bujumbura','Africa/Cairo','Africa/Casablanca','
		Africa/Ceuta','Africa/Conakry','Africa/Dakar','Africa/Dar_es_Salaam','Africa/Djibouti','
		Africa/Douala','Africa/El_Aaiun','Africa/Freetown','Africa/Gaborone','Africa/Harare','
		Africa/Johannesburg','Africa/Juba','Africa/Kampala','Africa/Khartoum','Africa/Kigali','
		Africa/Kinshasa','Africa/Lagos','Africa/Libreville','Africa/Lome','Africa/Luanda','
		Africa/Lubumbashi','Africa/Lusaka','Africa/Malabo','Africa/Maputo','Africa/Maseru','
		Africa/Mbabane','Africa/Mogadishu','Africa/Monrovia','Africa/Nairobi','Africa/Ndjamena','
		Africa/Niamey','Africa/Nouakchott','Africa/Ouagadougou','Africa/Porto-Novo','Africa/Sao_Tome','
		Africa/Timbuktu','Africa/Tripoli','Africa/Tunis','Africa/Windhoek','America/Adak','America/Anchorage','America/Anguilla','America/Antigua','America/Araguaina','
		America/Argentina/Buenos_Aires','America/Argentina/Catamarca','America/Argentina/ComodRivadavia','America/Argentina/Cordoba','	America/Argentina/Jujuy','
		America/Argentina/La_Rioja','America/Argentina/Mendoza','America/Argentina/Rio_Gallegos','	America/Argentina/Salta','	America/Argentina/San_Juan','
		America/Argentina/San_Luis','	America/Argentina/Tucuman','	America/Argentina/Ushuaia','	America/Aruba','	America/Asuncion','
		America/Atikokan','	America/Atka','	America/Bahia','	America/Bahia_Banderas','	America/Barbados','
		America/Belem','	America/Belize','	America/Blanc-Sablon','	America/Boa_Vista','	America/Bogota
		America/Boise','	America/Buenos_Aires','	America/Cambridge_Bay','	America/Campo_Grande','	America/Cancun','
		America/Caracas','	America/Catamarca','	America/Cayenne','	America/Cayman','	America/Chicago','
		America/Chihuahua','	America/Coral_Harbour','	America/Cordoba','	America/Costa_Rica','	America/Creston','
		America/Cuiaba','	America/Curacao','	America/Danmarkshavn','	America/Dawson','	America/Dawson_Creek','
		America/Denver','	America/Detroit','	America/Dominica','	America/Edmonton','	America/Eirunepe','
		America/El_Salvador','	America/Ensenada','	America/Fort_Wayne','	America/Fortaleza','	America/Glace_Bay','
		America/Godthab','	America/Goose_Bay','	America/Grand_Turk','	America/Grenada','	America/Guadeloupe','
		America/Guatemala','	America/Guayaquil','	America/Guyana','	America/Halifax','	America/Havana','
		America/Hermosillo','	America/Indiana/Indianapolis','	America/Indiana/Knox','	America/Indiana/Marengo','	America/Indiana/Petersburg','
		America/Indiana/Tell_City','	America/Indiana/Vevay','	America/Indiana/Vincennes','	America/Indiana/Winamac','	America/Indianapolis','
		America/Inuvik','	America/Iqaluit','	America/Jamaica','	America/Jujuy','	America/Juneau','
		America/Kentucky/Louisville','	America/Kentucky/Monticello','America/Knox_IN','	America/Kralendijk','	America/La_Paz','
		America/Lima','America/Los_Angeles','	America/Las_Vegas','	America/Louisville','	America/Lower_Princes','	America/Maceio','
		America/Managua','America/Manaus','	America/Marigot','	America/Martinique','	America/Matamoros','
		America/Mazatlan','America/Mendoza','	America/Menominee','	America/Merida','	America/Metlakatla','
		America/Mexico_City','America/Miquelon','	America/Moncton','	America/Monterrey','	America/Montevideo','
		America/Montreal','	America/Montserrat','	America/Nassau','	America/New_York','	America/Nipigon','
		America/Nome','	America/Noronha','	America/North_Dakota/Beulah','	America/North_Dakota/Center','	America/North_Dakota/New_Salem','
		America/Ojinaga','	America/Panama','	America/Pangnirtung','	America/Paramaribo','	America/Phoenix','
		America/Port-au-Prince','	America/Port_of_Spain','	America/Porto_Acre','	America/Porto_Velho','	America/Puerto_Rico','
		America/Rainy_River','	America/Rankin_Inlet','	America/Recife','	America/Regina','	America/Resolute','
		America/Rio_Branco','	America/Rosario','	America/Santa_Isabel','	America/Santarem','	America/Santiago','
		America/Santo_Domingo','	America/Sao_Paulo','	America/Scoresbysund','	America/Shiprock','	America/Sitka','
		America/St_Barthelemy','	America/St_Johns','	America/St_Kitts','	America/St_Lucia','	America/St_Thomas','
		America/St_Vincent','	America/Swift_Current','	America/Tegucigalpa','	America/Thule','	America/Thunder_Bay','
		America/Tijuana','	America/Toronto','	America/Tortola','	America/Vancouver','	America/Virgin','
		America/Whitehorse','	America/Winnipeg','	America/Yakutat','	America/Yellowknife','Antarctica/Casey','	Antarctica/Davis','	Antarctica/DumontDUrville','	Antarctica/Macquarie','	Antarctica/Mawson','
		Antarctica/McMurdo','	Antarctica/Palmer','	Antarctica/Rothera','	Antarctica/South_Pole','	Antarctica/Syowa','
		Antarctica/Vostok','Arctic/Longyearbyen','Asia/Aden','	Asia/Almaty','Asia/Amman','Asia/Anadyr','Asia/Aqtau','
		Asia/Aqtobe','	Asia/Ashgabat','	Asia/Ashkhabad','	Asia/Baghdad','	Asia/Bahrain','
		Asia/Baku','	Asia/Bangkok','	Asia/Beirut','	Asia/Bishkek','	Asia/Brunei','
		Asia/Calcutta','	Asia/Choibalsan','	Asia/Chongqing','	Asia/Chungking','	Asia/Colombo','
		Asia/Dacca','	Asia/Damascus','	Asia/Dhaka','	Asia/Dili','	Asia/Dubai','
		Asia/Dushanbe','	Asia/Gaza','	Asia/Harbin','	Asia/Hebron','	Asia/Ho_Chi_Minh','
		Asia/Hong_Kong','	Asia/Hovd','	Asia/Irkutsk','	Asia/Istanbul','	Asia/Jakarta','
		Asia/Jayapura','	Asia/Jerusalem','	Asia/Kabul','	Asia/Kamchatka','	Asia/Karachi','
		Asia/Kashgar','	Asia/Kathmandu','	Asia/Katmandu','	Asia/Kolkata','	Asia/Krasnoyarsk','
		Asia/Kuala_Lumpur','	Asia/Kuching','	Asia/Kuwait','	Asia/Macao','	Asia/Macau','
		Asia/Magadan','	Asia/Makassar','	Asia/Manila','	Asia/Muscat','	Asia/Nicosia','
		Asia/Novokuznetsk','	Asia/Novosibirsk','	Asia/Omsk','	Asia/Oral','	Asia/Phnom_Penh','
		Asia/Pontianak','	Asia/Pyongyang','	Asia/Qatar','	Asia/Qyzylorda','	Asia/Rangoon','
		Asia/Riyadh','	Asia/Saigon','	Asia/Sakhalin','	Asia/Samarkand','	Asia/Seoul','
		Asia/Shanghai','	Asia/Singapore','	Asia/Taipei','	Asia/Tashkent','	Asia/Tbilisi','
		Asia/Tehran','	Asia/Tel_Aviv','	Asia/Thimbu','	Asia/Thimphu','	Asia/Tokyo','
		Asia/Ujung_Pandang','	Asia/Ulaanbaatar','	Asia/Ulan_Bator','	Asia/Urumqi','	Asia/Vientiane','
		Asia/Vladivostok','	Asia/Yakutsk','	Asia/Yekaterinburg','	Asia/Yerevan','Atlantic/Azores','Atlantic/Bermuda','	Atlantic/Canary','Atlantic/Cape_Verde','Atlantic/Faeroe','
		Atlantic/Faroe','Atlantic/Jan_Mayen','Atlantic/Madeira','Atlantic/Reykjavik','Atlantic/South_Georgia','
		Atlantic/St_Helena','Atlantic/Stanley','Australia/ACT','	Australia/Adelaide','	Australia/Brisbane','	Australia/Broken_Hill','	Australia/Canberra','
		Australia/Currie','	Australia/Darwin','	Australia/Eucla','	Australia/Hobart','	Australia/LHI','
		Australia/Lindeman','	Australia/Lord_Howe','	Australia/Melbourne','	Australia/North','	Australia/NSW','
		Australia/Perth','	Australia/Queensland','	Australia/South','	Australia/Sydney','	Australia/Tasmania','
		Australia/Victoria','	Australia/West','	Australia/Yancowinna','Europe/Amsterdam','	Europe/Andorra','	Europe/Athens','	Europe/Belfast','	Europe/Belgrade','
		Europe/Berlin','	Europe/Bratislava','	Europe/Brussels','	Europe/Bucharest','	Europe/Budapest','
		Europe/Chisinau','	Europe/Copenhagen','	Europe/Dublin','	Europe/Gibraltar','	Europe/Guernsey','
		Europe/Helsinki','	Europe/Isle_of_Man','	Europe/Istanbul','	Europe/Jersey','	Europe/Kaliningrad','
		Europe/Kiev','	Europe/Lisbon','	Europe/Ljubljana','	Europe/London','	Europe/Luxembourg','
		Europe/Madrid','	Europe/Malta','	Europe/Mariehamn','	Europe/Minsk','	Europe/Monaco','
		Europe/Moscow','	Europe/Nicosia','	Europe/Oslo','	Europe/Paris','	Europe/Podgorica','
		Europe/Prague','	Europe/Riga','	Europe/Rome','	Europe/Samara','	Europe/San_Marino','
		Europe/Sarajevo','	Europe/Simferopol','	Europe/Skopje','	Europe/Sofia','	Europe/Stockholm','
		Europe/Tallinn','	Europe/Tirane','	Europe/Tiraspol','	Europe/Uzhgorod','	Europe/Vaduz','
		Europe/Vatican','	Europe/Vienna','	Europe/Vilnius','	Europe/Volgograd','	Europe/Warsaw','
		Europe/Zagreb','	Europe/Zaporozhye','	Europe/Zurich','Indian/Antananarivo','	Indian/Chagos','	Indian/Christmas','	Indian/Cocos','	Indian/Comoro','
		Indian/Kerguelen','	Indian/Mahe','	Indian/Maldives','	Indian/Mauritius','	Indian/Mayotte','
		Indian/Reunion','Pacific/Apia','	Pacific/Auckland','	Pacific/Chatham','	Pacific/Chuuk','	Pacific/Easter','
		Pacific/Efate','	Pacific/Enderbury','	Pacific/Fakaofo','	Pacific/Fiji','	Pacific/Funafuti','
		Pacific/Galapagos','	Pacific/Gambier','	Pacific/Guadalcanal','	Pacific/Guam','	Pacific/Honolulu','
		Pacific/Johnston','	Pacific/Kiritimati','	Pacific/Kosrae','	Pacific/Kwajalein','	Pacific/Majuro','
		Pacific/Marquesas','	Pacific/Midway','	Pacific/Nauru','	Pacific/Niue','	Pacific/Norfolk','
		Pacific/Noumea','	Pacific/Pago_Pago','	Pacific/Palau','	Pacific/Pitcairn','	Pacific/Pohnpei','
		Pacific/Ponape','	Pacific/Port_Moresby','	Pacific/Rarotonga','	Pacific/Saipan','	Pacific/Samoa','
		Pacific/Tahiti','	Pacific/Tarawa','	Pacific/Tongatapu','	Pacific/Truk','	Pacific/Wake','
		Pacific/Wallis','	Pacific/Yap','Brazil/Acre','	Brazil/DeNoronha','	Brazil/East','	Brazil/West','	Canada/Atlantic','
		Canada/Central','	Canada/East-Saskatchewan','	Canada/Eastern','	Canada/Mountain','	Canada/Newfoundland','
		Canada/Pacific','	Canada/Saskatchewan','	Canada/Yukon','	CET','	Chile/Continental','
		Chile/EasterIsland','	CST6CDT','	Cuba','	EET','	Egypt','
		Eire','	EST','	EST5EDT','	Etc/GMT','	Etc/GMT+0','
		Etc/GMT+1','	Etc/GMT+10','	Etc/GMT+11','Etc/GMT+12','	Etc/GMT+2','
		Etc/GMT+3','	Etc/GMT+4','	Etc/GMT+5','Etc/GMT+6','	Etc/GMT+7','
		Etc/GMT+8','	Etc/GMT+9','	Etc/GMT-0','Etc/GMT-1','	Etc/GMT-10','
		Etc/GMT-11','	Etc/GMT-12','	Etc/GMT-13','Etc/GMT-14','	Etc/GMT-2','
		Etc/GMT-3','	Etc/GMT-4','	Etc/GMT-5','Etc/GMT-6','	Etc/GMT-7','
		Etc/GMT-8','	Etc/GMT-9','	Etc/GMT0','Etc/Greenwich','	Etc/UCT','
		Etc/Universal','	Etc/UTC','	Etc/Zulu','Factory','	GB','
		GB-Eire','	GMT','	GMT+0','	GMT-0','	GMT0','
		Greenwich','	Hongkong','	HST','	Iceland','	Iran','
		Israel','	Jamaica','	Japan','	Kwajalein','	Libya','
		MET','	Mexico/BajaNorte','	Mexico/BajaSur','	Mexico/General','	MST','
		MST7MDT','	Navajo','	NZ','	NZ-CHAT','	Poland','
		Portugal','	PRC','	PST8PDT','	ROC','	ROK','
		Singapore','	Turkey','	UCT','	Universal','	US/Alaska','
		US/Aleutian','	US/Arizona','	US/Central','	US/East-Indiana','	US/Eastern','
		US/Hawaii','	US/Indiana-Starke','	US/Michigan','	US/Mountain','	US/Pacific','
		US/Pacific-New','	US/Samoa','	UTC','	W-SU','	WET','
		Zulu');		
		return $sub_zone;
	}

	public function siteLanguages(){
		$array = array('Aboriginal Dialects','Afrikaans','Ainu','Akkadian','Albanian','Alurian','American Sign Language','Ancient Greek','Arabic','Arkian','Assamese','Assyrian','Asturian','Australian Sign Language','Aymara','Bahasa Indonesia','Basque','Basque Language-Euskara','Bengali','Berber','Bosnian','Brazilian Portuguese','Breton','British Sign Language','Buhi','Bulgarian','Burmese','Catalan','Cherokee','Chichewa','Chinese','Chinese - Cantonese','Chinese - Mandarin','Chinese - Taiwanese','Church Slavonic','Cornish','Corsican','Croatian','Czech','Dakota','Danish','Degaspregos','Dilhok','Dongxiang','Dutch','Egyptian','English','Esperanto','Estonian','Eurolang','Faroese','Farsi','Finnish','Flemmish','French','Frisian','Friulian','Gaelic','Galician','Georgian','German','Greek','Greenlandic','Guarani','Gujarati','Haponish','Hausa','Hawaiian','Hawaiian Pidgin English','Hebrew','Hindi','Hindustan','Hmong','Hungarian','Icelandic','Ido','Ingush','Irish','Irish Gaelic','Italian','Jameld','Japanese','Kankonian','Kannada','Kashmiri','Khmer','Kiswahili','Konkani','Korean','Kurdish','Ladin','Ladino','Lakhota','Latin','Latvian','Lithuanian','Loglan','Low Saxon','Luxembourgish','Malat','Malay','Malayalam','Manipuri','Manx Gaelic','Maori','Marathi','Mongolian','Neelan','Nepali','Norwegian','Novial','Occitan','Ojibwe','Oriya','Pashto','Pidgin','Polish','Portuguese','Prakrit','Punjabi','Quechua','Rhaeto -Romance','Romanian','Romany','Russian','Sami','Sanskrit','Scots','Scots Gaelic','Serbian','Shiyeyi','Sicilian','Sindhi','Sinhalese','Slovak','Slovene','Spanish','Swabian','Swahili','Swedish','Tagalog','Tamil','Telugu','Tengwar','Thai','Tibetan','Tok Pisin','Turkish','Ukrainian','Urdu','Uzbek','Vietnamese','Vogu','Welsh','Xhamagas','Xhosa','Yiddish','Yoruba','Zulu');
		return $array;
	}

	public function siteCurrency(){
		$array = array('KRW','AFN','ALL','DZD','AOA','ARS','AMD','AWG','AUD','AZN','BSD','BHD','BDT','BBD','BYR','BZD','BMD','BTN','BOB','BAM','BWP','BRL','BND','BGN','BIF','KHR','CAD','CVE','KYD','CLP','CNY','COP','XOF','XAF','KMF','XPF','CDF','CRC','HRK','CUC','CUP','CZK','DKK','DJF','DOP','XCD','EGP','SVC','ERN','ETB','EUR','FKP','FJD','GMD','GEL','GHS','GIP','GTQ','GGP','GNF','GYD','HTG','HNL','HKD','HUF','ISK','INR','IDR','XDR','IRR','IQD','IMP','ILS','JMD','JPY','JEP','JOD','KZT','KES','KPW','KWD','KGS','LAK','LBP','LSL','LRD','LYD','LTL','MOP','MKD','MGA','MWK','MYR','MVR','MRO','MUR','MXN','MDL','MNT','MAD','MZN','MMK','NAD','NPR','ANG','NZD','NIO','NGN','NOK','OMR','PKR','PAB','PGK','PYG','PEN','PHP','PLN','QAR','RON','RUB','RWF','SHP','WST','SAR','SPL','RSD','SCR','SLL','SGD','SBD','SOS','ZAR','LKR','SDG','SRD','SZL','SEK','CHF','SYP','STD','TWD','TJS','TZS','THB','TOP','TTD','TND','TRY','TMT','TVD','UGX','UAH','AED','GBP','USD','UYU','UZS','VUV','VEF','VND','YER','ZMW','ZWD');
		return $array;
	}

	public function reportTime($time){
		return date('M d Y, h:i A',strtotime($time));
	}

	public function reportDate($date){
		return date('M d, Y',strtotime($date));
	}

	public function isUsernameExist($username,$userId){
		$user = DB::table('jcm_users')->where('userId','<>',$userId)->where('username',$username)->first();
		if(count($user) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function isEmailExist($username,$userId){
		$user = DB::table('jcm_users')->where('userId','<>',$userId)->where('email',$email)->first();
		if(count($user) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function getCompanies(){
		return DB::table('jcm_companies')->where('companyStatus','=','Active')->get();
	}

	public function getOrders($userId){
		return DB::table('jcm_orders')->where('status','=','pending')->where('payment_mode','=','Cash Payment')->where('user_id','=',$userId)->get();
	}

	public function getUserCompanies(){
		return DB::table('jcm_companies')->get();
	}

	public function slugify($string){
		$string = str_replace(array("'",'"'),'',$string);
		return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
	}

	public function getVisitorCountry(){
		if(count(\Session::get('jcmUser')) > 0){
			if(\Session::get('jcmUser')->country != '0'){
				return \Session::get('jcmUser')->country;
			}
		}else{
			$ip = \Request::ip();
			$position = \Location::get($ip);
			$countryCode = $position->countryCode;

			$currentCountry = DB::table('jcm_countries')->where('sortname','=',$countryCode)->get();
			return $currentCountry[0]->id;
		}
		$requestIp = \Request::ip();
		$ip = $requestIp == '::1' ? '39.33.134.24' : $requestIp;
		if($_COOKIE['visitorCountry'] != '' && $_COOKIE['visitorIp'] == $ip){
			$return = $_COOKIE['visitorCountry'];
		}else{
		//	$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip//);
		//	$country = $xml->geoplugin_countryName ;
		//	$state = $xml->geoplugin_regionName;
		//	setcookie('visitorCountry', $country, time() + (86400 * 365), "/");
		//	setcookie('visitorState', $state, time() + (86400 * 365), "/");
		//	setcookie('visitorIp', $ip, time() + (86400 * 365), "/");
		//	$return = $country;
		}
		$state = $return != '' ? $return : 'Pakistan';
		return $this->countryId($return);
	}

	public function getVisitorState(){
		if(count(\Session::get('jcmUser')) > 0){
			if(\Session::get('jcmUser')->state != '0'){
				return \Session::get('jcmUser')->state;
			}
		}
		$requestIp = \Request::ip();
		$ip = $requestIp == '::1' ? '39.33.134.24' : $requestIp;
		if($_COOKIE['visitorState'] != '' && $_COOKIE['visitorIp'] == $ip){
			$return = $_COOKIE['visitorState'];
		}else{
			$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip);
			$state = $xml->geoplugin_regionName;
			$country = $xml->geoplugin_countryName ;
			setcookie('visitorState', $state, time() + (86400 * 365), "/");
			setcookie('visitorCountry', $country, time() + (86400 * 365), "/");
			setcookie('visitorIp', $ip, time() + (86400 * 365), "/");
			$return = $state;
		}
		$state = $return != '' ? $return : 'Punjab';
		$countryId = $this->getVisitorCountry();
		return $this->stateId($state,$countryId);
	}

	public function getCareerLevel(){
		return array('Entry ~ Employee','Chief ~ Asst.Manager','Manager ~ Deputy General Manager','General Manager','Executive ~ CEO');
	}

	public function getUpkillsType(){
		$upskill = DB::table('jcm_upskilltype')->get();
		return $upskill;
		//return array('Conference','Course','Seminar','Training','Webinar','Workshop');
	}

	public function getExperienceLevel(){
		return array('Student', 'Fresh Graduate', 'Experience', 'Fresh Graduate ~ Experience', '-1  Year', '+1  Year', '+2  Year', '+3  Year', '+4  Year', '+5  Year', '+6  Year', '+7  Year', '+8  Year', '+9  Year', '+10 Year', '+15 Year', '-20 Year', '-30 Year', '-50 Year', 'No Need Career');
		//return array('Student', 'Fresh Graduate', '< 1 Year', '1 Year', '2 Year', '3 Year', '4 Year', '5 Year', '< 10 Year', '10 Year', '< 20 Year', '< 30 Year', '< 50 Year');
	}

	//public function getExperienceLevel(){
		//return array('Student', 'Fresh Graduate', 'Experience', 'Fresh Graduate ~ Experience', '-1  Year', '+1  Year', '+2  Year', '+3  Year', '+4  Year', '+5  Year', '+6  Year', '+7  Year', '+8  Year', '+9  Year', '+10 Year', '+15 Year', '-20 Year', '-30 Year', '-50 Year', 'No Need Career');
	//}

	public function jobBenefits(){
		return array('National pension', 'Employment Insurance', 'Industrial accident insurance', 'Health Insurance', 'Severance Pay', 'Lunch offer', 'Vehicle oil subsidy', 'Overtime pay');
	}

	//추가
	public function jobProcess(){
		return array('Document Screening', 'human nature test', 'Chat', 'Video & Chat', 'First Interview', 'Second Interview', 'Examination for Employment', 'Final Pass');
	}

	public function getCategories(){
		$categories = DB::table('jcm_categories')->get();
		return $categories;
	}
	public function getReadCategories(){
		if(app()->getLocale() == "kr"){
			$readcategories = DB::table('jcm_read_category')->orderBy('name_ko','asc')->get();
		}else{
			$readcategories = DB::table('jcm_read_category')->orderBy('name','asc')->get();
		}
		return $readcategories;
	}

	public function categoryName($categoryId){
		return DB::table('jcm_categories')->where('categoryId','=',$categoryId)->first()->name;
	}
	public function readCategoryName($categoryId){
		return DB::table('jcm_read_category')->where('id','=',$categoryId)->first();
	}

	public function getSubCategories($subCategoryId){
		return DB::table('jcm_sub_categories')->where('categoryId','=',$subCategoryId)->get();
	}

	public function getSubCategories2($categoryId2){
		return DB::table('jcm_sub_categories2')->where('categoryId1','=',$categoryId2)->get();
	}

	public function getJobShifts(){
		$jobShifts = DB::table('jcm_job_shift')->get();
		return $jobShifts;
	}

	public function getJobType(){
		$jobTypes = DB::table('jcm_job_types')->get();
		return $jobTypes;
	}

	public function getJobCountries(){
		$jobCountries = DB::table('jcm_countries')->orderBy('id','asc')->get();
		return $jobCountries;
	}

	public function countryId($countryName){
		return DB::table('jcm_countries')->select('id')->where('name','=',$countryName)->get()->first()->id;
	}

	public function countryName($countryId){
		return DB::table('jcm_countries')->select('name')->where('id','=',$countryId)->get()->first()->name;
	}

	public function getJobStates($countryId){
		$jobCities = DB::table('jcm_states')->where('country_id','=',$countryId)->get();
		return $jobCities;
	}

	public function stateId($stateName,$countryId = 0){
		$state = DB::table('jcm_states')->select('id')->where('name','like','%'.$stateName.'%');
		if($countryId != 0){
			$state->where('country_id','=',$countryId);
		}
		return $state->get()->first()->id;
	}

	public function stateName($stateId){
		return DB::table('jcm_states')->select('name')->where('id','=',$stateId)->get()->first()->name;
	}

	public function getJobCities($stateId){
		$jobCities = DB::table('jcm_cities')->where('state_id','=',$stateId)->get();
		return $jobCities;
	}

	public function cityId($name){
		$record = DB::table('jcm_cities')->select('id')->where('name_ko','LIKE','%'.$name.'%');
		$rec = $record->get()->first();
		$return = '0';
		if(count($rec) > 0){
			$return = $rec->id;
		}
		return $return;
	}
	
	public function cityName($cityId){
		return DB::table('jcm_cities')->select('name')->where('id','=',$cityId)->get()->first()->name;
	}

	public function timeInYear($ptime){
		$sec = 'seconds'; $mint = 'minutes'; $hr = 'hours'; $day = 'days'; $month = 'months'; $yr = 'Years';

		if($ptime=='0000-00-00 00:00:00'){
			return 'x days ago';exit;
		}
		$etime = time() - strtotime($ptime);
		if ($etime < 1) { return '0 Year'; } 
		$interval = array( 12 * 30 * 24 * 60 * 60 =>  $yr,
				30 * 24 * 60 * 60       =>  $month,
				24 * 60 * 60            =>  $day,
				60 * 60                 =>  $hr,
				60                      =>  $mint,
				1                       =>  $sec
			);
		
		foreach ($interval as $secs => $str) {
			$d = $etime / $secs;
			if ($d >= 1) {
				$r = round($d);
				if($str == 'seconds' || $r == '0'){
					return  '0 Year';
				}
				elseif($r == 49)
				{
					return ' ';
				}
				else{
					return $r . ' ' . $str;
				}
			}
		}
	}

	public function timeDuration($date1,$date2,$min = ''){
		$date = strtotime("+1 day", strtotime($date2));
        $date3=date("Y-m-d", $date);
		$datetime1 = new \DateTime($date1);
		$datetime2 = new \DateTime($date3);
		
		//dd($datetime2);
		$interval = $datetime1->diff($datetime2);
		//if($min != ''){
			//return $interval->format('%mm %dd');
		//}else{
			//return $interval->format('%m months %d days');
		//}
		if($min != ''){
			if(app()->getLocale() == "kr"){
				return $interval->format('%m개월 %d일간');
			}else{
				return $interval->format('%mm %dd');
			}
			
		}else{
			if(app()->getLocale() == "kr"){
				return $interval->format('%m개월 %d일간');
			}else{
				return $interval->format('%m months %d days');
			}
			
		}
	}

	public function timeInDays($time){
		$start = strtotime(date('Y-m-d'));
		$end = strtotime($time);

		return ceil(abs($end - $start) / 86400);
	}

	public function categoryTitle($id){
		return DB::table('jcm_categories')->where('categoryId',$id)->first()->name;
	}

	public function subcategoryTitle($id){
		return DB::table('jcm_sub_categories')->where('subCategoryId',$id)->first()->subName;
	}

	public function subcategoryTitle2($id){
		return DB::table('jcm_sub_categories2')->where('subCategoryId2',$id)->first()->subName;
	}

	public function doArrayAction($type,$id,$array){
		if($type == 'remove'){
			foreach($array as $i => $k){
				if($k == $id){
					unset($array[$i]);
				}
			}
		}else{
			$array[] = $id;
		}
		return array_unique($array);
	}

	public function isAppliedToJob($userId,$jobId){
		$isAppl = DB::table('jcm_job_applied')->select('applyId')->where('userId','=',$userId)->where('jobId','=',$jobId)->get();
		if(count($isAppl) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function timeArray(){
		$array = array('01:00 AM', '01:15 AM', '01:30 AM', '01:45 AM', '02:00 AM', '02:15 AM', '02:30 AM', '02:45 AM', '03:00 AM', '03:15 AM', '03:30 AM', '03:45 AM', '04:00 AM', '04:15 AM', '04:30 AM', '04:45 AM', '05:00 AM', '05:15 AM', '05:30 AM', '05:45 AM',  '06:00 AM', '06:15 AM', '06:30 AM', '06:45 AM','07:00 AM', '07:15 AM', '07:30 AM', '07:45 AM','08:00 AM', '08:15 AM', '08:30 AM', '08:45 AM', '09:00 AM', '09:15 AM', '09:30 AM', '09:45 AM', '10:00 AM', '10:15 AM', '10:30 AM', '10:45 AM', '11:00 AM', '11:15 AM', '11:30 AM', '11:45 AM', '12:00 PM', '12:15 PM', '12:30 PM', '12:45 PM', '01:00 PM', '01:15 PM', '01:30 PM', '01:45 PM', '02:00 PM', '02:15 PM', '02:30 PM', '02:45 PM', '03:00 PM', '03:15 PM', '03:30 PM', '03:45 PM','04:00 PM', '04:15 PM', '04:30 PM', '04:45 PM','05:00 PM', '05:15 PM', '05:30 PM', '05:45 PM', '06:00 PM', '06:15 PM', '06:30 PM', '06:45 PM', '07:00 PM', '07:15 PM', '07:30 PM', '07:45 PM', '08:00 PM', '08:15 PM','08:30 PM', '08:45 PM', '09:00 PM', '09:15 PM', '09:30 PM', '09:45 PM', '10:00 PM','10:15 PM','10:30 PM','10:45 PM', '11:00 PM', '11:15 PM', '11:30 PM', '11:45 PM', '12:00 AM', '12:15 AM', '12:30 AM', '12:45 AM');
		return $array;
	}

	public function interviewVenue(){
		$app = \Session::get('jcmUser');

		$venues = DB::table('jcm_interview_venues')->select('venueId','title')->where('userId','=',$app->userId)->get();
		return $venues;
	}

	public function getDepartments(){
		$app = \Session::get('jcmUser');

		$departs = DB::table('jcm_departments')->select('departmentId','name')->where('userId','=',$app->userId)->get();
		return $departs;
	}

	public function departmentName($departmentId){
		return DB::table('jcm_departments')->select('name')->where('departmentId','=',$departmentId)->first()->name;
	}

	public function getVeneue($venueId){
		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->first();
		return $venue;
	}

	public function getJobInterview($jobId,$userId){
		return DB::table('jcm_job_interviews')->where('jobseekerId','=',$userId)->where('jobId','=',$jobId)->first();
	}

	public function getHomeCountry(){
		return $country = $this->getVisitorCountry();
		/*if($country == '109' || $country == '116' || $country == '166'){
			return $country;
		}else{
			return '166';
		}*/
	}

	public function getHomeCities(){
		
		/* the below code work to show citie on home page dynamic through ip*/

		$country = $this->getHomeCountry();
		if($country == '166'){
			$array = array('48315','31496','31594','31464','31362','31300','31580','31520','31375','31464','31376');
		}else if($country == '116'){
			$array = array('48316','48317','48318','48319','48320','48321','48322','48323','48324','48334','48325','48326','48327','48328','48329','48330','48331','48332','48333');
		}else{
			//166
			
			$array = array('2047','2048','2049','2050','2051','2052','2053','2054','2055','2056','2057','2058','2059','2060','2061','2062','2063');
			//$array = array('48316','48317','48318','48319','48320','48321','48322','48323','48324','48334','48325','48326','48327','48328','48329','48330','48331','48332','48333');
		}
		
		$cities = DB::table('jcm_states')->whereIn('id',$array)->get();
		//$cities = DB::table('jcm_cities')->whereIn('id',$array)->get();
		return $cities;
	}

	public function isResumeBuild($userId){
		$rec = DB::table('jcm_resume')->select('resumeId')->where('userId','=',$userId)->first();
		if(count($rec) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function hasCompany($userId){
		$rec = $this->getUser($userId);
		if($rec->companyId != '' && $rec->companyId != '0' && $rec->companyId != NULL){
			return true;
		}else{
			return false;
		}
	}

	public function countCompanyJobs($companyId){
		$rec = DB::table('jcm_jobs')->where('companyId','=',$companyId)->get();
		return count($rec);
	}
	public function getreadcat($id){
		return DB::table('jcm_read_category')->where('id','=',$id)->first()->name;
	}

	public function randomString($length = 32) {
	    $keys = array_merge(range(0,9), range('a', 'z'));

	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }

	    $user = DB::table('jcm_users')->where('secretId','=',$key)->first();
	    if(count($user) > 0){
	    	return $this->randomString();
	    }else{
		    return $key;
		}
	}
	public function getprivacy($userid){
		return DB::table("jcm_privacy_setting")->where('userId',$userid)->first();
	}
	public function registrationPassValidation($pass){

		if(!preg_match('/[A-Z]/', $pass)){
			return 1;
			
		}
		if(!preg_match('/[0-9]/', $pass)){
		 	return 1;
		 
		}
		if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $pass))
		{
		    return 1;
		 	
		} 
	}
	
}

?>