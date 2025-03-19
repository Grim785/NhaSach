<html>
<?php include 'dautrang.php'?>
<body>
    <nav>
		<ul id="d1">  
             <li> <a class="d2" href="trangchu.php">Trang chủ </a> </li>
             <?php 
                session_start();
                echo "<li class='d2'> Xin chào bạn ".$_SESSION['tendangnhap']." </li>"; 
             ?>
		</ul>
	</nav>
	<article id="article-giohang"> 
    <?php
			include 'ketNoi.php';
			$conn=MoKetNoi();
            mysqli_select_db($conn,"NhaSachBKC");		   
		?>
		<form id="frm-giohangmuangay" action="suanguoidung.php" method="post">
		<table id="table-giohang" align="center">
        <?php
            error_reporting(0);
            if($_SESSION['kt']!=0)
            {
                echo "<p class='c6'> Đã sửa thành công thông tin người dùng </p>";
            }
            $_SESSION['kt']=0;
            echo"<caption class='caption-noidung'> THÔNG TIN NGƯỜI DÙNG </caption>";
            echo "<tr> <th class='td-giohang'> STT </th> <th class='td-giohang'> Tên đăng nhập </th> <th class='td-giohang'> Mật khẩu </th> <th class='td-giohang'>Họ tên người dùng </th> 
                       <th class='td-giohang'>Địa chỉ </th> <th class='td-giohang'>Số điện thoại </th> <th class='td-giohang'>Email</th> <th class='td-giohang'>Phân loại</th> </tr>";
            $n=sizeof($_SESSION['tensua']);
            for($i=0;$i<$n;$i++)
            {
                $truyvan="SELECT * FROM NGUOIDUNG WHERE TENDANGNHAP='".$_SESSION['tensua'][$i]."'";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td class='td-giohang' align='center'>".($i+1)." </td> <td class='td-giohang' > ".$dong['TENDANGNHAP']."  </td> 
                      <td class='td-giohang'> <input type='text' name= 'txtMK[".$i."]' value=".$dong['MATKHAU']." > </td> 
                      <td class='td-giohang'> <input type='text' name= 'txtHT[".$i."]' value=".$dong['HOTEN']." > </td> 
                      <td class='td-giohang'> <input type='text' name= 'txtDC[".$i."]' value=".$dong['DIACHI']." > </td> 
                      <td class='td-giohang'> ".$dong['SODT']." </td>
                      <td class='td-giohang'> <input type='text' name= 'txtM[".$i."]' value=".$dong['EMAIL']." > </td> 
                      <td class='td-giohang'> <select name='cboLoai[".$i."]'> <option value='user'> user </option>
                                                    <option value='admin'> admin </option>
                           </select> </td>
                      </tr>" ;
            }
            echo "<tr > <td colspan='4' id='c9'> <input class='c2' type= 'submit' name= 'sbtDongY' value= 'Đồng ý' >  </td>
            <td colspan='4' id='c9'> <button class='c2' name='btnThoat'> Quay lại Quản lý người dùng </button> </td> </tr>";
            
            if(isset($_POST['sbtDongY']))
            {
                for($i=0;$i<$n;$i++)
                {
                    $truyvan="UPDATE NGUOIDUNG 
                              SET MATKHAU='".$_POST['txtMK'][$i]."', HOTEN='".$_POST['txtHT'][$i]."', 
                                  DIACHI='".$_POST['txtDC'][$i]."', EMAIL='".$_POST['txtM'][$i]."', 
                                  PHANLOAI ='".$_POST['cboLoai'][$i]."'
                              WHERE TENDANGNHAP='".$_SESSION['tensua'][$i]."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                }
                $kq= mysqli_affected_rows($conn);
                if($kq!=0)
                {
                    $_SESSION['kt']=1;
                }
                header('Location: suanguoidung.php');
            }
            if(isset($_POST['btnThoat']))
                header('Location: quanlinguoidung.php');
        ?>
		</table>
		</form> 
	</article>
    <?php include 'cuoitrang.php'?>
</body>
</html>