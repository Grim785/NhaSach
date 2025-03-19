<?php
    include 'ketnoi.php';
    $conn=MoKetNoi();
    if($conn->connect_error)
    {
        echo "không kết nối được";
    }
    $sql="CREATE DATABASE IF NOT EXISTS NhaSachBKC";
    if(!mysqli_query($conn,$sql))
    {
        echo "Không tạo được database Nhà Sách BKC ".mysqli_error($conn);
    }

    mysqli_select_db($conn,"NhaSachBKC");

    $NGUOIDUNG = "CREATE TABLE IF NOT EXISTS NGUOIDUNG (
        TENDANGNHAP varchar(200) NOT NULL,
        MATKHAU varchar(200) NOT NULL,
        HOTEN nvarchar(200) NOT NULL,
        DIACHI nvarchar(200) default 'chưa cập nhật',
        SODT int default 0,
        EMAIL varchar(20) default 'chưa cập nhật',
        PHANLOAI varchar(20) default 'user',
        PRIMARY KEY(TENDANGNHAP,SODT))";
    $result = mysqli_query($conn,$NGUOIDUNG) or die(mysqli_error($conn));

    $DataNGUOIDUNG="INSERT INTO NGUOIDUNG (TENDANGNHAP,MATKHAU,HOTEN,DIACHI,SODT,EMAIL,PHANLOAI)".
                " VALUES('Annguyen','123','Nguyễn Văn An','123 abc','123456789','abc@gmail.com','admin')";
    $results= mysqli_query($conn,$DataNGUOIDUNG)  or die(mysqli_error($conn));
    
    $LOAI = "CREATE TABLE IF NOT EXISTS LOAI (
        MATL varchar(20) primary key,
        TENTL nvarchar(200) not null)";
    $results = mysqli_query($conn,$LOAI)or die (mysqli_error($conn));

    $TACGIA = "CREATE TABLE IF NOT EXISTS TACGIA (
        MATG varchar(20) primary key,
        TENTG nvarchar(200) not null)";
    $results = mysqli_query($conn,$TACGIA)or die (mysqli_error($conn));

    $NXB = "CREATE TABLE IF NOT EXISTS NHAXUATBAN (
        MANXB varchar(20) primary key,
        TENNXB nvarchar(200) not null)";
    $results = mysqli_query($conn,$NXB)or die (mysqli_error($conn));

    $SACH = "CREATE TABLE IF NOT EXISTS SACH (
        MASACH varchar(20) primary key,
        TUASACH nvarchar(200) not null,
        NAMPHATHANH int default 0,
        HINH varchar(200) not null,
        MANXB varchar(20) not null,
        MATL varchar(20) not null,
        MATG varchar(20) not null,
        NOIDUNG varchar(1000) default 'Chưa cập nhật',
        SOLUONG int default 10,
        GIA int default 10000)";
    $results = mysqli_query($conn,$SACH)or die (mysqli_error($conn));

    $DONHANG="CREATE TABLE IF NOT EXISTS DONHANG(
            MADH int(10) auto_increment primary key,
            TENDANGNHAP varchar(200) NOT NULL,
            DIACHI nvarchar(200),
            SODT int,
            HOTEN nvarchar(200),
            NGAYDAT date,
            TONGTIEN int,
            THANHTOAN nvarchar(200)) auto_increment=1";
    $results = mysqli_query($conn,$DONHANG)or die (mysqli_error($conn));

    $CHITIETDONHANG="CREATE TABLE IF NOT EXISTS CHITIETDONHANG(
            MADH int(10),
            MASACH varchar(20),
            SOLUONG int,
            PRIMARY KEY (MADH, MASACH))";
    $results = mysqli_query($conn,$CHITIETDONHANG)or die (mysqli_error($conn));

    $DataLOAI="INSERT INTO LOAI (MATL,TENTL)". 
    "VALUES ('VH','Văn học'),".
    "('KT','Kinh tế'),".
    "('KTh','Kỹ thuật')";
        $results = mysqli_query($conn,$DataLOAI) or die (mysqli_error($conn));

        $DataNHAXUATBAN="INSERT INTO NHAXUATBAN (MANXB,TENNXB)". 
            "VALUES ('XB01','Nhà xuât bản văn học'),".
            "('XB02','Nhà xuât bản trẻ'),".
            "('XB03','Nhà xuất bản kinh tế'),".
            "('XB04','Nhà xuất bản giáo dục Việt Nam'),".
            "('XB05','Nhà xuât bản văn học 1'),".
            "('XB06','Nhà xuât bản trẻ 2'),".
            "('XB07','Nhà xuất bản kinh tế 3'),".
            "('XB08','Nhà xuất bản giáo dục Việt Nam 4')";
        $results = mysqli_query($conn,$DataNHAXUATBAN) or die (mysqli_error($conn));

        $DataTACGIA="INSERT INTO TACGIA (MATG,TENTG)". 
            "VALUES ('TG01','Ernest Hemingway'),".
            "('TG02','Hector Malot'),".
            "('TG03','Antoine de Saint'),".
            "('TG04','Trần Thị Ngân Tuyến'),".
            "('TG05','Nguyễn Trọng Hoài'),".
            "('TG06','Nhiều tác giả'),".
            "('TG07','Ernest Hemingway'),".
            "('TG08','Hector Malot'),".
            "('TG09','Antoine de Saint'),".
            "('TG010','Trần Thị Ngân Tuyến'),".
            "('TG011','Nguyễn Trọng Hoài'),".
            "('TG012','Nhiều tác giả')";
        $results = mysqli_query($conn,$DataTACGIA) or die (mysqli_error($conn));

        $DataSACH="INSERT INTO SACH (MASACH, TUASACH, NAMPHATHANH, HINH, MANXB, MATL,MATG)". 
        "VALUES ('VH01','Ông già và biển cả 1',1952,'HinhAnh/s1.png','XB01','VH','TG01'),".
        "('VH02','Không gia đình 1',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH03','Hoàng tử bé 1',1943,'HinhAnh/s3.jpg','XB01','VH','TG03'),".
        "('VH04','Ông già và biển cả 2',1952,'HinhAnh/s1.png','XB01','VH','TG01'),".
        "('VH05','Không gia đình 2',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH06','Hoàng tử bé 2',1943,'HinhAnh/s3.jpg','XB01','VH','TG03'),".
        "('VH07','Ông già và biển cả 3',1952,'HinhAnh/s1.png','XB01','VH','TG01'),".
        "('VH08','Không gia đình 3',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH09','Hoàng tử bé 3',1943,'HinhAnh/s3.jpg','XB01','VH','TG03'),".
        "('VH010','Ông già và biển cả 4',1952,'HinhAnh/s1.png','XB01','VH','TG01'),".
        "('VH011','Không gia đình 4',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH012','Không gia đình 4',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH013','Hoàng tử bé 4',1943,'HinhAnh/s3.jpg','XB01','VH','TG03'),".
        "('VH014','Ông già và biển cả 5',1952,'HinhAnh/s1.png','XB01','VH','TG01'),".
        "('VH015','Không gia đình 5',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH016','Hoàng tử bé 5',1943,'HinhAnh/s3.jpg','XB01','VH','TG03'),".
        "('VH017','Ông già và biển cả 6',1952,'HinhAnh/s1.png','XB01','VH','TG01'),".
        "('VH018','Không gia đình 6',1878,'HinhAnh/s2.jpg','XB01','VH','TG02'),".
        "('VH019','Hoàng tử bé 6',1943,'HinhAnh/s3.jpg','XB01','VH','TG03'),".

        "('KT01','Từ tốt đến vĩ dại 1',2023,'HinhAnh/s4.jpg','XB02','KT','TG04'),".
        "('KT02','Kinh tế phát triển 1',2023,'HinhAnh/s5.jpg','XB03','KT','TG05'),".
        "('KT03','Kinh tế vĩ mô 1',2009,'HinhAnh/s6.jpg','XB04','KT','TG06'),".
        "('KT04','Từ tốt đến vĩ dại 2',2023,'HinhAnh/s4.jpg','XB02','KT','TG04'),".
        "('KT05','Kinh tế phát triển 2',2023,'HinhAnh/s5.jpg','XB03','KT','TG05'),".
        "('KT06','Kinh tế vĩ mô 2',2009,'HinhAnh/s6.jpg','XB04','KT','TG06'),".
        "('KT07','Từ tốt đến vĩ dại 3',2023,'HinhAnh/s4.jpg','XB02','KT','TG04'),".

        "('KyT01','Cơ học kết cấu 1',2023,'HinhAnh/s7.jpg','XB02','KTh','TG04'),".
        "('KyT02','Kỹ thuật thi công 1',2023,'HinhAnh/s7.jpg','XB03','KTh','TG05'),".
        "('KyT03','Hàn điện nóng chảy 1',2009,'HinhAnh/s9.jpg','XB04','KTh','TG06'),".
        "('KyT04','Cơ học kết cấu 2',2023,'HinhAnh/s7.jpg','XB02','KTh','TG04'),".
        "('KyT05','Kỹ thuật thi công 2',2023,'HinhAnh/s7.jpg','XB03','KTh','TG05'),".
        "('KyT06','Hàn điện nóng chảy 2',2009,'HinhAnh/s9.jpg','XB04','KTh','TG06')";
        $results = mysqli_query($conn,$DataSACH) or die (mysqli_error($conn));

        DongKetNoi($conn);
?>