<?php 
 
class WowApi extends CApplicationComponent
{
    public function init()
    {
    	parent::init();
    }

    function apiRequest ($request, $fields = null) {
        $path = 'api/wow/';
        $path .= $request;
        $path .= '?locale=ru_RU';
        if (isset ($fields)) {
            $fields = '&fields='.$fields;
            $path .= $fields;
        }

        $url = 'http://eu.battle.net/'.$path;
        $response = http_get($url);

        return json_decode(http_parse_message($response)->body);
    }


    public function RealmsLoad () {
        $request = 'realm/status';
        $realms = $this->apiRequest($request);
        foreach ($realms->realms as $realm_id => $realm_api) {
            $model = new Realm;
            $model->apiLoad($realm_api);
        }

        return true;
    }

    public function GuildLoad ($guild_name = 'Вортекс', $realm = 'Черный-Шрам') {
        $request = 'guild/'.$this->strtolower_utf8($realm).'/'.$this->strtolower_utf8($guild_name);
        $fields = 'achievements,members';
        $guild = $this->apiRequest($request, $fields);
        if (!isset($guild->status)) {
            $model = new Guild;
            $model->apiLoad($guild, $this->strtolower_utf8($guild_name));  
        }

        return true;
    }

    public function getCharacter($character, $realm = 'Черный-Шрам', $fields = '') {
		$request = 'character/'.$this->strtolower_utf8($realm).'/'.$this->strtolower_utf8($character);
        $character_api = $this->apiRequest($request, $fields);

        return  $character_api;
    }

    public function strtolower_utf8($string){
        $convert_to = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
            "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
            "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
            "ь", "э", "ю", "я", "-"
                );
        $convert_from = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
            "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
            "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
            "Ь", "Э", "Ю", "Я", " "
        );


        return str_replace($convert_from, $convert_to, $string);  
    }   
 
}

?>