<?php
//==============================================================================
//
//  Volley La Bridoire Web Site
//
//  (c) Olivier Korach 2016-2017 - License MIT
//
//==============================================================================
//
//  db.php
//
//  Utilities to manage DB connection
//
//==============================================================================

//------------------------------------------------------------------------------
//
//  Constants
//
//------------------------------------------------------------------------------

# require_once('data.php');
const DB_SERVER = 'sql.free.fr';
const DB_NAME   = 'volley.bridoire';
const DB_PASSWD = 'lhassa73';

//==============================================================================
//
//  DbException Class
//
//==============================================================================
class DbException extends Exception
{
}

class DbManager
{
//------------------------------------------------------------------------------
//
//  opendb()
//
//  Throws DbException
//
//------------------------------------------------------------------------------
public static function opendb()
{

   if (! mysql_connect(DB_SERVER, DB_NAME, DB_PASSWD))
   {
      throw new DbException('Unable to connect to database: '.mysql_error());
   }

   if (!  mysql_select_db(DB_NAME))
   {
      throw new DbException('Unable to select database: '.mysql_error());
   }
}

//------------------------------------------------------------------------------
//
//  closedb()
//
//------------------------------------------------------------------------------
public static function closedb()
{
   mysql_close();
}

}