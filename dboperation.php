?php
class dboperation
{
    public $con, $result;

    function __construct()
    {
        $this->con = mysqli_connect(
            "localhost",              // IMPORTANT (works only inside InfinityFree)
            "if0_41835845",           // your username
            "infinitycarhub",          // your DB password
            "if0_41835845_carhub"     // your DB name
        );

        if (!$this->con)
        {
            die("Connection failed:" . mysqli_connect_error());
        }
    }

    public function executequery($sqlquery)
    {
        $this->result = mysqli_query($this->con, $sqlquery);
        return $this->result;
    }
}
?>