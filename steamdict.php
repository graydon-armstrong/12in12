<?php

class SteamApiConnector
{
    private $_steam_api_key = '';
    private $_steam_api_id = '';
    
    public function __construct($steam_api_key, $steam_api_id)
    {
        $this->_steam_api_key = $steam_api_key;
        $this->_steam_api_id = $steam_api_id;
    }
    
    public function getOwnedGames()
    {
        $json = file_get_contents($this->ownedGamesUrl());
        $response = $this->decodeJsonResponse($json);
        
        return $response;
    }
    
    private function ownedGamesUrl()
    {
        $url = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key={$this->_steam_api_key}&steamid={$this->_steam_api_id}&include_appinfo=1&format=json";
        return $url;
    }
    
    private function decodeJsonResponse($json)
    {
        $response = json_decode($json, true)['response'];
        return $response;
    }
}

class OwnedGamesDict
{
    private $_games_count;
    private $_games;
    
    public function __construct($owned_games_dict)
    {
        $this->_games_count = $owned_games_dict['game_count'];
        $this->_games = $this->buildGamesDict($owned_games_dict['games']);
    }
    
    public function __toString()
    {
        $build_string = "";
        $build_string .= "Number of games in account: {$this->_games_count}<br><br>";
        
        foreach ($this->_games as $game)
        {
            $build_string .= $game->__toString();
        }
        
        return $build_string;
    }
    
    private function buildGamesDict($owned_games_json)
    {
        $games_array = [];
        foreach ($owned_games_json as $game_json)
        {
            $games_array[] = new SteamGame($game_json['appid'],
                                           $game_json['name'],
                                           $game_json['playtime_forever'],
                                           $game_json['img_logo_url']);
        }
        
        return $games_array;
    }
}

class SteamGame
{
    private $_app_id;
    private $_name;
    private $_playtime_forever;
    private $_img_id;
    
    public function __construct($app_id, $name, $playtime_forever, $img_id)
    {
        $this->_app_id = $app_id;
        $this->_name = $name;
        $this->_playtime_forever = $playtime_forever;
        $this->_img_id = $img_id;
    }
    
    public function __toString()
    {
        $build_string = "";

        $build_string .= "Appid: {$this->getAppId()}<br>";
        $build_string .= "Game Name: {$this->getName()}<br>";
        $build_string .= "Playtime in Minutes: {$this->getPlaytimeForever()}<br>";
        $build_string .= "<img src='http://media.steampowered.com/steamcommunity/public/images/apps/{$this->getAppId()}/{$this->getImgId()}.jpg'><br><br>";

        return $build_string;
    }
    
    public function getAppId()
    {
        return $this->_app_id;
    }
    
    public function getName()
    {
        return $this->_name;
    }
    
    public function getPlaytimeForever()
    {
        return $this->_playtime_forever;
    }
    
    public function getImgId()
    {
        return $this->_img_id;
    }
}

$steamApi = new SteamApiConnector('AF4B3CC7FBF9CD34127CE10E6CCA9B62', '76561197989244442');
$ownedGames = new OwnedGamesDict($steamApi->getOwnedGames());

print $ownedGames;

?>

