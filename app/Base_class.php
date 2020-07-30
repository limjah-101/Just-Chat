<?php

class Base_class extends Db{

    private $query;

    /**
     * @Queries handler
     * @param Str $query
     * @param Void $param
     */
    public function normal_query( $query, $param = NULL ){

        if (is_null( $param )){

            $this->query = $this->connection->prepare($query);
            return $this->query->execute();

        } else {

            $this->query = $this->connection->prepare($query);
            return $this->query->execute($param);
        }
    }

    /**
     *@Count DB rows  
     */
    public function count_rows(){
        return $this->query->rowCount();
    }

    /**
     * @Fetch all DB rows
     */
    public function get_all(){
        return $this->query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @Sanitize Input
     */
    public function sanitize_input($input_value){
        return trim(strip_tags(htmlspecialchars($input_value)));
    }

    /**
     * @Handle Session
     */
    public function set_session($session_name, $session_value){
        $_SESSION[$session_name] = $session_value; 
    }

    /**
     * @Fetch Db single row
     */
    public function get_user_email(){
        return $this->query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Timestamp converter => Php Manual
     */
    public function time_handler($timestamp){
        //convert timestamp to second
        $db_time = strtotime($timestamp);
        date_default_timezone_set("Europe/Paris");
        //Get the current time
        $current_time = time();
        //Get the difference in seconds
        $time_diff = $current_time - $db_time;
        // echo "DIFF ".$time_diff . "<br>";
        $time_diff_min = floor($time_diff / 60);
        
        $time_diff_hour = floor($time_diff / 3600); //floor($time_diff / 60 * 60)
        $time_diff_day = floor($time_diff / 86400 ); //floor($time_diff / 24 * 60 * 60)
        $time_diff_week = floor($time_diff / 604800 ); //floor($time_diff / 7 * 24 * 60 * 60)
        $time_diff_month = floor($time_diff / 2592000 ); //floor($time_diff / 30 * 24 * 60 * 60)
        $time_diff_year = floor($time_diff /  31536000); //floor($time_diff / 365 *24 * 60 * 60);

        if ($time_diff <= 60){
            return "Just now";

        }else if ($time_diff_min <= 60){
            if ($time_diff_min == 1){
                return "1 minute ago";
            }else{
                return $time_diff_min . " minutes ago";
            }

        }else if ($time_diff_hour <= 24){
            if ($time_diff_hour == 1){
                return "1 hour ago";
            }else {
                return $time_diff_hour . " hours ago";
            }
        }else if ($time_diff_day <= 7){
            if ($time_diff_day == 1){
                return "1 day ago";
            }else {
                return $time_diff_day . " days ago";
            }
        }else if ($time_diff_week <= 4.3){
            if ($time_diff_week == 1){
                return "1 week ago";
            }else {
                return $time_diff_week . " weeks ago";
            }
        }else if ($time_diff_month <= 1){
            if ($time_diff_month == 1){
                return "1 month ago";
            }else {
                return $time_diff_month . " months ago";
            }
        }else if ($time_diff_year <= 1){
            if ($time_diff_year == 1){
                return "1 year ago";
            }else {
                return $time_diff_year . " years ago";
            }
        }
    }
}