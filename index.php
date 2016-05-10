<?php
session_start();
header('Content-type: text/html; charset=UTF-8');
$mysqli = new mysqli('localhost','root','','blog') or die('Cannot connect to database');
$mysqli->select_db('blog') or die('Cannot select database');
$mysqli->set_charset('utf8');
mb_internal_encoding('UTF-8');
$act=isset($_GET['act']) ? $_GET['act']: 'list';

define('IS_ADMIN',isset($_SESSION['IS_ADMIN']));

switch ($act){
    case 'list':
        $records=array();
        $sel=$mysqli->query('SELECT entry.*, COUNT (comment.id) AS comments
        FROM entry
        LEFT JOIN comment ON entry.id = comment.entry_id
        GROUP BY entry.id');
        while($row = $sel){
            $row['date'] = date('Y-m-d H:i:s', $row['date']);
            if (mb_strlen($row['content'])> 60){
                $row['content'] = mb_substr(strip_tags($row['content']), 0, 57) . '...';
            }
            $row['content'] = nl2br($row['content']);
            $row['header'] = htmlspecialchars($row['header']);
            $comments[] = $row;
        }
        require ('templates/list.php');
        break;
    case 'view-entry':
        if (!isset($_GET['id'])) die("Missing id parameter");
        $id = intval($_GET['id']);

        $ENTRY=$mysqli->query("SELECT * FROM entry WHERE id = $id")->fetch_assoc();
        if(!$ENTRY) die("No such entry");
        $ENTRY['date'] = date('Y-m-d H:i:s', $ENTRY['date']);
        $ENTRY['content'] = nl2br($ENTRY['content']);
        $ENTRY['header'] = htmlspecialchars($ENTRY['header']);

        $comments=array();
        $row=$mysqli->query("SELECT * FROM comment WHERE entry_id = $id");
        while($row = $sel->fetch_assoc()){
            $row['date'] =(new \DateTime());
            $row['content'] = nl2br(htmlspecialchars($row['content']));
            $row['header'] = htmlspecialchars($row['header']);
            $row['author'] = htmlspecialchars($row['author']);
            $records[] = $row;
        }

        require('templates/entry.php');
        break;
    case 'do-new-entry':
        $row=$mysqli->prepare("INSERT INTO  entry(author,date,header,content) VALUES (?,?,?,?,?)");
        $time=time();
        $sel->bind_param('siss',$_POST['author'], $time, $_POST['header'], $_POST['content']);
        if($sel->execute()){
            header('Location: .');
        }else{
            die("Cannot insert entry");
        }
        break;
    case 'login':
        require('templates/login.php');
        break;
    case 'logout':
        unset($_SESSION['IS_ADMIN']);
        header('Location: .');
        break;

    case 'do-login':
        if ($_POST['login']=='login' && $_POST['password'] == 'password'){
            $_SESSION['IS_ADMIN'] = true;
            header('Location: . ');
        }else{
            header('Location: ?act=login');
        }
        break;
    default:
        die("No such action");
}


