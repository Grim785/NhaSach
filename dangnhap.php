<html>
<?php include 'dautrang.php'?>
<body>
<?php
        $tendn="";
        $mk="";
        include "ketnoi.php";
        $conn=MoKetNoi();
        if($conn->connect_error) 
        {
            echo"<p>Không kết nối được MySQL</p>";
            $kt=0;
        }
        // else{
        //     echo"<p>kết nối</p>";
        // }
        mysqli_select_db($conn,"NhaSachBKC");
        if(isset($_POST["btnlogin"]))
        {
            session_start();
            $tendn=$_POST["txttdn"];
            $mk=$_POST["txtpass"];
            $kt=1;
            if(empty($tendn)||empty($mk))
            {
                echo "<p>Bạn chưa nhập như thông tin đăng nhập";
                $kt=0;
            }
            if(mysqli_num_rows(mysqli_query($conn,"SELECT TENDANGNHAP FROM NGUOIDUNG WHERE TENDANGNHAP ='$tendn'"))==0)
            {
                echo"<p>Sai tên đăng nhâp hoặc bạn chưa có tài khoản !!!</p>";
                $kt=0;
            }
            if(mysqli_num_rows(mysqli_query($conn,"SELECT MATKHAU FROM NGUOIDUNG WHERE TENDANGNHAP ='$tendn' and MATKHAU='$mk'"))==0)
            {
                echo"<p>Sai mật khẩu !!!</p>";
                $kt=0;
            }
            if($kt==1)
            {
                $query = mysqli_query($conn, "SELECT HOTEN,PHANLOAI FROM NGUOIDUNG WHERE TENDANGNHAP = '$tendn'");
                $row = mysqli_fetch_array($query);
                $_SESSION["tendangnhap"]=$row["HOTEN"];
                $_SESSION["loainguoidung"]=$row["PHANLOAI"];
                $_SESSION['DSMaMua']=array();
                $_SESSION['DSSL']=array();
                header("location: trangchu.php");
                
            }
        }
    ?>
    <nav>
        <ul id="d1">
            <li><a class="d2" href="./trangchu.php">Trang chủ</a></li>
            <li><a class="d2" href="">Giáo trình</a>
                <ul id="d3">
                    <li><a class="d4" href="">Giáo trình 1</a></li>
                    <li><a class="d4" href="">Giáo trình 2</a></li>
                    <li><a class="d4" href="">Giáo trình 3</a></li>
                </ul>
            </li>
            <li><a class="d2" href="">Sách chuyên ngành</a></li>
            <li><a class="d2" href="">Sách tham khảo</a></li>
            <li><a target="_blank" class="d2" href="./dangki.php">Đăng Ký</a></li>
        </ul>
    </nav>
    
    <article id="article-login">
        <form id="frm-login" action="dangnhap.php" method="post">
                <table id="table-login">
                    <tr class="tr-login">
                        <th class="th-login" align="center" colspan="2">Đăng Nhập</th>
                    </tr>
                    <tr class="tr-login">
                        <td class="td-login">
                            <i class=" i-login fa-solid fa-user"></i>
                        </td>
                        <td class="td-login">
                            <input class="input-login" type="text" name="txttdn" value="<?php echo $tendn ?>" placeholder="Username">
                        </td>
                    </tr>
                    <tr class="tr-login">
                        <td class="td-login">
                            <i class=" i-login fa-solid fa-lock"></i>
                        </td>
                        <td class="td-login">
                            <input class="input-login" type="password" name="txtpass" value="<?php echo $mk ?>" placeholder="Password">
                        </td>
                    </tr>
                    <tr class="tr-login" rowspan="2">

                    </tr>
                    <tr class="tr-login">
                        <td class="td-login" colspan="2">
                            <a href=""><button class="button-login" type="submit" name="btnlogin">Đăng nhập</button></a>
                        </td>
                        <td class="td-login">
                            <a href="./dangki.php"><button class="button-login" type="button" name="btnsignup">Đăng kí</button></a>
                        </td>
                    </tr>
                </table>
        </form>
    </article>
    <?php include 'cuoitrang.php'?>
</body>
</html>