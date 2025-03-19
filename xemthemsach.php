<html>
<?php include "dautrang.php"?>
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
    </nav>
    <section class="content">
        <?php include 'menutrai.php' ?>
        <article id="article-home">
            <?php
                include 'ketnoi.php';
                $conn=MoKetNoi();
                mysqli_select_db($conn,'NhaSachBKC');
            ?>
            <form action="xemthemsach.php" method="post" class="more-book">
                <table id="table-home">
                    <?php
                        function HienThiSach($ketqua)
                        {
                            for($i=1;$i<=3;$i++)
                            {
                                echo"<tr class='tr-home row'>";
                                for($j=1;$j<=3;$j++)
                                {
                                    $noidung=mysqli_fetch_array($ketqua);
                                    if(isset($noidung))
                                    {
                                        echo"<td class='flex td-home'><img src='".$noidung['HINH']."'> <br><br>".$noidung['TUASACH']."
                                        <br> Giá Bán:".number_format($noidung['GIA'])."đồng <br>
                                        <br> <button class='detail' type='button' name='btnXem'><a href='xemnoidung.php?masach=".$noidung['MASACH']."'>Xem nội dung</a></button></td>";
                                    }
                                }
                            echo "</tr>";
                            }
                        }
                        if(isset($_POST['btnXemThem']))
                        {
                            $_SESSION['theloai']=$_POST["btnXemThem"];
                        }
                        echo "<caption>Sách ".$_SESSION['theloai']."</caption>"; 

                        $truyvan="SELECT * FROM SACH AS S,LOAI AS L where L.MATL=S.MATL AND TENTL='".$_SESSION['theloai']."'";
                        $ketqua =mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                        $sl=mysqli_num_rows($ketqua);
                        $sodong=$sl/3;
                        if($sodong<=3)
                        {
                            HienThiSach($ketqua);
                        }
                        else
                        {
                            $tongdong=mysqli_num_rows($ketqua);
                            $tranghientai= isset($_GET['trang']) ? $_GET['trang']:1;
                            $soluong=9;
                            $tongsotrang = ceil($tongdong/$soluong);
                            if($tranghientai>$tongsotrang)
                            {
                                $tranghientai=$tongsotrang;
                            }
                            else if($tranghientai<1)
                            {
                                $current_page=1;
                            }
                            $batdau=($tranghientai-1)*$soluong;
                            $truyvan="SELECT * FROM SACH AS S, LOAI AS L WHERE S.MATL=L.MATL AND TENTL='".$_SESSION['theloai']."'"." LIMIT $batdau,$soluong";
                            $ketqua=mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                            HienThiSach($ketqua);
                        }
                    ?>
                </table>
                <?php
                    error_reporting(0);
                    echo"<section class='phan_trang'>";
                    if($tranghientai > 1 &&  $tongsotrang>1)
                    {
                        echo'<a href="xemthemsach.php?trang='.($tranghientai-1).'">Qua trang trước</a> | ';
                    }
                    for($i=1; $i<=$tongsotrang;$i++)
                    {
                        if($i==$tranghientai)
                        {
                            echo '<span>'.$i.'</span> | ';
                        }
                        else
                        {
                            echo '<a href="xemthemsach.php?trang='.$i.'">'.$i.'</a> | ';
                        }
                    }
                    if($tranghientai<$tongsotrang && $tongsotrang>1)
                    {
                        echo '<a href="xemthemsach.php?trang='.($tranghientai+1).'">Qua trang tiếp theo </a> ';
                    }
                    echo"</section>";
                ?>
            </form>
        </article>
        <?php include 'menuphai.php'?>
    </section>
    <?php include 'cuoitrang.php'?>
</body>
</html>