
<?php
    session_start();
    if(isset($_SESSION['tendangnhap'])&&$_SESSION['tendangnhap'])
    {
        echo "<li><a href='dangxuat.php' class='d2'> Đăng xuất</a></li>";
        if(isset($_SESSION["loainguoidung"]) && $_SESSION["loainguoidung"]=='admin')
        {
            echo "<li><a class='d2'>Quản trị Website</a>
            <ul id='d3'>
                <li><a href='quanlinguoidung.php' class='d4'>Quản lý người dùng</a></li>
                <li><a class='d4'>Quản lý sách</a></li>
                <li><a class='d4'>Quản lý tác giả</a></li>
                <li><a class='d4'>Quản lý nhà xuất bản</a></li>
                <li><a class='d4'>Quản lý đơn hàng</a></li>
            </ul>
            </li>";
        }
        if(isset($_SESSION["loainguoidung"]) && $_SESSION["loainguoidung"]=='user'){
            $n=sizeof($_SESSION["DSMaMua"]);
            if($n==0)
                echo"<li><a href='giohang.php' class='d2'>Xem giỏi hàng</a></li>";
            else
                echo"<li><a href='giohang.php' class='d2'>Xem giỏi hàng (".$n.")</a></li>";
        }
        echo"<li><a class='d2'>Xin chào ".$_SESSION['tendangnhap']."</a></li>";
    }
    else{
        echo"<li><a target='_blank' class='d2' href='./dangnhap.php'>Đăng Nhập</a></li>
        <li><a target='_blank' class='d2' href='./dangki.php'>Đăng Ký</a></li>";
    }

?>