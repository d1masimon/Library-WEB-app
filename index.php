<?php
require 'core/init.php';

$app = new eFrame\App();

$app["config.library"] = [
  'server' => '',
  'dbname' => '',
  'username' => '',
  'password' => ''
];

require 'core/controllers/pdo.class.php';

$app->helpers["db"] = 'PDODB';

$app->get("/", function() { 
  return $this->render('template/mainpage.php');
});

$app->get("/books/add/", function() { 
  return $this->render('template/addpage.php');
});

$app->get("/books/:id/edit/", function($params) {
  $this("db")->init($this["config.library/server"], $this["config.library/username"], $this["config.library/password"], $this["config.library/dbname"]);
  $this("db")->setTable('library');
  $book = $this("db")->selectRow('id, author, year, name', 'id = ?', [$params["id"]]);
  return $this->render('template/editpage.php', array('book' => $book));
});

$app->get("/api/books/list/", function() {
  $this("db")->init($this["config.library/server"], $this["config.library/username"], $this["config.library/password"], $this["config.library/dbname"]);
  $this("db")->setTable('library');
  $res = $this("db")->selectAll('*');
  return json_encode($res);
});

$app->post("/api/books/add/", function() {
  $author = $_POST['author'];
  $year = $_POST['year'];
  $name = $_POST['name'];
  $this("db")->init($this["config.library/server"], $this["config.library/username"], $this["config.library/password"], $this["config.library/dbname"]);
  $this("db")->setTable('library');
  $this("db")->addRow('author, year, name', [$author, $year, $name]);
  $this->reroute("/");
});

$app->post("/api/books/:id/edit/", function($params) {
  $author = $_POST['author'];
  $year = $_POST['year'];
  $name = $_POST['name'];
  $this("db")->init($this["config.library/server"], $this["config.library/username"], $this["config.library/password"], $this["config.library/dbname"]);
  $this("db")->setTable('library');
  $this("db")->updateRow('author, year, name', 'id = ?', [$author, $year, $name, $params["id"]]);
  $this->reroute("/");
});

$app->run();
?>
