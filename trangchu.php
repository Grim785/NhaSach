<html>
<?php include 'dautrang.php'?>
<body>
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
            <?php include "menuchinh.php" ?>
        </ul>
        <section class="search"><input class="search-box" type="search" placeholder="Tên Sách"><button type='submit' name='btnSearch'><a href="timkiem.php"><i class="fa-solid fa-magnifying-glass search-icon"></a></i></button></section>
    </nav>
    <section class="content">
        <?php include 'menutrai.php' ?>
        <article id="article-home">
            <?php
                include 'ketnoi.php';
                $conn=MoKetNoi();
                mysqli_select_db($conn,'NhaSachBKC');
            ?>
            <form action="xemthemsach.php" method="post">
                <table id="table-home">
                    <?php
                        $truyvan1="SELECT * FROM LOAI ";
                        $ketqua1=mysqli_query($conn,$truyvan1) or die(mysqli_error($conn));
                        $tongdong1=mysqli_num_rows($ketqua1);
                        for($i=1;$i<=$tongdong1;$i++)
                        {
                            $dong1=mysqli_fetch_array($ketqua1);
                            echo"<tr class='tr-home'><td colspan='3' class='th-home' align='left'>".$dong1['TENTL']."</td></tr>";
                            $truyvan="SELECT * FROM SACH AS S,LOAI AS L WHERE S.MATL=L.MATL AND TENTL='".$dong1['TENTL']."'";
                            $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                            echo "<tr class='tr-home row'>";
                            for($j=1;$j<=3;$j++)
                            {
                                $dong=mysqli_fetch_array($ketqua);
                                echo"<td class='flex td-home'><img src='".$dong['HINH']."'> <br> <br>".$dong['TUASACH']."
                                    <br> Giá bán: ".number_format($dong['GIA'])." đồng <br>
                                    <br> <button class='detail' type='button' name='btnXem'><a href='xemnoidung.php?masach=".$dong['MASACH']."'>Xem nội dung</a></button></td>";
                            }
                            echo"</tr>";
                            echo"<tr><td colspan='3' class=''>Xem thêm sách <input type='submit' name='btnXemThem' value='".$dong['TENTL']."'></td></tr>";
                        }
                    ?>
                </table>
            </form>
        </article>
        <?php include 'menuphai.php'?>
    </section>
    <?php include 'cuoitrang.php'?>
</body>
</html>