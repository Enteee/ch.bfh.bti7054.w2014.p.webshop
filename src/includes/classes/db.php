<?php
/*  db.php
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   Database access over PDO
*   Require:
*       - PDO enabled in your php.ini
*
*
*   Licence:
*   You're allowed to edit and publish my source in all of your free and open-source projects.
*   Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*   Leave this Header untouched!
*
*   Warranty:
*       Warranty void if signet is broken
*   ================== / /===================
*   [   Waranty       / /   Signet          ]
*   =================/ /=====================   
*   !!Wo0t!!
*/

class DB extends PDO{
    const DRIVER_MYSQL = 0;
    const DRIVER_SQLite = 1;
    const DRIVER_MSSQL = 2;
    const DRIVER_FIREBIRD = 3;
    const DRIVER_IBM = 4;
    const DRIVER_ORACLE = 5;
    const DRIVER_ODBC = 6;
    const DRIVER_POSTGRESQL = 7;

    private $driver;
    private $num_queries = 0;
    private $num_queries_success = 0;
    private $last_query;
    private $last_query_success;
    private $last_query_error;

    function __construct($driver,$host = 'localhost',$user,$password,$dbname){
        $this->driver = $driver; // set the driver for this PDO
    
        /*setup all the data for the PDO especially the Data source name*/
        switch($this->driver){
            case self::DRIVER_MYSQL:
                $dsn = 'mysql:host='.$host.';dbname='.$dbname;
            break;
            default:
                //not implemented yet!
            break;
        }

        parent::__construct($dsn,$user,$password); // connect
    }

    /*Getters / Setters*/
    //

    function get_num_queries(){
        return $this->num_queries;
    }

    function get_num_queries_success(){
        return $this->num_queries_success;
    }

    // Depose a query once
    function query($statement){
        //echo $statement."<br />";
        //release last query
        if($this->num_queries != 0 && $this->was_success())
            $this->last_query->closeCursor();

        $this->last_query = parent::query($statement);  // Depose the new query
        $was_sucess = $this->was_success();

        if($was_sucess){
            $this->num_queries_success++;
        }
        $this->num_queries++;

        return $was_sucess;
    }

    /*ERROR*/
    //

    function was_success(){
        $this->last_query_error = parent::errorInfo();
        if($this->last_query_error[0] == '00000'){ // success?
            return TRUE;
        }
        return FALSE;
    }

    /* Query handling */
    //
 
    function num_cols(){
        return $this->last_query->columnCount();
    }

    function num_rows(){
        return $this->last_query->rowCount();
    }

    function fetch(){
        return $this->last_query->fetch();
    }

    function fetch_all(){
        return $this->last_query->fetchAll();
    }

    /*Prepare variable for Sql-Query*/
    //

    function var_prepare($var){

        if(is_string($var)){
            $ret = addslashes(trim(strval($var)));
        }else{
            // not a string return empty
            $ret = '';
        }

        return $ret;
    }

    function var_prepare_arr($vars){ // prepare a whole array
        foreach($vars as $key => $var){
            $vars[$key] = self::var_prepare($var);
        }
        return $vars;
    }

    /* Get variable after Sql-Request*/
    //

    function var_get($var){
        // convert variable back..
        if(is_string($var)){
            return stripslashes($var);
        }else if(is_int($var)){
            return intval($var);
        }else{
            return $var;
        }
    }

    function var_get_arr($vars){ // get a whole array
        foreach($vars as $key => $var){
            $vars[$key] = self::var_get($var);
        }
        return $vars;
    }
}
?>
