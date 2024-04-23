<?php
if( !defined( 'ABSPATH')){ exit(); }

/* название страны */
function is_country_attr($item){
	$item = pn_string($item);
	if (preg_match("/^[a-zA-z]{2,3}$/", $item, $matches )) {
		$new_item = $item;
	} else {
		$new_item = 0;
	}
	return $new_item;
}

function get_country_title($attr){
global $wpdb;
	$attr = is_country_attr($attr);
	if($attr and $attr != 'NaN'){	
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."geoip_country WHERE attr='$attr'");
		if(isset($data->title)){
			return pn_strip_input(ctv_ml($data->title));
		} else {
			return __('is not determined','pn');
		}
	} else {
		return __('is not determined','pn');
	}
}

function get_geoip_country(){
	
$country = "
[en_US:]Australia[:en_US][ru_RU:]Австралия[:ru_RU];AU
[en_US:]Austria[:en_US][ru_RU:]Австрия[:ru_RU];AT
[en_US:]Azerbaijan[:en_US][ru_RU:]Азербайджан[:ru_RU];AZ
[en_US:]Aland Islands[:en_US][ru_RU:]Аландские острова[:ru_RU];AX
[en_US:]Albania[:en_US][ru_RU:]Албания[:ru_RU];AL
[en_US:]Algeria[:en_US][ru_RU:]Алжир[:ru_RU];DZ
[en_US:]Minor outlying Islands (USA)[:en_US][ru_RU:]Внешние малые острова (США)[:ru_RU];UM
[en_US:]U.S. virgin Islands[:en_US][ru_RU:]Американские Виргинские острова[:ru_RU];VI
[en_US:]American Samoa[:en_US][ru_RU:]Американское Самоа[:ru_RU];AS
[en_US:]Anguilla[:en_US][ru_RU:]Ангилья[:ru_RU];AI
[en_US:]Angola[:en_US][ru_RU:]Ангола[:ru_RU];AO
[en_US:]Andorra[:en_US][ru_RU:]Андорра[:ru_RU];AD
[en_US:]Antarctica[:en_US][ru_RU:]Антарктида[:ru_RU];AQ
[en_US:]Antigua and Barbuda[:en_US][ru_RU:]Антигуа и Барбуда[:ru_RU];AG
[en_US:]Argentina[:en_US][ru_RU:]Аргентина[:ru_RU];AR
[en_US:]Armenia[:en_US][ru_RU:]Армения[:ru_RU];AM
[en_US:]Aruba[:en_US][ru_RU:]Аруба[:ru_RU];AW
[en_US:]Afghanistan[:en_US][ru_RU:]Афганистан[:ru_RU];AF
[en_US:]Bahamas[:en_US][ru_RU:]Багамы[:ru_RU];BS
[en_US:]Bangladesh[:en_US][ru_RU:]Бангладеш[:ru_RU];BD
[en_US:]Barbados[:en_US][ru_RU:]Барбадос[:ru_RU];BB
[en_US:]Bahrain[:en_US][ru_RU:]Бахрейн[:ru_RU];BH
[en_US:]Belize[:en_US][ru_RU:]Белиз[:ru_RU];BZ
[en_US:]Belarus[:en_US][ru_RU:]Белоруссия[:ru_RU];BY
[en_US:]Belgium[:en_US][ru_RU:]Бельгия[:ru_RU];BE
[en_US:]Benin[:en_US][ru_RU:]Бенин[:ru_RU];BJ
[en_US:]Bermuda[:en_US][ru_RU:]Бермуды[:ru_RU];BM
[en_US:]Bulgaria[:en_US][ru_RU:]Болгария[:ru_RU];BG
[en_US:]Bolivia[:en_US][ru_RU:]Боливия[:ru_RU];BO
[en_US:]Bosnia and Herzegovina[:en_US][ru_RU:]Босния и Герцеговина[:ru_RU];BA
[en_US:]Botswana[:en_US][ru_RU:]Ботсвана[:ru_RU];BW
[en_US:]Brazil[:en_US][ru_RU:]Бразилия[:ru_RU];BR
[en_US:]British Indian ocean territory[:en_US][ru_RU:]Британская территория в Индийском океане[:ru_RU];IO
[en_US:]British virgin Islands[:en_US][ru_RU:]Британские Виргинские острова[:ru_RU];VG
[en_US:]Brunei[:en_US][ru_RU:]Бруней[:ru_RU];BN
[en_US:]Burkina Faso[:en_US][ru_RU:]Буркина Фасо[:ru_RU];BF
[en_US:]Burundi[:en_US][ru_RU:]Бурунди[:ru_RU];BI
[en_US:]Bhutan[:en_US][ru_RU:]Бутан[:ru_RU];BT
[en_US:]Vanuatu[:en_US][ru_RU:]Вануату[:ru_RU];VU
[en_US:]The Vatican[:en_US][ru_RU:]Ватикан[:ru_RU];VA
[en_US:]UK[:en_US][ru_RU:]Великобритания[:ru_RU];GB
[en_US:]Hungary[:en_US][ru_RU:]Венгрия[:ru_RU];HU
[en_US:]Venezuela[:en_US][ru_RU:]Венесуэла[:ru_RU];VE
[en_US:]East Timor[:en_US][ru_RU:]Восточный Тимор[:ru_RU];TL
[en_US:]Vietnam[:en_US][ru_RU:]Вьетнам[:ru_RU];VN
[en_US:]Gabon[:en_US][ru_RU:]Габон[:ru_RU];GA
[en_US:]Haiti[:en_US][ru_RU:]Гаити[:ru_RU];HT
[en_US:]Guyana[:en_US][ru_RU:]Гайана[:ru_RU];GY
[en_US:]Gambia[:en_US][ru_RU:]Гамбия[:ru_RU];GM
[en_US:]Ghana[:en_US][ru_RU:]Гана[:ru_RU];GH
[en_US:]Guadeloupe[:en_US][ru_RU:]Гваделупа[:ru_RU];GP
[en_US:]Guatemala[:en_US][ru_RU:]Гватемала[:ru_RU];GT
[en_US:]Guinea[:en_US][ru_RU:]Гвинея[:ru_RU];GN
[en_US:]Guinea-Bissau[:en_US][ru_RU:]Гвинея-Бисау[:ru_RU];GW
[en_US:]Germany[:en_US][ru_RU:]Германия[:ru_RU];DE
[en_US:]Gibraltar[:en_US][ru_RU:]Гибралтар[:ru_RU];GI
[en_US:]Honduras[:en_US][ru_RU:]Гондурас[:ru_RU];HN
[en_US:]Hong Kong[:en_US][ru_RU:]Гонконг[:ru_RU];HK
[en_US:]Grenada[:en_US][ru_RU:]Гренада[:ru_RU];GD
[en_US:]Greenland[:en_US][ru_RU:]Гренландия[:ru_RU];GL
[en_US:]Greece[:en_US][ru_RU:]Греция[:ru_RU];GR
[en_US:]Georgia[:en_US][ru_RU:]Грузия[:ru_RU];GE
[en_US:]GUAM[:en_US][ru_RU:]Гуам[:ru_RU];GU
[en_US:]Denmark[:en_US][ru_RU:]Дания[:ru_RU];DK
[en_US:]DR Congo[:en_US][ru_RU:]ДР Конго[:ru_RU];CD
[en_US:]Djibouti[:en_US][ru_RU:]Джибути[:ru_RU];DJ
[en_US:]Dominica[:en_US][ru_RU:]Доминика[:ru_RU];DM
[en_US:]Dominican Republic[:en_US][ru_RU:]Доминиканская Республика[:ru_RU];DO
[en_US:]The European Union[:en_US][ru_RU:]Европейский союз[:ru_RU];EU
[en_US:]Egypt[:en_US][ru_RU:]Египет[:ru_RU];EG
[en_US:]Zambia[:en_US][ru_RU:]Замбия[:ru_RU];ZM
[en_US:]Western Sahara[:en_US][ru_RU:]Западная Сахара[:ru_RU];EH
[en_US:]Zimbabwe[:en_US][ru_RU:]Зимбабве[:ru_RU];ZW
[en_US:]Israel[:en_US][ru_RU:]Израиль[:ru_RU];IL
[en_US:]India[:en_US][ru_RU:]Индия[:ru_RU];IN
[en_US:]Indonesia[:en_US][ru_RU:]Индонезия[:ru_RU];ID
[en_US:]Jordan[:en_US][ru_RU:]Иордания[:ru_RU];JO
[en_US:]Iraq[:en_US][ru_RU:]Ирак[:ru_RU];IQ
[en_US:]Iran[:en_US][ru_RU:]Иран[:ru_RU];IR
[en_US:]Ireland[:en_US][ru_RU:]Ирландия[:ru_RU];IE
[en_US:]Iceland[:en_US][ru_RU:]Исландия[:ru_RU];IS
[en_US:]Spain[:en_US][ru_RU:]Испания[:ru_RU];ES
[en_US:]Italy[:en_US][ru_RU:]Италия[:ru_RU];IT
[en_US:]Yemen[:en_US][ru_RU:]Йемен[:ru_RU];YE
[en_US:]The DPRK[:en_US][ru_RU:]КНДР[:ru_RU];KP
[en_US:]Cape Verde[:en_US][ru_RU:]Кабо-Верде[:ru_RU];CV
[en_US:]Kazakhstan[:en_US][ru_RU:]Казахстан[:ru_RU];KZ
[en_US:]Cayman Islands[:en_US][ru_RU:]Каймановы острова[:ru_RU];KY
[en_US:]Cambodia[:en_US][ru_RU:]Камбоджа[:ru_RU];KH
[en_US:]Cameroon[:en_US][ru_RU:]Камерун[:ru_RU];CM
[en_US:]Canada[:en_US][ru_RU:]Канада[:ru_RU];CA
[en_US:]Qatar[:en_US][ru_RU:]Катар[:ru_RU];QA
[en_US:]Kenya[:en_US][ru_RU:]Кения[:ru_RU];KE
[en_US:]Cyprus[:en_US][ru_RU:]Кипр[:ru_RU];CY
[en_US:]Kyrgyzstan[:en_US][ru_RU:]Киргизия[:ru_RU];KG
[en_US:]Kiribati[:en_US][ru_RU:]Кирибати[:ru_RU];KI
[en_US:]China[:en_US][ru_RU:]КНР[:ru_RU];CN
[en_US:]Cocos Islands[:en_US][ru_RU:]Кокосовые острова[:ru_RU];CC
[en_US:]Colombia[:en_US][ru_RU:]Колумбия[:ru_RU];CO
[en_US:]Comoros[:en_US][ru_RU:]Коморы[:ru_RU];KM
[en_US:]Costa Rica[:en_US][ru_RU:]Коста-Рика[:ru_RU];CR
[en_US:]Côte d'ivoire[:en_US][ru_RU:]Кот-д’Ивуар[:ru_RU];CI
[en_US:]Cuba[:en_US][ru_RU:]Куба[:ru_RU];CU
[en_US:]Kuwait[:en_US][ru_RU:]Кувейт[:ru_RU];KW
[en_US:]Laos[:en_US][ru_RU:]Лаос[:ru_RU];LA
[en_US:]Latvia[:en_US][ru_RU:]Латвия[:ru_RU];LV
[en_US:]Lesotho[:en_US][ru_RU:]Лесото[:ru_RU];LS
[en_US:]Liberia[:en_US][ru_RU:]Либерия[:ru_RU];LR
[en_US:]Lebanon[:en_US][ru_RU:]Ливан[:ru_RU];LB
[en_US:]Libya[:en_US][ru_RU:]Ливия[:ru_RU];LY
[en_US:]Lithuania[:en_US][ru_RU:]Литва[:ru_RU];LT
[en_US:]Liechtenstein[:en_US][ru_RU:]Лихтенштейн[:ru_RU];LI
[en_US:]Luxembourg[:en_US][ru_RU:]Люксембург[:ru_RU];LU
[en_US:]Mauritius[:en_US][ru_RU:]Маврикий[:ru_RU];MU
[en_US:]Mauritania[:en_US][ru_RU:]Мавритания[:ru_RU];MR
[en_US:]Madagascar[:en_US][ru_RU:]Мадагаскар[:ru_RU];MG
[en_US:]Mayotte[:en_US][ru_RU:]Майотта[:ru_RU];YT
[en_US:]Macau[:en_US][ru_RU:]Аомынь[:ru_RU];MO
[en_US:]Macedonia[:en_US][ru_RU:]Македония[:ru_RU];MK
[en_US:]Malawi[:en_US][ru_RU:]Малави[:ru_RU];MW
[en_US:]Malaysia[:en_US][ru_RU:]Малайзия[:ru_RU];MY
[en_US:]Mali[:en_US][ru_RU:]Мали[:ru_RU];ML
[en_US:]The Maldives[:en_US][ru_RU:]Мальдивы[:ru_RU];MV
[en_US:]Malta[:en_US][ru_RU:]Мальта[:ru_RU];MT
[en_US:]Morocco[:en_US][ru_RU:]Марокко[:ru_RU];MA
[en_US:]Martinique[:en_US][ru_RU:]Мартиника[:ru_RU];MQ
[en_US:]Marshall Islands[:en_US][ru_RU:]Маршалловы Острова[:ru_RU];MH
[en_US:]Mexico[:en_US][ru_RU:]Мексика[:ru_RU];MX
[en_US:]Mozambique[:en_US][ru_RU:]Мозамбик[:ru_RU];MZ
[en_US:]Moldova[:en_US][ru_RU:]Молдавия[:ru_RU];MD
[en_US:]Monaco[:en_US][ru_RU:]Монако[:ru_RU];MC
[en_US:]Mongolia[:en_US][ru_RU:]Монголия[:ru_RU];MN
[en_US:]Montserrat[:en_US][ru_RU:]Монтсеррат[:ru_RU];MS
[en_US:]Myanmar[:en_US][ru_RU:]Мьянма[:ru_RU];MM
[en_US:]Namibia[:en_US][ru_RU:]Намибия[:ru_RU];NA
[en_US:]Nauru[:en_US][ru_RU:]Науру[:ru_RU];NR
[en_US:]Nepal[:en_US][ru_RU:]Непал[:ru_RU];NP
[en_US:]Niger[:en_US][ru_RU:]Нигер[:ru_RU];NE
[en_US:]Nigeria[:en_US][ru_RU:]Нигерия[:ru_RU];NG
[en_US:]Netherlands Antilles[:en_US][ru_RU:]Нидерландские Антильские острова[:ru_RU];AN
[en_US:]The Netherlands[:en_US][ru_RU:]Нидерланды[:ru_RU];NL
[en_US:]Nicaragua[:en_US][ru_RU:]Никарагуа[:ru_RU];NI
[en_US:]Niue[:en_US][ru_RU:]Ниуэ[:ru_RU];NU
[en_US:]New Caledonia[:en_US][ru_RU:]Новая Каледония[:ru_RU];NC
[en_US:]New Zealand[:en_US][ru_RU:]Новая Зеландия[:ru_RU];NZ
[en_US:]Norway[:en_US][ru_RU:]Норвегия[:ru_RU];NO
[en_US:]UAE[:en_US][ru_RU:]ОАЭ[:ru_RU];AE
[en_US:]Oman[:en_US][ru_RU:]Оман[:ru_RU];OM
[en_US:]Christmas Island[:en_US][ru_RU:]Остров Рождества[:ru_RU];CX
[en_US:]Cook Islands[:en_US][ru_RU:]Острова Кука[:ru_RU];CK
[en_US:]Heard and McDonald[:en_US][ru_RU:]Херд и Макдональд[:ru_RU];HM
[en_US:]Pakistan[:en_US][ru_RU:]Пакистан[:ru_RU];PK
[en_US:]Palau[:en_US][ru_RU:]Палау[:ru_RU];PW
[en_US:]Palestine[:en_US][ru_RU:]Палестина[:ru_RU];PS
[en_US:]Panama[:en_US][ru_RU:]Панама[:ru_RU];PA
[en_US:]Papua New Guinea[:en_US][ru_RU:]Папуа — Новая Гвинея[:ru_RU];PG
[en_US:]Paraguay[:en_US][ru_RU:]Парагвай[:ru_RU];PY
[en_US:]Peru[:en_US][ru_RU:]Перу[:ru_RU];PE
[en_US:]Pitcairn Islands[:en_US][ru_RU:]Острова Питкэрн[:ru_RU];PN
[en_US:]Poland[:en_US][ru_RU:]Польша[:ru_RU];PL
[en_US:]Portugal[:en_US][ru_RU:]Португалия[:ru_RU];PT
[en_US:]Puerto Rico[:en_US][ru_RU:]Пуэрто-Рико[:ru_RU];PR
[en_US:]Republic Of The Congo[:en_US][ru_RU:]Республика Конго[:ru_RU];CG
[en_US:]Reunion[:en_US][ru_RU:]Реюньон[:ru_RU];RE
[en_US:]Russia[:en_US][ru_RU:]Россия[:ru_RU];RU
[en_US:]Rwanda[:en_US][ru_RU:]Руанда[:ru_RU];RW
[en_US:]Romania[:en_US][ru_RU:]Румыния[:ru_RU];RO
[en_US:]USA[:en_US][ru_RU:]США[:ru_RU];US
[en_US:]Salvador[:en_US][ru_RU:]Сальвадор[:ru_RU];SV
[en_US:]Samoa[:en_US][ru_RU:]Самоа[:ru_RU];WS
[en_US:]San Marino[:en_US][ru_RU:]Сан-Марино[:ru_RU];SM
[en_US:]Sao Tome and Principe[:en_US][ru_RU:]Сан-Томе и Принсипи[:ru_RU];ST
[en_US:]Saudi Arabia[:en_US][ru_RU:]Саудовская Аравия[:ru_RU];SA
[en_US:]Swaziland[:en_US][ru_RU:]Свазиленд[:ru_RU];SZ
[en_US:]Svalbard and Jan Mayen[:en_US][ru_RU:]Шпицберген и Ян-Майен[:ru_RU];SJ
[en_US:]Northern Mariana Islands[:en_US][ru_RU:]Северные Марианские острова[:ru_RU];MP
[en_US:]Seychelles[:en_US][ru_RU:]Сейшельские Острова[:ru_RU];SC
[en_US:]Senegal[:en_US][ru_RU:]Сенегал[:ru_RU];SN
[en_US:]Saint Vincent and the Grenadines[:en_US][ru_RU:]Сент-Винсент и Гренадины[:ru_RU];VC
[en_US:]Saint Kitts and Nevis[:en_US][ru_RU:]Сент-Китс и Невис[:ru_RU];KN
[en_US:]Saint Lucia[:en_US][ru_RU:]Сент-Люсия[:ru_RU];LC
[en_US:]Saint Pierre and Miquelon[:en_US][ru_RU:]Сен-Пьер и Микелон[:ru_RU];PM
[en_US:]Serbia[:en_US][ru_RU:]Сербия[:ru_RU];RS
[en_US:]Serbia and Montenegro (operated until September 2006)[:en_US][ru_RU:]Сербия и Черногория (действовал до сентября 2006 года)[:ru_RU];CS
[en_US:]Singapore[:en_US][ru_RU:]Сингапур[:ru_RU];SG
[en_US:]Syria[:en_US][ru_RU:]Сирия[:ru_RU];SY
[en_US:]Slovakia[:en_US][ru_RU:]Словакия[:ru_RU];SK
[en_US:]Slovenia[:en_US][ru_RU:]Словения[:ru_RU];SI
[en_US:]Solomon Islands[:en_US][ru_RU:]Соломоновы Острова[:ru_RU];SB
[en_US:]Somalia[:en_US][ru_RU:]Сомали[:ru_RU];SO
[en_US:]Sudan[:en_US][ru_RU:]Судан[:ru_RU];SD
[en_US:]Suriname[:en_US][ru_RU:]Суринам[:ru_RU];SR
[en_US:]Sierra Leone[:en_US][ru_RU:]Сьерра-Леоне[:ru_RU];SL
[en_US:]The USSR was valid until September 1992)[:en_US][ru_RU:]СССР (действовал до сентября 1992 года)[:ru_RU];SU
[en_US:]Tajikistan[:en_US][ru_RU:]Таджикистан[:ru_RU];TJ
[en_US:]Thailand[:en_US][ru_RU:]Таиланд[:ru_RU];TH
[en_US:]The Republic Of China[:en_US][ru_RU:]Китайская Республика[:ru_RU];TW
[en_US:]Tanzania[:en_US][ru_RU:]Танзания[:ru_RU];TZ
[en_US:]In[:en_US][ru_RU:]Того[:ru_RU];TG
[en_US:]Tokelau[:en_US][ru_RU:]Токелау[:ru_RU];TK
[en_US:]Tonga[:en_US][ru_RU:]Тонга[:ru_RU];TO
[en_US:]Trinidad and Tobago[:en_US][ru_RU:]Тринидад и Тобаго[:ru_RU];TT
[en_US:]Tuvalu[:en_US][ru_RU:]Тувалу[:ru_RU];TV
[en_US:]Tunisia[:en_US][ru_RU:]Тунис[:ru_RU];TN
[en_US:]Turkmenistan[:en_US][ru_RU:]Туркмения[:ru_RU];TM
[en_US:]Turkey[:en_US][ru_RU:]Турция[:ru_RU];TR
[en_US:]Uganda[:en_US][ru_RU:]Уганда[:ru_RU];UG
[en_US:]Uzbekistan[:en_US][ru_RU:]Узбекистан[:ru_RU];UZ
[en_US:]Ukraine[:en_US][ru_RU:]Украина[:ru_RU];UA
[en_US:]Uruguay[:en_US][ru_RU:]Уругвай[:ru_RU];UY
[en_US:]Faroe Islands[:en_US][ru_RU:]Фарерские острова[:ru_RU];FO
[en_US:]Micronesia[:en_US][ru_RU:]Микронезия[:ru_RU];FM
[en_US:]Fiji[:en_US][ru_RU:]Фиджи[:ru_RU];FJ
[en_US:]Philippines[:en_US][ru_RU:]Филиппины[:ru_RU];PH
[en_US:]Finland[:en_US][ru_RU:]Финляндия[:ru_RU];FI
[en_US:]Falkland Islands[:en_US][ru_RU:]Фолклендские острова[:ru_RU];FK
[en_US:]France[:en_US][ru_RU:]Франция[:ru_RU];FR
[en_US:]French Guiana[:en_US][ru_RU:]Французская Гвиана[:ru_RU];GF
[en_US:]French Polynesia[:en_US][ru_RU:]Французская Полинезия[:ru_RU];PF
[en_US:]French Southern and Antarctic lands[:en_US][ru_RU:]Французские Южные и Антарктические Территории[:ru_RU];TF
[en_US:]Croatia[:en_US][ru_RU:]Хорватия[:ru_RU];HR
[en_US:]CAR[:en_US][ru_RU:]ЦАР[:ru_RU];CF
[en_US:]Chad[:en_US][ru_RU:]Чад[:ru_RU];TD
[en_US:]Montenegro[:en_US][ru_RU:]Черногория[:ru_RU];ME
[en_US:]Czech Republic[:en_US][ru_RU:]Чехия[:ru_RU];CZ
[en_US:]Chile[:en_US][ru_RU:]Чили[:ru_RU];CL
[en_US:]Switzerland[:en_US][ru_RU:]Швейцария[:ru_RU];CH
[en_US:]Sweden[:en_US][ru_RU:]Швеция[:ru_RU];SE
[en_US:]Sri Lanka[:en_US][ru_RU:]Шри-Ланка[:ru_RU];LK
[en_US:]Ecuador[:en_US][ru_RU:]Эквадор[:ru_RU];EC
[en_US:]Equatorial Guinea[:en_US][ru_RU:]Экваториальная Гвинея[:ru_RU];GQ
[en_US:]Eritrea[:en_US][ru_RU:]Эритрея[:ru_RU];ER
[en_US:]Estonia[:en_US][ru_RU:]Эстония[:ru_RU];EE
[en_US:]Ethiopia[:en_US][ru_RU:]Эфиопия[:ru_RU];ET
[en_US:]South Africa[:en_US][ru_RU:]ЮАР[:ru_RU];ZA
[en_US:]The Republic Of Korea[:en_US][ru_RU:]Республика Корея[:ru_RU];KR
[en_US:]South Georgia and the South sandwich Islands[:en_US][ru_RU:]Южная Георгия и Южные Сандвичевы острова[:ru_RU];GS
[en_US:]Jamaica[:en_US][ru_RU:]Ямайка[:ru_RU];JM
[en_US:]Japan[:en_US][ru_RU:]Япония[:ru_RU];JP
[en_US:]Bouvet Island[:en_US][ru_RU:]Остров Буве[:ru_RU];BV
[en_US:]Norfolk Island[:en_US][ru_RU:]Остров Норфолк[:ru_RU];NF
[en_US:]St. Helena Island[:en_US][ru_RU:]Остров Святой Елены[:ru_RU];SH
[en_US:]Turks and Caicos Islands[:en_US][ru_RU:]Тёркс и Кайкос[:ru_RU];TC
[en_US:]Wallis and Futuna[:en_US][ru_RU:]Уоллис и Футуна[:ru_RU];WF
";	

	$array = array();	
	$country = explode("\n",$country);
	foreach($country as $cou){
		$data = explode(';',$cou);
		
		$title = trim(is_isset($data,0));
		$attr = trim(is_isset($data,1));
		if($title and $attr){
			
			$array[$attr] = $title;

		}
	}	
	
	asort($array);
	
	return $array;
}

