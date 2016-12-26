<?php
//==============================================================================
//
//  Class News
//
//  (c) Olivier Korach 2016 - License MIT
//
//  Encapsulates a web site news
//
//==============================================================================

require_once 'db.php';

class News
{
   private $newsdate;
   private $author;
   private $news_text;

   //------------------------------------------------------------------------------
   //  Constructors
   //------------------------------------------------------------------------------
   public function __construct($datestring, $author, $newstext)
   {
      # $this->newsdate = strtotime($datestring);
      $this->newsdate = $datestring;
      $this->author = $author;
      $this->news_text = $newstext;
   }

   //------------------------------------------------------------------------------
   //  Getters
   //------------------------------------------------------------------------------
   public function getAuthor()
   {
      return $this->author;
   }
   public function getDate($fmt)
   {
      return strftime($fmt, strtotime($this->newsdate));
   }
   public function getContents()
   {
      return $this->news_text;
   }
   //------------------------------------------------------------------------------
   //  Setters
   //------------------------------------------------------------------------------
   public function setAuthor($author)
   {
      $this->author = $author;
   }
   public function setDate($d)
   {
      $this->newsdate = $d;
   }
   public function setDateFromString($d)
   {
      $this->newsdate = strtotime($datestring);
   }
   public function setText($text)
   {
      $this->news_text = $text;
   }

   //------------------------------------------------------------------------------
   //  write()
   //------------------------------------------------------------------------------
   public function write()
   {
      $this->sanitize();
      opendb();
      $text = preg_replace("/'/", "''", $this->news_text);
      $q = sprintf("INSERT INTO news (date_news, author, contents) VALUES ('%s', '%s', '%s')", $this->newsdate, $this->author, $text);
      $result = mysql_query($q);
      closedb();
      if ($result == false)
      {
         throw new DbException('Unable to write to DB: '.mysql_error());
      }
      return $result;
   }

   //------------------------------------------------------------------------------
   //  sanitize()
   //------------------------------------------------------------------------------
   public function sanitize()
   {
      $this->news_text = htmlentities($this->news_text); #, ENT_COMPAT, 'UTF-8');
      $this->news_text = preg_replace("/<script\s*(.*)?>.*<\/script>/i", "", $this->news_text);
   }

   //------------------------------------------------------------------------------
   //------------------------------------------------------------------------------
   private static function runSelect($q)
   {
      opendb();
      $result = mysql_query('SELECT * FROM news '.$q);
      $n = mysql_numrows($result);
      for ($i = 0; $i < $n; $i++)
      {
         $list[] = new News(
            mysql_result($result,$i,'date_news'),
            mysql_result($result,$i,'author'),
            mysql_result($result,$i,'contents'));
      }
      closedb();
      return $list;
   }
   //------------------------------------------------------------------------------
   //
   //  static public functions
   //
   //------------------------------------------------------------------------------


   //------------------------------------------------------------------------------
   //  Search()
   //------------------------------------------------------------------------------
   public static function Search()
   {
   }

   //------------------------------------------------------------------------------
   //  ReadFromDB()
   //------------------------------------------------------------------------------
   public static function ReadFromDB()
   {
      return News::runSelect('');
   }
   //------------------------------------------------------------------------------
   //  GetLastNews()
   //------------------------------------------------------------------------------
   public static function GetLastNews($nbNews = 0)
   {
      $query = "ORDER BY date_news DESC";
      if ($nbNews > 0) { $query .= " LIMIT $nbNews"; }
      return News::runSelect($query);
   }
   //------------------------------------------------------------------------------
   //  GetYearNews()
   //------------------------------------------------------------------------------
   public static function GetYearNews($year = 0)
   {
      $query = '';
      if ($year > 0) { $query .= " WHERE date_news LIKE '".$year."%'"; }
      $query .= " ORDER BY date_news DESC";
      return News::runSelect($query);
   }
}

?>
