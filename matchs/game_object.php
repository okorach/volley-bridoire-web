<?php
//==============================================================================
//
//  Class Game
//
//  (c) Olivier Korach 2016 - License MIT
//
//  Encapsulates a volleyball game
//
//==============================================================================

require_once 'db.php';

class Game {

   private $gamedate;
   private $homeTeam;
   private $awayTeam;
   private $score;
   private $sets;

   //------------------------------------------------------------------------------
   //  Constructors
   //------------------------------------------------------------------------------
   public function __construct($datestring, $eq1, $eq2, $score, $sets) {
      $this->gamedate = strtotime($datestring);
      $this->homeTeam = $eq1;
      $this->awayTeam = $eq2;
      $this->score = $score;
      $this->sets = preg_split('/\s+/', $sets);
   }

   //------------------------------------------------------------------------------
   //  Getters
   //------------------------------------------------------------------------------
   public function getHomeTeam() {
      return $this->homeTeam;
   }
   public function getAwayTeam() {
      return $this->awayTeam;
   }
   public function getDate($fmt) {
      return strftime($fmt, $this->gamedate);
   }
   public function getScore() {
      return $this->score;
   }
   public function getSets() {
      return implode(' ', $this->sets);
   }

   //------------------------------------------------------------------------------
   //  Setters
   //------------------------------------------------------------------------------
   public function setHomeTeam($team) {
      $this->homeTeam = $team;
   }
   public function setAwayTeam($team) {
      $this->awayTeam = $team;
   }
   public function setDate($d) {
      $this->gamedate = strtotime($d);
   }
   public function setScore($score) {
      $this->score = $score;
   }
   public function setSets($sets) {
      $this->sets = preg_split('/\s+/', $sets);
   }

   //------------------------------------------------------------------------------
   //  winner()
   //------------------------------------------------------------------------------
   public function winner() {
      if (preg_match('/^\s*$/', $this->score)) {
         return '';
      } else {
         list ($home, $away) = preg_split('/\s*\/\s*/', $this->score);
         return ($home > $away ? $this->homeTeam : $this->awayTeam);
      }
   }

   //------------------------------------------------------------------------------
   //  Static public functions
   //------------------------------------------------------------------------------
   private static function getGame($result, $i) {
      $dom = mysql_result($result,$i,'equipe_domicile');
      $vis = mysql_result($result,$i,'equipe_visiteur');
      if ($dom == "VCB") {
            $dom = "La Bridoire";
      }
      if ($vis == "VCB") {
            $vis = "La Bridoire";
      }
      return new Game(
            mysql_result($result,$i,'date_match'),
            $dom,
            $vis,
            mysql_result($result,$i,'score1'),
            mysql_result($result,$i,'score2'));
   }
   //------------------------------------------------------------------------------
   //  ReadFromDB()
   //------------------------------------------------------------------------------
   public static function ReadFromDB() {
      DbManager::opendb();
      $result = mysql_query('select * from matchs order by date_match');
      $n = mysql_numrows($result);
      for ($i = 0; $i < $n; $i++) {
         $list[] = getGame($result, $i);
      }
      DbManager::closedb();
      return $list;
   }
   //------------------------------------------------------------------------------
   //  GetUnplayedGames()
   //------------------------------------------------------------------------------
   public static function GetUnplayedGames($nbGames = 0) {
      DbManager::opendb();
      $query = "select * from matchs where score1 = '' order by date_match";
      if ($nbGames > 0) {
         $query .= " limit $nbGames";
      }
      $result = mysql_query($query);
      $n = mysql_numrows($result);
      for ($i = 0; $i < $n; $i++) {
         $list[] = getGame($result, $i);
      }
      DbManager::closedb();
      return $list;
   }
   //------------------------------------------------------------------------------
   //  GetLastPlayedGames()
   //------------------------------------------------------------------------------
   public static function GetLastPlayedGames($nbGames = 0)
   {
      DbManager::opendb();
      $query = "select * from matchs where score1 != '' order by date_match desc";
      if ($nbGames > 0) {
         $query .= " limit $nbGames";
      }
      $result = mysql_query($query);
      $n = mysql_numrows($result);
      for ($i = $n-1; $i >= 0; $i--) {
         $list[] = getGame($result, $i);
      }
      DbManager::closedb();
      return $list;
   }
   //------------------------------------------------------------------------------
   //  GetSeasonGames()
   //------------------------------------------------------------------------------
   public static function GetSeasonGames($season)
   {
      DbManager::opendb();
      $start = "$season-09-01";
      $season++;
      $end = "$season-07-01";
      $query = "select * from matchs where date_match >= '$start' and date_match < '$end' order by date_match desc";
      $result = mysql_query($query);
      $n = mysql_numrows($result);
      for ($i = $n-1; $i >= 0; $i--) {
         $list[] = getGame($result, $i);
      }
      DbManager::closedb();
      return $list;
   }
}

?>