function translate_yandex($word=''){
	if($word){
		$key = 'trnsl.1.1.20150518T052838Z.8fb02647eea4e432.41063bbb2fd720c2d90175e84e298a1247fc9239';
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_URL, 'https://translate.yandex.net/api/v1.5/tr/translate?key='. $key .'&text='.$word.'&lang=ru-en');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 11.00');
			curl_setopt($curl, CURLOPT_TIMEOUT, 25);
			$err  = curl_errno($curl);
			$out = curl_exec($curl);
			curl_close($curl);
			if(!$err){
				if(is_string($out)){
					if(strstr($out,'<?xml')){
					   $res = @simplexml_load_string($out);
					   return (string)$res->text;
					} else {
						return $word;
					}
				} else {
					return $word;
				}
			} else {
				return $word;
			}
		} else {
			return $word;
		}
	}
}

add_action('init', 'geoip_init', 0);
function geoip_init(){ 
global $wpdb, $user_now_country, $premiumbox;
	$user_now_country = 'NaN';
	if(!is_admin()){
		$notban = 0;
		$agent = is_isset($_SERVER,'HTTP_USER_AGENT');
		if(preg_match("/Google/i", $agent) or preg_match("/Yandex/i", $agent)){
			$notban = 1;
		} 
		
		$ip = pn_real_ip();
		$ccwhite = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."geoip_whiteip WHERE theip='$ip'");
		if($ccwhite > 0){	
			$notban = 1;
		}	
		
		$ccblock = $wpdb->get_var("SELECT COUNT(id) FROM ". $wpdb->prefix ."geoip_blackip WHERE theip='$ip'");
		if($ccblock > 0 and $notban == 0){
			header('Content-Type: text/html; charset=utf-8');
			
			$temp = '
			<html '. get_language_attributes() .'>
			<head profile="http://gmpg.org/xfn/11">

			<meta charset="'. get_bloginfo( 'charset' ) .'">

			<title>'. __('Your ip is blocked','pn') .'</title>

			<link rel="stylesheet" href="'. $premiumbox->plugin_url .'moduls/geoip/sitestyle.css" type="text/css" media="screen" />

			</head>
			<body class="' . join( ' ', get_body_class() ) . '">
			<div id="container">


				<div class="title">'. __('Your ip is blocked','pn') .'</div>
				
				<div class="content">
					<div class="text">
						'. __('Access to the website is prohibited','pn') .'
					</div>	
				</div>

			</div>
			</body>
			</html>
			';
			
			echo apply_filters('geoip_blockip_temp', $temp, $ip);
			exit;
		}	
		
		$ip = sprintf('%u', ip2long($ip));
		$data = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."geoip_iplist WHERE before_cip < $ip AND after_cip > $ip");
		if(isset($data->id)){
			$country_attr = $user_now_country = is_country_attr($data->country_attr);
			$cdata = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."geoip_country WHERE attr='$country_attr'");
			if(isset($cdata->id)){	
				if($cdata->status == 0 and $notban == 0){
					
					$temp_id = intval($cdata->temp_id);
					$title = __('Access denied','pn');
					$content = __('Access to website for your country is prohibited','pn');
					$placeinfo = 0;
					$place = '';
					
					if($temp_id > 0){
						$wdata = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."geoip_template WHERE id='$temp_id'");
						if(isset($wdata->id)){
							$title = pn_strip_input($wdata->title);
							$content = pn_strip_text($wdata->content);
						}
					} else {
						$wdata = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."geoip_template WHERE default_temp='1'");
						if(isset($wdata->id)){
							$title = pn_strip_input($wdata->title);
							$content = pn_strip_text($wdata->content);
						}				
					}
					
					header('Content-Type: text/html; charset=utf-8');
					
					$temp ='
					<html '. get_language_attributes() .'>
					<head profile="http://gmpg.org/xfn/11">

					<meta charset="'. get_bloginfo( 'charset' ) .'">

					<title>'. $title .'</title>

					<link rel="stylesheet" href="'. $premiumbox->plugin_url .'moduls/geoip/sitestyle.css" type="text/css" media="screen" />

					</head>
					<body class="' . join( ' ', get_body_class() ) . '">
					<div id="container">
						<div class="title">'. $title .'</div>
						<div class="content">
							<div class="text">
								'. apply_filters('comment_text', $content) .'
							</div>	
						</div>
					</div>
					</body>
					</html>
					';
					echo apply_filters('geoip_bloccountry_temp',$temp, $title, $content, $cdata);
					exit;
				}
			}
		}
	}	
}