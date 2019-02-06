<?php
class Response{
  private static $status_code = '200';
  private static $status_text = 'OK';
  private static $text = '';
  private static $headers = [];
  public function __construct(){

  }

  public function view($path){
    return file_get_contents('../Views/'.$path);
  }

  public static function setStatusCode($code, $text = 'OK'){
    static::$status_code = $code;
    static::$status_text = $text;
  }

  public static function write($text){
    static::$text .= $text;
  }

  public static function addHeader($header){
    static::$headers[] = $header;
  }

  public static function send(){
    header('HTTP/1.0 '.static::$status_code.' '.static::$status_text);
    foreach (static::$headers as $header)
      header($header);
    echo static::$text;
  }
}
?>
