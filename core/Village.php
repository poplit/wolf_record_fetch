<?php

class Village
{
  private  $vno
          ,$name
          ,$date
          ,$nop
          ,$rglid
          ,$days
          ,$wtmid
          ,$rgl_detail
          ,$evil_rgl //裏切り陣営の有無
          ,$rp //言い換え
          ,$policy //勝敗あり村かどうか
          ,$add_winner //SOWでの追加勝利陣営の有無
          ,$is_card //更新がカード形式かどうか
          ;

  use Properties;

  function __construct($vno)
  {
    $this->vno = $vno;
  }
  function get_vars()
  {
    $list = get_object_vars($this);
    unset($list['evil_rgl'],$list['rp'],$list['policy'],$list['add_winner'],$list['is_card']);
    return $list;
  }

  function is_valid()
  {
    $list = $this->get_vars();
    foreach($list as $key=>$item)
    {
      switch($key)
      {
      case 'vno':
      case 'nop':
      case 'rglid':
      case 'days':
      case 'wtmid':
        if(empty($item) || !is_int($item))
        {
          $this->invalid_error($key,$item);
          return false;
        }
        break;
      case 'name':
      case 'rgl_detail':
        if(empty($item) || !is_string($item) || !mb_check_encoding($item))
        {
          $this->invalid_error($key,$item);
          return false;
        }
        break;
      case 'date':
        if(empty($item) || !preg_match('/\d{2}-\d{1,2}-\d{1,2}/',$item))
        {
          $this->invalid_error($key,$item);
          return false;
        }
        break;
      }
    }
    return true;
  }
  function invalid_error($key,$item)
  {
    echo '>'.$key.' is invalid.->'.$item.PHP_EOL;
  }
}
