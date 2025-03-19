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
		<form id="frm-giohangmuangay" action="quanlinguoidung.php" method="post">
		<table id="table-giohang" align="center">
        <?php
            error_reporting(0);
            echo"<caption class='caption-noidung'> THÔNG TIN NGƯỜI DÙNG </caption>";
            echo "<tr> <th class='td-giohang'> STT </th> <th class='td-giohang'> Tên đăng nhập </th> <th class='td-giohang'> Mật khẩu </th> <th class='td-giohang'>Họ tên người dùng </th> 
                       <th class='td-giohang'>Địa chỉ </th> <th class='td-giohang'>Số điện thoại </th> <th class='td-giohang'>Email</th> <th class='td-giohang'>Phân loại</th>
                       <th class='td-giohang' align='center'>Chọn xóa/sửa</th> </tr>";
            $truyvan="SELECT * FROM NGUOIDUNG";
            $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
            $tongdong = mysqli_num_rows($ketqua);
            $ten=array();
            for($i=0;$i<$tongdong;$i++)
            {
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td class='td-giohang' align='center'>".($i+1)." </td> <td class='td-giohang' >".$dong['TENDANGNHAP']."</td> 
                      <td class='td-giohang'>".$dong['MATKHAU']."</td> <td class='td-giohang'>".$dong['HOTEN']."</td> <td class='td-giohang'>".$dong['DIACHI']."</td> 
                      <td class='td-giohang'>".$dong['SODT']."</td><td class='td-giohang'>".$dong['EMAIL']."</td> <td class='td-giohang'>".$dong['PHANLOAI']."</td> 
                      <td class='td-giohang' > <input type= 'checkbox' name= 'chkChon[".$i."]'> </td> </tr>" ;
                if(isset($_POST['chkChon'][$i]))
                {
                    array_push($ten,$dong['TENDANGNHAP']);
                }
            }
            echo "<tr > <td colspan='3' id='c9'> <button class='c2' name='btnThem'> Thêm người dùng </button> </td>
                        <td colspan='3' id='c9'> <button class='c2' name='btnXoa'> Xóa người dùng</button> </td>
                        <td colspan='3' id='c9'> <button class='c2' name='btnSua'> Sửa thông tin </button> </td>
                 </tr>";  
            if(isset($_POST['btnThem']))
                header('Location: themnguoidung.php');
            if(isset($_POST['btnXoa']))
            {
                $sodongxoa=sizeof($ten);
                if($sodongxoa!=0)
                {
                    for($i=0;$i<$sodongxoa;$i++)
                    {
                        $truyvanxoa="DELETE FROM NGUOIDUNG WHERE TENDANGNHAP='".$ten[$i]."' ";
                        $ketquaxoa = mysqli_query($conn,$truyvanxoa) or die (mysqli_error($conn));
                        header('Location: quanlinguoidung.php');
                    }
                }
                if(!isset($_POST['chkChon']))
                {
                    echo "<p class='c6'>Bạn chưa chọn người dùng để xóa </p>";
                }
            }
            if(isset($_POST['btnSua']))
            {
                if(!isset($_POST['chkChon']))
                {
                    echo "<p class='c6'>Bạn chưa chọn người dùng để sửa </p>";
                }
                else
                {
                    $_SESSION['tensua']=array();
                    $_SESSION['tensua']=$ten;
                    header('Location: suanguoidung.php');
                }
            }   
        ?>
		</table>
		</form> 
	</article>
    <?php include 'cuoitrang.php'?>
</body>
</html>