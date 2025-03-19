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
        <section class="search"><input class="search-box" type="search" placeholder="Tên Sách"><button><i class="fa-solid fa-magnifying-glass search-icon"></i></button></section>
    </nav>
    <section class="content">
        <?php include 'menutrai.php' ?>
        <article id="article-home">
            <?php
			    include 'KetNoi.php';
			    $conn=MoKetNoi();
                mysqli_select_db($conn,"NhaSachBKC");		   
		    ?>
		    <form action="" method="post" id='frm-noidung'>
                <table id="table-noidung">
                    <?php	
                        error_reporting(0);
                        $_SESSION['masach']=$_GET['masach'];
                        $truyvan="SELECT * FROM SACH AS S, NHAXUATBAN AS N, TACGIA AS T WHERE S.MASACH='".$_SESSION['masach']."' AND 
                                S.MANXB=N.MANXB AND S.MATG=T.MATG";
                        $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                        $dong=mysqli_fetch_array($ketqua);
                        echo "<caption class='caption-noidung'>". $dong['TUASACH'] ."</caption>";
                        echo "<tr class='tr-noidung'> <td class='td-noidung' rowspan='5'> <img class='img-noidung' src='".$dong['HINH']."'></td> 
                                <td class='td-noidung'>Năm phát hành :".$dong['NAMPHATHANH']."</td>  </tr>";
                        echo "<tr class='tr-noidung'> <td class='td-noidung'> Tác giả :".$dong['TENTG']." </td> </tr>";
                        echo "<tr class='tr-noidung'> <td class='td-noidung'> Nhà xuất bản :".$dong['TENNXB']." </td> </tr>";
                        echo "<tr class='tr-noidung'> <td class='td-noidung'> Giá bán :".number_format($dong['GIA'])." đồng </td> </tr> <br> <br>";
                        echo "<tr class='tr-noidung'> <td class='td-noidung'> Tóm tắt nội dung : <br>".$dong['NOIDUNG']." </td> </tr>";
                    
                        if(!isset($_SESSION['tendangnhap']))
                        {
                            echo "<p class='c6'> Phải đăng nhập mới được mua sách </p>";
                        }
                        else
                        {
                            if($_SESSION['loainguoidung']=='user')
                            {
                                echo "<tr> <td class='td-noidung'> <button class='c2' name='btnMuaSach'><a href='giohangmuangay.php?masach=".$dong['MASACH']."'>Mua Sách Ngay</a>  </button> </td> 
                                        <td class='td-noidung'> <button class='c2' name='btnThemGioHang' > Thêm vào giỏ hàng </button> </td></tr>";
                                $n=sizeof($_SESSION['DSMaMua']);
                                if(isset($_POST['btnThemGioHang']))
                                {
                                    if($n==0)
                                    {
                                        array_push($_SESSION['DSMaMua'],$dong['MASACH']);
                                        array_push($_SESSION['DSSL'],1);
                                    }
                                    else
                                    {
                                        $kt=0;
                                        $i=0;
                                        while($kt==0 && $i<$n)
                                        {
                                            if(strcmp($_SESSION['DSMaMua'][$i],$dong['MASACH'])==0)
                                                $kt=1; 
                                            else
                                                $i++;
                                        }
                                        if($kt==0)
                                        {
                                            array_push($_SESSION['DSMaMua'],$dong['MASACH']);
                                            array_push($_SESSION['DSSL'],1);
                                            echo "<p class='c6'> Bạn đã thêm ".$dong['TUASACH']. " vào giỏ hàng. Quay lại Trang chủ để tiếp tục mua sách </p>";
                                        }
                                        else
                                        {
                                            echo "<p class='c6'> Đã có ".$dong['TUASACH']. " trong giỏ hàng. Quay lại Trang chủ để tiếp tục mua sách </p>";
                                            
                                        }
                                    }
                                    header('location: xemnoidong.php');
                                }
                                if(isset($_POST['btnMuaSach']))
                                {
                                    $_SESSION['SL']=1;  
                                }
                            }    
                
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