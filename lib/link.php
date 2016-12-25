<?php
//==============================================================================
//
//  Class Link
//
//  (c) Olivier Korach 2016 - License MIT
//
//  Encapsulates a link
//
//==============================================================================

require_once 'db.php';

class Link {
   var $title;
   var $url;

   //------------------------------------------------------------------------------
   //  Constructors
   //------------------------------------------------------------------------------
   public function __construct($title, $url) {
      $this->title = $title;
      $this->url = $url;
   }

   //------------------------------------------------------------------------------
   //  Getters
   //------------------------------------------------------------------------------
   public function getTitle() { return $this->title; }

   public function getUrl() { return $this->url; }

   //------------------------------------------------------------------------------
   //  compare
   //------------------------------------------------------------------------------
   public function compare($otherLink) {
      return strcmp($this->title, $otherLink->getTitle());
   }

}

function ucompare($a, $b) {
   return $a->compare($b);
}

class LinkList
{
   var $links;
   function __construct($csvfile)
   {
      $fh = fopen($csvfile, "r");
      while (false !== ($line = fgets($fh))) {
         $data = preg_split('/\s*,\s*/', $line);
         $this->links[] = array($data[0], new Link($data[1], $data[2]));
      }
      fclose($fh);
   }
   /*
   function sort() {
      usort($this, 'Link::ucompare');
   }
   */
   
   public function getTypes()
   {
      foreach ($this->links as $link) {
         $types[$link[0]]++;
      }
      return $types;      
   }

   public function getLinksByType($type)
   {
      foreach ($this->links as $link) {
         if ($link[0] == $type) { $linksOfType[] = $link[1]; }
      }
      return $linksOfType;
   }

   public function count()
   {
      return count($links);
   }
}
?>
