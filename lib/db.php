<?php

class DbException extends Exception
{
}

function opendb()
{
   if (! ($link = @mysql_connect('sql.free.fr', 'volley.bridoire', 'lhassa73')) ) {
	   throw new DbException('Unable to connect to database: '.mysql_error());
   }

   if ( !  mysql_select_db('volley.bridoire') ) {
	   throw new DbException('Unable to select database: '.mysql_error());
   }
}

function closedb()
{
   mysql_close();
}

?>
