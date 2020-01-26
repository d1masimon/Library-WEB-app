<?php
class PDODB extends eFrame\Helper {

    public $obj;
    private $table = '';

    public function init($server, $username, $password, $dbname) {
      $this->obj = new PDO('mysql:host='.$server.';dbname='.$dbname, $username, $password);
      $this->obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->obj->exec('SET NAMES utf8mb4');
    }

    public function setTable($table) {
      $this->table = $table;
    }

    public function selectAll($columns, $condition = '', array $params = []) {
      if ($condition == '') {
        $info = $this->obj->query('SELECT '.$columns.' FROM '.$this->table)->fetchAll(PDO::FETCH_ASSOC);
      }
      else {
        $reply = $this->obj->prepare('SELECT '.$columns.' FROM '.$this->table.' WHERE '.$condition);
        $reply->execute($params);
        $info = $reply->fetchAll(PDO::FETCH_ASSOC);
      }
      return $info;
    }

    public function selectRow($columns, $condition = '', array $params = []) {
      if ($condition == '') {
        $info = $this->obj->query('SELECT '.$columns.' FROM '.$this->table)->fetch(PDO::FETCH_ASSOC);
      }
      else {
        $reply = $this->obj->prepare('SELECT '.$columns.' FROM '.$this->table.' WHERE '.$condition);
        $reply->execute($params);
        $info = $reply->fetch(PDO::FETCH_ASSOC);
      }
      return $info;
    }

    public function selectColumn($columns, $condition = '', array $params = []) {
      if ($condition == '') {
        $info = $this->obj->query('SELECT '.$columns.' FROM '.$this->table)->fetchColumn();
      }
      else {
        $reply = $this->obj->prepare('SELECT '.$columns.' FROM '.$this->table.' WHERE '.$condition);
        $reply->execute($params);
        $info = $reply->fetchColumn();
      }
      return $info;
    }

    public function getResultsCount($columns, $condition = '', array $params = []) {
      if ($condition == '') {
        $info = $this->obj->query('SELECT '.$columns.' FROM '.$this->table)->rowCount();
      }
      else {
        $reply = $this->obj->prepare('SELECT '.$columns.' FROM '.$this->table.' WHERE '.$condition);
        $reply->execute($params);
        $info = $reply->rowCount();
      }
      return $info;
    }

    public function addRow($columns, array $params = []) {
      $prmscount = count(explode(",", $columns));
      $binded = str_repeat('?,', $prmscount - 1);
      $binded .= '?';
      $reply = $this->obj->prepare('INSERT INTO '.$this->table.' ('.$columns.') VALUES ('.$binded.')');
      $reply->execute($params);
    }

    public function updateRow($columns, $condition = '', array $params = []) {
      $binded = str_replace(",", "=?,", $columns);
      $binded .= '=?';
      if ($condition == '') {
        $reply = $this->obj->prepare('UPDATE '.$this->table.' SET '.$binded);
        $reply->execute($params);
      }
      else {
        $reply = $this->obj->prepare('UPDATE '.$this->table.' SET '.$binded.' WHERE '.$condition);
        $reply->execute($params);
      }
    }
}
?>
