<?php
namespace MyCMS;

  class CMS{

    private $template;
    private $length;
    private $variables;//取得した文字が入ってる（titleとか）
    private $data;
    private $password = 'kakiikada';
    private $storage = './store.json'; //外部ファイル。データの保存場所

    public function __construct($template,$length){
      $this->template = $template;
      $this->length   = $length;
      if(preg_match_all('/{{([^}]+)}}/',$this->template,$p)){  //文字書き換え（
        $this->variables = $p[1];
      }
      if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $this->saveData();
      }
      $this->loadData();
      if(isset($_GET['__edit']) && $_GET['__edit'] === $this->password){ //フォーム表示
        $this-> showForm();
      }

    }

    public function render(){ //表示させる用の関数
      $body = '';  //表示させたいもの（最初はカラ）
      for($i = 0; $i < $this->length; $i++){
        $row = $this->template;
        foreach($this->variables as $key){
          $row = str_replace('{{'. $key.'}}',$this->data[$key][$i],$row);
        }

        $body .= $row;
      }
      echo $body;
    }

    public function loadData(){
      if(file_exists($this->storage)){ //外部ファイルがあるか確認
        //外部ファイルがあれば読みだす
        $this->data = json_decode(file_get_contents($this->storage),true);
      }
    }

    public function saveData(){
      file_put_contents($this->storage,json_encode($_POST));
    }

    public function showForm(){
      echo '<form method = "post">';
      for($i = 0; $i < $this->length; $i++ ){
        $num = $i + 1;
        echo $num .'つ目の項目'.'　';
        foreach($this->variables as $key){
          echo $key;
          echo'<textarea class = "edit" name = "'.$key.'[]">'.$this->data[$key][$i].'</textarea>';
        }
        echo '<br/>';

      }
      echo'<input type = "submit" value = "保存する">';
      echo'</form>';
    }

  }





?>
