<?php

/*
function iso($date)
{
   return format('Y-m-d', $date);
}

function french($date)
{
   return date('d/m/Y', $date);
}

function french_short($date)
{
   return date('d/m/y', $date);
}

include('DateTime.php');
*/

class Game
{

   private $gamedate;
   private $homeTeam;
   private $awayTeam;
   private $score;
   private $sets;
   
   function __construct($datestring, $eq1, $eq2, $score, $sets)
   {
      $this->gamedate = strtotime($datestring);
      $this->homeTeam = $eq1;
      $this->awayTeam = $eq2;
      $this->score = $score;
      $this->sets = preg_split('/\s+/', $sets);
   }

   function winner()
   {
      if (preg_match('/^\s*$/', $this->score)) {
         return '';
      } else {
         list ($home, $away) = preg_split('/\s*\/\s*/', $this->score);
         return ($home > $away ? $this->homeTeam : $this->awayTeam);
      }
   }
   function getHomeTeam() {
      return $this->homeTeam;
   }
   function getAwayTeam() {
      return $this->awayTeam;
   }
   function getDate($fmt) {
      return strftime($fmt, $this->gamedate);
   }
   function getScore() {
      return $this->score;
   }
   function getSets() {
      return implode(' ', $this->sets);
   }

   public static function ReadFromDB()
   {
      mysql_connect('sql.free.fr', 'volley.bridoire', 'lhassa73') or die('Unable to connect to database: '.mysql_error().'"'."\n");
      mysql_select_db('volley.bridoire') or  die( 'Unable to select database: "'.mysql_error().'"'."\n");
      $result = mysql_query('select * from matchs');
      $n = mysql_numrows($result);
      for ($i = 0; $i < $n; $i++)
      {
         $list[] = new Game(
            mysql_result($result,$i,'date_match'),
            mysql_result($result,$i,'equipe_domicile'),
            mysql_result($result,$i,'equipe_visiteur'),
            mysql_result($result,$i,'score1'),
            mysql_result($result,$i,'score2'));
      }
      mysql_close();
      return $list;
   }
	public static function GetUnplayedGames($nbGames = 0)
	{
      mysql_connect('sql.free.fr', 'volley.bridoire', 'lhassa73') or die('Unable to connect to database: '.mysql_error().'"'."\n");
      mysql_select_db('volley.bridoire') or  die( 'Unable to select database: "'.mysql_error().'"'."\n");
      $query = "select * from matchs where score1 = '' order by date_match";
		if ($nbGames > 0) {
			$query .= " limit $nbGames";
		}
      $result = mysql_query($query);
      $n = mysql_numrows($result);
      for ($i = 0; $i < $n; $i++)
      {
         $list[] = new Game(
            mysql_result($result,$i,'date_match'),
            mysql_result($result,$i,'equipe_domicile'),
            mysql_result($result,$i,'equipe_visiteur'),
            '', '');
      }
      mysql_close();
		return $list;
	}
	public static function GetLastPlayedGames($nbGames = 0)
	{
      mysql_connect('sql.free.fr', 'volley.bridoire', 'lhassa73') or die('Unable to connect to database: '.mysql_error().'"'."\n");
      mysql_select_db('volley.bridoire') or  die( 'Unable to select database: "'.mysql_error().'"'."\n");
      $query = "select * from matchs where score1 != '' order by date_match desc";
		if ($nbGames > 0) {
			$query .= " limit $nbGames";
		}
      $result = mysql_query($query);
      $n = mysql_numrows($result);
      for ($i = $n-1; $i >= 0; $i--)
      {
         $list[] = new Game(
            mysql_result($result,$i,'date_match'),
            mysql_result($result,$i,'equipe_domicile'),
            mysql_result($result,$i,'equipe_visiteur'),
            mysql_result($result,$i,'score1'),
            mysql_result($result,$i,'score2'));
      }
      mysql_close();
		return $list;
	}
}

?>
