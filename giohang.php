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
			include 'ketNoi.php';
			$conn=MoKetNoi();
            mysqli_select_db($conn,"NhaSachBKC");		   
		?>
        <form id="frm-giohangmuangay" action=" " method="post">
		<table id="table-giohangmuangay" align="center">
            <?php
                error_reporting(0);
                $n=sizeof($_SESSION['DSMaMua']);
                if($n==0)
                {
                    echo "<p class='c6' align='center'> Bạn chưa chọn sách để mua </p>";
                }
                else
                {
                    echo"<caption class='caption-noidung'> THÔNG TIN GIỎ HÀNG </caption>";
                    echo "<tr> <th class='td-giohang'> STT </th> <th class='td-giohang' colspan='2' align='center'> Thông tin sách mua </th> <th class='td-giohang'> Giá tiền </th> <th class='td-giohang' colspan='2'align='center'>Số lượng </th> <th class='td-giohang'>Thành tiền </th> </tr>";
                    $TongTien=0;
                    for($i=0;$i<$n;$i++)
                    {
                    $truyvan="SELECT * FROM SACH AS S, NHAXUATBAN AS N, TACGIA AS T WHERE S.MASACH='".$_SESSION['DSMaMua'][$i]."' AND 
                    S.MANXB=N.MANXB AND S.MATG=T.MATG";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    if(isset($_POST['txtSL'][$i]))
                    {
                        $_SESSION['DSSL'][$i]=$_POST['txtSL'][$i];
                    }    
                    $Tien=$_SESSION['DSSL'][$i] * $dong['GIA'];
                    $TongTien+=$Tien;                             
                    echo "<tr> <td class='td-giohang' align='center'>".($i+1)." </td> <td class='td-giohang' > <img src='".$dong['HINH']."'></td> 
                      <td class='td-giohang'>".$dong['TUASACH']." <br> <br> Tác giả :".$dong['TENTG']." <br> <br> Nhà xuất bản :".$dong['TENNXB']." </td>  
                      <td class='td-giohang'>".number_format($dong['GIA'])." đồng </td> 
                      <td class='td-giohang'> <input  type='number' min='1'  oninput='validity.valid||(value='');' name='txtSL[".$i."]' value=".$_SESSION['DSSL'][$i]." > </td>
                       <td class='td-giohang'> <button class='c2' name='btnXoa[".$i."]'> Xóa Sách </button> </td>
                      <td class='td-giohang'> ".number_format($Tien)." đồng </td>
                      </tr>";        
                    if(isset($_POST['btnXoa'][$i]))
                    {
                          for($j=$i;$j<$n-1;$j++)
                          {
                            $_SESSION['DSMaMua'][$j]=$_SESSION['DSMaMua'][$j+1];
                            $_SESSION['DSSL'][$j]=$_SESSION['DSSL'][$j+1];
                          }
                          array_pop($_SESSION['DSMaMua']);
                          array_pop($_SESSION['DSSL']);
                          header('Location: gioHang.php');
                    }
                    }
                echo "<tr> <td class='td-giohang' colspan='6' align='center'> Tổng tiền </td> <td class='td-giohang'>".number_format($TongTien)." đồng </td> </tr>"; 
                echo "<tr > <td class='' colspan='4' id='c9'> <button class='c2' name='btnThanhToan'> <a href='chitietgiohang.php'> Thanh toán </a> </button> </td>
                <td class='' colspan='3' id='c9'> <input type='submit' class='c2' name='btnCapNhat' value='Cập nhật giỏ hàng'> </td> </tr>";
                }
            ?>
		</table>
		</form> 
    </article>
    <?php include 'cuoitrang.php'?>
</body>
</html>