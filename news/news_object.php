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
   public function setDateFromString($datestring)
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
      DbManager::opendb();
      $text = preg_replace("/'/", "''", $this->news_text);
      $q = sprintf("INSERT INTO news (date_news, author, contents) VALUES ('%s', '%s', '%s')", $this->newsdate, $this->author, $text);
      $result = mysql_query($q);
      DbManager::closedb();
      if (! $result)
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
   private static function runSelect($where_clause)
   {
      DbManager::opendb();
      $result = mysql_query('SELECT * FROM news '.$where_clause);
      $n = mysql_numrows($result);
      for ($i = 0; $i < $n; $i++)
      {
         $list[] = new News(
            mysql_result($result,$i,'date_news'),
            mysql_result($result,$i,'author'),
            mysql_result($result,$i,'contents'));
      }
      DbManager::closedb();
      return $list;
   }

      private static function search($startdate = "", $enddate = "", $orderby = "DESC", $author = "", $limit = -1)
      {
         DbManager::opendb();

         $query = 'SELECT * FROM news ';
         $cond = false;
          if ($startdate != "") {
             $query .= " WHERE date_news >= '".$startdate."'";
             $cond = true;
          }
          if ($enddate != "") {
             $query .= ($cond ? " AND" : " WHERE")
             $query .= " date_news <= '".$enddate."'";
          }
          if ($author != "") {
             $query .= ($cond ? " AND" : " WHERE")
             $query .= " author == '".$author."'";
          }
          $order = toupper($order);
          if ($order == "DESC" || $order == "ASC") {
             $query .= " ORDER BY date_news $order";
          }
          if ($limit > 0) {
             $query .= " LIMIT $limit";
          }
         $result = mysql_query($query);
         $n = mysql_numrows($result);
         for ($i = 0; $i < $n; $i++)
         {
            $list[] = new News(
               mysql_result($result,$i,'date_news'),
               mysql_result($result,$i,'author'),
               mysql_result($result,$i,'contents'));
         }
         DbManager::closedb();
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
      return News::search();
   }
   //------------------------------------------------------------------------------
   //  GetLastNews()
   //------------------------------------------------------------------------------
   public static function GetLastNews($nbNews = 0)
   {
      return News::search("", "", "", "", $nbNews);
   }
   //------------------------------------------------------------------------------
   //  GetYearNews()
   //------------------------------------------------------------------------------
   public static function GetYearNews($year = 2017)
   {
      return News::search("$year-01-01", "$year-12-31");
   }

   //------------------------------------------------------------------------------
   //  GetRangeNews()
   //------------------------------------------------------------------------------
   public static function GetRangeNews($startdate = "", $enddate = "", $max = -1, $order = "DESC", $author = "")
   {
      return News::search($startdate, $enddate, $order, $author, $max);
   }

   //------------------------------------------------------------------------------
   public static function GetAuthorNews($author, $order = "DESC", $startdate = "", $enddate = "", $max = -1)
   {
      return News::search($startdate, $enddate, $order, $author, $max);
   }

   //------------------------------------------------------------------------------
   public static function GetSeasonNews($season = "2017/2018")
   {
      $years = preg_split('/\s*[- \/]\s*/', "$season", 2);
      $y1 = $years[0];
      if (preg_match('/^\d\d\d\d$/', "$y1")
      {
         $y2 = $y1 + 1;
         return News::search("$y1-08-16", "$y2-08-15");
      }
      else
      {
         return [];
      }
   }
?>
