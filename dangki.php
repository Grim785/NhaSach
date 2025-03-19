<html>
<?php include 'dautrang.php'?>
<body>
    <?php
        $tendn="";
        $mk="";
        $ten="";
        $dc="";
        $sdt="";
        $ma="";
        $mkre="";
        include "ketnoi.php";
        $conn=MoKetNoi();
        if($conn->connect_error) 
        {
            echo"<p>Không kết nối được MySQL</p>";
        }
        mysqli_select_db($conn,"NhaSachBKC");
        if(isset($_POST["btnok"]))
        {
            $tendn=$_POST["txttdn"];
            $mk=$_POST["txtpass"];
            $ten=$_POST["txtten"];
            $dc=$_POST["txtdc"];
            $sdt=$_POST["txtsdt"];
            $ma=$_POST["txtemail"];
            $mkre=$_POST["txtpassre"];
            $kt=1;
            if($mk!=$mkre)
            {
                echo"<p>Bạn nhập lại mật khẩu chưa đúng</p>";
                $kt=0;
            }
            if(empty($tendn)||empty($mk)||empty($mkre)||empty($ten))
            {
                echo "<p>Bạn chưa nhập như thông tin bắt buộc (*) chưa đầy đủ</p>";
                $kt=0;
            }
            if(mysqli_num_rows(mysqli_query($conn,"SELECT TENDANGNHAP FROM NGUOIDUNG WHERE TENDANGNHAP ='$tendn'"))>0)
            {
                echo"<p> Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. </p>";
                $kt=0;
            }
            if(mysqli_num_rows(mysqli_query($conn,"SELECT SODT FROM NGUOIDUNG WHERE SODT ='$sdt'"))>0)
            {
                echo"<p>Số điện thoại này đã có người dùng. Vui lòng chọn số điện thoại khác.</p>";
                $kt=0;
            }
            if($kt==1)
            {
                $nguoidung="INSERT INTO NGUOIDUNG(TENDANGNHAP,MATKHAU,HOTEN,DIACHI,SODT,EMAIL)
                VALUES ('{$tendn}',{$mk},'{$ten}','{$dc}','{$sdt}','{$ma}')";
                $results= mysqli_query($conn,$nguoidung) or die(mysqli_error($conn));

                echo"<p> Bạn đã đăng kí thành công. Hãy đăng nhập trang web hoặc quay về trang chủ </p>";
            }
        }
    ?>
    <nav>
        <ul id="d1">
            <li><a class="d2" href="trangchu.php">Trang chủ</a></li>
            <li><a class="d2" href="">Giáo trình</a>
                <ul id="d3">
                    <li><a class="d4" href="">Giáo trình 1</a></li>
                    <li><a class="d4" href="">Giáo trình 2</a></li>
                    <li><a class="d4" href="">Giáo trình 3</a></li>
                </ul>
            </li>
            <li><a class="d2" href="">Sách chuyên ngành</a></li>
            <li><a class="d2" href="">Sách tham khảo</a></li>
            <li><a target="_blank" class="d2" href="./dangnhap.php">Đăng Nhập</a></li>
        </ul>
    </nav>
    <article id="article-signin">
        <form id="frm-signin" action="dangki.php" method="post">
                <table class="table-signin">
                    <tr>
                        <th class="th-signin" colspan="2">
                            Đăng ký
                        </th>
                    </tr>
                    <tr>
                        <td class="td-signin">
                            <fieldset>
                                <legend>Thông tin cá nhân</legend>
                                <table class="table-signin">
                                    <tr>
                                        <td class="td-signin left">Họ tên (*):</td>
                                        <td class="td-signin"><input require="true" value="<?php echo $ten ?>" type="text" name="txtten" placeholder="Nhập họ tên"></td>
                                    </tr>
                                    <tr>
                                        <td class="td-signin left">Số điện thoại (*):</td>
                                        <td class="td-signin"><input require="true" value="<?php echo $sdt?>" type="text" name="txtsdt" placeholder="Nhập số điện thoại"></td>
                                    </tr>
                                    <tr>
                                        <td class="td-signin left">Địa chỉ :</td>
                                        <td class="td-signin">
                                            <input require="true" placeholder="Nhập địa chỉ" value="<?php echo $dc?>" type="text" name="txtdc" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-signin left">Email :</td>
                                        <td class="td-signin">
                                            <input type="text" placeholder="Nhập Email" name="txtemail" value="<?php echo $ma ?>">
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-signin">
                            <fieldset>
                                <legend>Thông tin tài khoản</legend>
                                <table class="table-signin">
                                    <tr>
                                        <td class="td-signin left">Tên đăng nhập (*):</td>
                                        <td class="td-signin"><input require="true" value="<?php echo $tendn ?>" type="text" name="txttdn" placeholder="Nhập tên đăng nhập"></td>
                                    </tr>
                                    <tr>
                                        <td class="td-signin left">Password (*):</td>
                                        <td class="td-signin"><input require="true" value="<?php echo $mk ?>" type="password" name="txtpass" placeholder="Nhập mật khẩu"></td>
                                    </tr>
                                    <tr>
                                        <td class="td-signin left">Nhập lại<br>Mật khẩu (*):</td>
                                        <td class="td-signin"><input require="true" value="<?php echo $mkre ?>" type="password" name="txtpassre" placeholder="Nhập lại mật khẩu"></td></td>
                                    </tr>
                                    <tr>

                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-signin" colspan="2" align="center">
                            <a href=""><button class="button-signin" type="submit" name="btnok">Đồng ý</button></a>
                            <a href="trangchu.php"><button class="button-signin" type="button" name="btnexit">Thoát</button></a>
                            <button class="button-signin" type="reset" name="btnreset">Nhập lại</button>
                        </td>
                    </tr>
                </table>
        </form>
    </article>
    <?php include 'cuoitrang.php'?>
</body>
</html>