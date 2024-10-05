<?php
include("db.php");

class data extends db {
    private $bookpic;
    private $bookname;
    private $bookdetail;
    private $bookauthor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $type;

    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;

    function __construct() {
        // echo " constructor ";
        echo "</br></br>";
    }

    function addnewuser($name, $pass, $email, $type) {
        $this->$name = $name;
        $this->$pass = $pass;
        $this->$email = $email;
        $this->type = $type;

        $q = "INSERT INTO userdata (id, name, email, pass, type) VALUES ('', '$name', '$email', '$pass', '$type')";

        if ($this->connection->exec($q)) {
            header("Location: admin_service_dashboard.php?msg=New Add done");
        } else {
            header("Location: admin_service_dashboard.php?msg=Register Fail");
        }
    }

    function userLogin($t1, $t2) {
        $q = "SELECT * FROM userdata WHERE email='$t1' AND pass='$t2'";
        $recordSet = $this->connection->query($q);
        $result = $recordSet->rowCount();

        if ($result > 0) {
            foreach ($recordSet->fetchAll() as $row) {
                $logid = $row['id'];
                header("location: otheruser_dashboard.php?userlogid=$logid");
            }
        } else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }

    function adminLogin($t1, $t2) {
        $q = "SELECT * FROM admin WHERE email='$t1' AND pass='$t2'";
        $recordSet = $this->connection->query($q);
        $result = $recordSet->rowCount();

        if ($result > 0) {
            foreach ($recordSet->fetchAll() as $row) {
                $logid = $row['id'];
                header("location: admin_service_dashboard.php?logid=$logid");
            }
        } else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }

    function addbook($bookpic, $bookname, $bookdetail, $bookauthor, $bookpub, $branch, $bookprice, $bookquantity) {
        $this->bookpic = $bookpic;
        $this->bookname = $bookname;
        $this->bookdetail = $bookdetail;
        $this->bookauthor = $bookauthor;
        $this->bookpub = $bookpub;
        $this->branch = $branch;
        $this->bookprice = $bookprice;
        $this->bookquantity = $bookquantity;

        $q = "INSERT INTO book (id, bookpic, bookname, bookdetail, bookauthor, bookpub, branch, bookprice, bookquantity, bookava, bookrent) VALUES ('', '$bookpic', '$bookname', '$bookdetail', '$bookauthor', '$bookpub', '$branch', '$bookprice', '$bookquantity', '$bookquantity', 0)";

        if ($this->connection->exec($q)) {
            header("Location: admin_service_dashboard.php?msg=done");
        } else {
            header("Location: admin_service_dashboard.php?msg=Failed");
        }
    }

    function rent($book, $userselect, $days) {
        $this->book = $book;
        $this->userselect = $userselect;
        $this->days = $days;
        $this->getdate = date("Y-m-d");
        $this->returnDate = date('Y-m-d', strtotime($this->getdate . ' + ' . $days . ' days'));

        $q = "UPDATE book SET bookava = bookava - 1, bookrent = bookrent + 1 WHERE id='$book'";
        $this->connection->exec($q);

        $q = "INSERT INTO issuebook (id, bookid, userid, getdate, returndate) VALUES ('', '$book', '$userselect', '$this->getdate', '$this->returnDate')";

        if ($this->connection->exec($q)) {
            header("Location: admin_service_dashboard.php?msg=Rent Done");
        } else {
            header("Location: admin_service_dashboard.php?msg=Rent Failed");
        }
    }
}

$data = new data();
?>
