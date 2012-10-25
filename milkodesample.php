<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
// +----------------------------------------------------------------+
// | PHP version 4                                                  |
// +----------------------------------------------------------------+
// +----------------------------------------------------------------+
// |                                                                |
// | All Rights Reserved.                                           |
// |                                                                |
// +----------------------------------------------------------------+
// +----------------------------------------------------------------+
//
// $Id: 


/**
 * 基本設定をrequire
 */
require_once "../api/conf/config.php";

/**
 * DBの拡張なので下記をrequire
 */
require_once LIBRARY_PATH . "DB.php";
/**
 * 集計情報取得クラス
 */
class Stat extends DB
  {

  function insert(&$result, $arInsert)
    {
    $st =& $this->db->autoPrepare('stat', array_keys($arInsert), DB_AUTOQUERY_INSERT);
    $result =& $this->db->execute($st, array_values($arInsert));
    if( DB::isError($result) )
      {
      return _DB_ERROR;
      }

    return _DB_OK;
    }



  function select(&$result, $start_date, $end_date)
    {
    $query = "SELECT\n".
             "  TO_CHAR(log_date, 'YYYY-MM-DD') AS log_date,\n".
             "  pv_web,\n".
             "  uq_web,\n".
             "  member_pv_web,\n".
             "  member_uq_web,\n".
             "  pv,\n".
             "  uq,\n".
             "  member_pv,\n".
             "  member_uq,\n".
             "  pv,\n".
             "  uq,\n".
             "  member_pv,\n".
             "  member_uq,\n".
             "FROM\n".
             "  stat\n".
             "WHERE\n".
             "  log_date BETWEEN CAST(? AS DATE) AND CAST(? AS DATE)\n";


    $this->db->prepare($query);
    $result = $this->db->getAll($query, array($start_date, $end_date), DB_FETCHMODE_ASSOC);
        
    if (DB::isError($result))
      {
      return _DB_ERROR;
      }
    elseif(count($result) == 0)
      {
      return _DB_EMPTY;
      }
    else
      {
      return _DB_OK;
      }

    }






  }
?>
