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
    <article id="article-giohang">
        <?php
			include 'ketnoi.php';
			$conn=MoKetNoi();
            mysqli_select_db($conn,"NhaSachBKC");		   
		?>
        <form id="frm-giohangmuangay" action="" method="post">
            <table id="table-giohangmuangay">
                <?php
                    error_reporting(0);
                    if(isset($_POST['btnXoaMuaNgay']))
                    {
                        echo "<p class='c6' style='width:100%' align='center'>Bạn chưa chọn sách mua. Quay lại Trang chủ để chọn sách </p>";
                    }
                    else
                    {
                    echo "<caption class='caption-noidung'> THÔNG TIN GIỎ HÀNG </caption>";
                    $truyvan="SELECT * FROM SACH AS S, NHAXUATBAN AS N, TACGIA AS T WHERE S.MASACH='".$_SESSION['masach']."' AND 
                            S.MANXB=N.MANXB AND S.MATG=T.MATG";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    
                    $_SESSION['SL']=$_POST['txtSL'];
                    $Tien=$_SESSION['SL'] * $dong['GIA'];
                    if(empty($_POST['txtSL']))
                        { 
                            $_SESSION['SL'] =1; 
                            $Tien=$_SESSION['SL'] * $dong['GIA'];
                        }
                    echo "<tr class='tr-giohang'> <th class='td-giohang'> STT </th> <th class='td-giohang' colspan='2'> Thông tin sách mua </th> <th class='td-giohang'> Giá tiền </th> <th class='td-giohang' colspan='2'align='center'>Số lượng </th> <th class='td-giohang'>Thành tiền </th> </tr>";
                    echo "<tr class='tr-giohang'> <td class='td-giohang'> 1 </td> <td class='td-giohang' > <img src='".$dong['HINH']."'></td> 
                            <td class='td-giohang'>".$dong['TUASACH']." <br> <br> Tác giả :".$dong['TENTG']." <br> <br> Nhà xuất bản :".$dong['TENNXB']." </td>  
                            <td class='td-giohang'>".number_format($dong['GIA'])." đồng </td> 
                            <td class='td-giohang'> <input  type='number' min='1'  oninput='validity.valid||(value='');' name='txtSL' value=".$_SESSION['SL']." > </td>
                                <td class='td-giohang'>    <button class='c2' name='btnXoaMuaNgay'> Xóa Sách </button> </td>
                            <td class='td-giohang'> ".number_format($Tien)." đồng </td>
                        </tr>";
                    echo "<tr class='tr-giohang'> <td class='td-giohang' colspan='6'> Tổng tiền </td> <td class='td-giohang'>".number_format($Tien)." đồng </td> </tr>";   
                    echo "<tr class='tr-giohang' > <td class='' colspan='4' id='c9'> <button class='c2' name='btnThanhToanMuaNgay'> Thanh toán </button> </td>
                            <td class='' colspan='3' id='c9'> <input type='submit' class='c2' name='btnCapNhatMuaNgay' value='Cập nhật giỏ hàng'> </td> </tr>";
                    
                    if (isset($_POST['btnThanhToanMuaNgay']))
                        {
                            header('Location: giohangmuangaychitiet.php');
                        }  
                    }
                ?>   
            </table>     
        </form>
    </article>
    <?php include 'cuoitrang.php'?>
</body>
</html>