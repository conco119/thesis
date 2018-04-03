<?php
# -------------------------------- #
# Library about database
# Connect to database
# Get result from database
# -------------------------------- #

class Dbo {

var $conn   = "";
var $server   = ""; //database server
var $user     = ""; //database login name
var $pass     = ""; //database login password
var $database = ""; //database name
var $pre      = ""; //table prefix


# -------------------------------- #
#internal info
var $error = "";
var $errno = 0;

#number of rows affected by SQL query
var $affected_rows = 0;

var $link_id = 0;
var $query_id = 0;


# -------------------------------- #
#desc: constructor
function __construct($conn = DB_MAIN , $pre=""){
  $conn = explode(",", $conn);
  $this->server=$conn[0];
  $this->user=$conn[1];
  $this->pass=$conn[2];
  $this->database=$conn[3];
  $this->pre=$pre;
}#-#constructor()


# -------------------------------- #
# desc: connect and select database using vars above
# Param: $new_link can force connect() to open a new link, even if mysql_connect() was called before with the same parameters
function connect($new_link=false) {
  $this->link_id=@mysql_connect($this->server,$this->user,$this->pass,$new_link);
  @mysql_query("SET NAMES 'utf8'");

  if (!$this->link_id) {//open failed
    $this->oops("Could not connect to server: <b>$this->server</b>.");
  }

  if(!@mysql_select_db($this->database, $this->link_id)) {//no database
    $this->oops("Could not open database: <b>$this->database</b>.");
  }

  // unset the data so it can't be dumped
  $this->server='';
  $this->user='';
  $this->pass='';
  $this->database='';
}#-#connect()


# -------------------------------- #
# desc: close the connection
function close() {
  if(!@mysql_close($this->link_id)){
    $this->oops("Connection close failed.");
  }
}#-#close()


# -------------------------------- #
# Desc: escapes characters to be mysql ready
# Param: string
# returns: string
function escape($string) {
  if(get_magic_quotes_runtime()) $string = stripslashes($string);
  return @mysql_real_escape_string($string,$this->link_id);
}#-#escape()


# -------------------------------- #
# Desc: executes SQL query to an open connection
# Param: (MySQL query) to execute
# returns: (query_id) for fetching results etc
function query($sql) {
  // do query
  $this->query_id = @mysql_query($sql, $this->link_id);

  if (!$this->query_id) {
    $this->oops("<b>MySQL Query fail:</b> $sql");
    return 0;
  }

  $this->affected_rows = @mysql_affected_rows($this->link_id);

  return $this->query_id;
}#-#query()


# -------------------------------- #
# desc: fetches and returns results one line at a time
# param: query_id for mysql run. if none specified, last used
# return: (array) fetched record(s)
function fetch_array($query_id=-1) {
  // retrieve row
  if ($query_id!=-1) {
    $this->query_id=$query_id;
  }

  if (isset($this->query_id)) {
    $record = @mysql_fetch_assoc($this->query_id);
  }else{
    $this->oops("Invalid query_id: <b>$this->query_id</b>. Records could not be fetched.");
  }

  return $record;
}#-#fetch_array()


# -------------------------------- #
# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
function fetch_all_array($sql) {
  $query_id = $this->query($sql);
  $out = array();

  while ($row = $this->fetch_array($query_id, $sql)){
    $out[] = $row;
  }

  $this->free_result($query_id);
  return $out;
}#-#fetch_all_array()


function fetch_one_array($sql){
  $query = $this->query($sql);
  if($this->num_rows($query) > 0){
    return $this->fetch_array($query);
  }
  return false;
}

# -------------------------------- #
# desc: frees the resultset
# param: query_id for mysql run. if none specified, last used
function free_result($query_id=-1) {
  if ($query_id!=-1) {
    $this->query_id=$query_id;
  }
  if($this->query_id!=0 && !@mysql_free_result($this->query_id)) {
    $this->oops("Result ID: <b>$this->query_id</b> could not be freed.");
  }
}#-#free_result()


# -------------------------------- #
# desc: does a query, fetches the first row only, frees resultset
# param: (MySQL query) the query to run on server
# returns: array of fetched results
function query_first($query_string) {
  $query_id = $this->query($query_string);
  $out = $this->fetch_array($query_id);
  $this->free_result($query_id);
  return $out;
}#-#query_first()


# -------------------------------- #
# desc: does an update query with an array
# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
# returns: (query_id) for fetching results etc
function query_update($table, $data, $where='1') {
  $q="UPDATE `".$this->pre.$table."` SET ";
  foreach($data as $key=>$val) {
    if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
    elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
    else $q.= "`$key`='".$this->escape($val)."', ";
  }
  $q = rtrim($q, ', ') . ' WHERE '.$where.';';
  return $this->query($q);
}#-#query_update()

# -------------------------------- #
# desc: does an insert query with an array
# param: table (no prefix), assoc array with data
# returns: id of inserted record, false if error
function query_insert($table, $data) {
  $q="INSERT INTO `".$this->pre.$table."` ";
  $v=''; $n='';

  foreach($data as $key=>$val) {
    $n.="`$key`, ";
    if(strtolower($val)=='null') $v.="NULL, ";
    elseif(strtolower($val)=='now()') $v.="NOW(), ";
    else $v.= "'".$this->escape($val)."', ";
  }

  $q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";

  if($this->query($q)){
    return mysql_insert_id($this->link_id);
  }
  else return false;

}#-#query_insert()

function num_rows($query) {
  $nr = @mysql_num_rows($query);
  return $nr;
}

function number_result_from_table($table, $where=NULL){
  $sql = "SELECT COUNT(id) number FROM $table";
  if($where)
    $sql .= " WHERE $where";
  $result = $this->fetch_one_array($sql);
  return $result['number'];
}

function number_result_from_sql($sql){
  $query = $this->query($sql);
  return $this->num_rows($query);
}

function mysql_insert_id(){
  return @mysql_insert_id();
}

function result($query, $row=0, $field) {
  $r = @mysql_result($query, $row, $field);
  return $r;
}

function check_exist_fields($sql){
  $query = $this->query($sql);
  $count = $this->num_rows($query);
  if($count <= 0)
    return false;
  else
    return true;
}

function dbo_get_options($table, $active=0, $limit=NULL){
  $result = NULL;
  $sql = "SELECT id,name FROM $table WHERE status=1 ORDER BY name ASC";
  if($limit != NULL)
    $sql .= " LIMIT $limit";
  $query = $this->query($sql);
  while ($item = $this->fetch_array($query)){
    if($item['id'] == $active){
      $result .= "<option value='".$item['id']."' selected>";
    }
    else{
      $result .= "<option value='".$item['id']."'>";
    }
    $result .= $item['name'];
    $result .= "</option>";
  }
  return $result;

}

function dbo_get_options_by_sql($sql, $active=0, $prefix=NULL){
  $result = NULL;
  if($prefix != NULL){
    $result = "<option value=''>" . $prefix . "</option>";
  }
  $query = $this->query($sql);
  while ($item = $this->fetch_array($query)){
    if($item['id'] == $active){
      $result .= "<option value='".$item['id']."' selected>";
    }
    else{
      $result .= "<option value='".$item['id']."'>";
    }
    $result .= $item['name'];
    $result .= "</option>";
  }
  return $result;

}

function query_get_id($sql) {
  if($this->query($sql)){
    return mysql_insert_id($this->link_id);
  }
  else return false;

}#-#query_get_id()


# -------------------------------- #
# desc: throw an error message
# param: [optional] any custom error to display
function oops($msg='') {
  global $link_id;
  if($link_id>0){
    $this->error=mysql_error($link_id);
    $this->errno=mysql_errno($link_id);
  }
  else{
    $this->error=mysql_error();
    $this->errno=mysql_errno();
  }
  if (preg_match('/renew\./i', $_SERVER['SERVER_NAME'])){
  ?>
    <table border="1" style="background:white;color:black;width:80%;">
    <tr><th colspan=2>Database Error</th></tr>
    <tr><td align="right" valign="top">Message:</td><td><?php echo $msg; ?></td></tr>
    <?php if(strlen($this->error)>0) echo '<tr><td align="right" valign="top" nowrap>MySQL Error:</td><td>'.$this->error.'</td></tr>'; ?>
    <tr><td align="right">Date:</td><td><?php echo date("l, F j, Y \a\\t g:i:s A"); ?></td></tr>
    <tr><td align="right">Script:</td><td><a href="<?php echo @$_SERVER['REQUEST_URI']; ?>"><?php echo @$_SERVER['REQUEST_URI']; ?></a></td></tr>
    <?php if(strlen(@$_SERVER['HTTP_REFERER'])>0) echo '<tr><td align="right">Referer:</td><td><a href="'.@$_SERVER['HTTP_REFERER'].'">'.@$_SERVER['HTTP_REFERER'].'</a></td></tr>'; ?>
    </table>
  <?php
  }
}#-#oops()


}//CLASS Database
# -------------------------------- #

?>