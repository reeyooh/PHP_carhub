<?php
class dboperation
{
    public $con, $result;

    function __construct()
    {
        $this->con = mysqli_connect(
            "localhost",              // IMPORTANT (InfinityFree uses localhost)
            "if0_41835845",           // your DB username
            "YOUR_PASSWORD",          // your DB password
            "if0_41835845_carhub"     // your DB name
        );

        if (!$this->con)
        {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function executequery($sqlquery)
    {
        return mysqli_query($this->con, $sqlquery);
    }
}
?>