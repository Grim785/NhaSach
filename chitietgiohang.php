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
        <section class="search"><input class="search-box" type="search" placeholder="Tên Sách"><button type='submit' name='btnSearch'><i class="fa-solid fa-magnifying-glass search-icon"></i></button></section>
    </nav>
    <article id="article-giohang">
    <?php
			include 'ketnoi.php';
			$conn=MoKetNoi();
            mysqli_select_db($conn,"NhaSachBKC");		   
		?>
      	<form id='frm-giohangmuangay' action="chitietgiohang.php" method="post">
		<table id="table-giohangmuangay" align='center'>
		<?php
               $n=sizeof($_SESSION['DSMaMua']);
               echo"<caption class='caption-noidung'> CHI TIẾT HÓA ĐƠN MUA SÁCH </caption>";
               echo "<tr> <th class='td-giohang'> STT </th> <th class='td-giohang' colspan='2' align='center'> Thông tin sách mua </th> <th class='td-giohang'> Giá tiền </th> <th class='td-giohang' align='center'>Số lượng </th> <th class='td-giohang'>Thành tiền </th> </tr>";
               $TongTien=0;
               for($i=0;$i<$n;$i++)
               {
               $truyvan="SELECT * FROM SACH AS S, NHAXUATBAN AS N, TACGIA AS T WHERE S.MASACH='".$_SESSION['DSMaMua'][$i]."' AND 
               S.MANXB=N.MANXB AND S.MATG=T.MATG";
               $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
               $dong=mysqli_fetch_array($ketqua);
               $Tien=$_SESSION['DSSL'][$i] *$dong['GIA'];
               $TongTien+=$Tien;                  
               echo "<tr> <td class='td-giohang' align='center'>".($i+1)." </td> <td class='td-giohang' > <img src='".$dong['HINH']."'></td> 
                 <td class='td-giohang'>".$dong['TUASACH']." <br> <br> Tác giả :".$dong['TENTG']." <br> <br> Nhà xuất bản :".$dong['TENNXB']." </td>  
                 <td class='td-giohang'>".number_format($dong['GIA'])." đồng </td> 
                 <td class='td-giohang' align='center'> ".$_SESSION['DSSL'][$i]."</td>
                 <td class='td-giohang'> ".number_format($Tien)." đồng </td>
                 </tr>";        
           }
           echo "<tr> <td class='td-giohang' colspan='5' align='center'> Tổng tiền </td> <td class='td-giohang'>".number_format($TongTien)." đồng </td> </tr>"; 
           echo "<tr> <td class='' colspan='6' id='c9'> <br> <br>Cám ơn bạn đã mua sách !!! </td>";
           $_SESSION['DSSL']=array();
           $_SESSION['DSMaMua']=array();
            ?>  
		</table>
		</form> 
    </article>
    <?php include 'cuoitrang.php'?>
</body>
</html>