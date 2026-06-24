<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}
include "config.php";

if(!isset($_GET['page']))
{
    if($_SESSION['role']=='staff')
    {
        header("Location: trangchu.php?page=hoadon");
        exit();
    }
}

$page = isset($_GET['page'])
        ? $_GET['page']
        : 'dashboard';

$userRole = $_SESSION['role'];

$permissions = [

    'admin' => [
        'dashboard','users','chinhanh','nhanvien',
        'danhmuc','mon','congthuc',
        'kho','tonkho','nhapkho','xuatkho',
        'hoadon','khachhang','voucher',
        'ban','thongke'
    ],

    'manager' => [
        'dashboard',
        'nhanvien',
        'hoadon',
        'khachhang',
        'nhapkho',
        'xuatkho',
        'danhmuc',
        'mon',
        'congthuc',
        'voucher',
        'ban',
        'tonkho'
    ],

    'staff' => [
        'hoadon',
        'mon',
        'ban',
        'danhmuc',
        'congthuc',
        'voucher'
    ],
];

if(
    !isset($permissions[$userRole]) ||
    !in_array($page,$permissions[$userRole])
){
    header("HTTP/1.1 403 Forbidden");
    exit("403 - Không có quyền truy cập");
}

// ==========================
// THEM CHI NHANH
// ==========================
mysqli_query(
    $conn,
    "UPDATE voucher
     SET trang_thai='Het han'
     WHERE ngay_ket_thuc < CURDATE()"
);

function updateInvoiceTotal($conn,$ma_hd)
{
    $tong = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT IFNULL(SUM(thanh_tien),0) tong
             FROM chi_tiet_hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    $tong_tien = $tong['tong'];

    $hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT tien_giam
             FROM hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    $tien_giam = $hd['tien_giam'] ?? 0;

    $thanh_toan = max(
        0,
        $tong_tien - $tien_giam
    );

    mysqli_query(
        $conn,
        "UPDATE hoa_don
         SET
            tong_tien='$tong_tien',
            thanh_toan='$thanh_toan'
         WHERE ma_hd=$ma_hd"
    );
}
if(isset($_GET['xoa_ct']))
{
    $ma_ct = (int)$_GET['xoa_ct'];

    mysqli_query(
        $conn,
        "DELETE FROM cong_thuc_mon
         WHERE ma_ct = $ma_ct"
    );

    echo "
    <script>
        alert('Đã xóa công thức!');
        window.location='?page=congthuc';
    </script>
    ";
}
if(isset($_POST['capnhat_congthuc']))
{
    $ma_ct = (int)$_POST['ma_ct'];
    $so_luong = $_POST['so_luong'];

    mysqli_query(
        $conn,
        "UPDATE cong_thuc_mon
         SET so_luong='$so_luong'
         WHERE ma_ct='$ma_ct'"
    );

    echo "
    <script>
        alert('Cập nhật thành công!');
        window.location='?page=congthuc';
    </script>
    ";
}
if(isset($_POST['thanhtoan']))
{
    $ma_hd = (int)$_POST['ma_hd'];

    $phuong_thuc_tt =
        trim($_POST['phuong_thuc_tt'] ?? '');

    $ma_voucher =
        !empty($_POST['ma_voucher'])
        ? (int)$_POST['ma_voucher']
        : 0;

    $hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    if(!$hd)
    {
        die("Hóa đơn không tồn tại");
    }

    if($hd['trang_thai'] == 'Da thanh toan')
    {
        die("Hóa đơn đã được thanh toán");
    }

    $check = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT COUNT(*) tong
             FROM chi_tiet_hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    if($check['tong'] == 0)
    {
        echo "
        <script>
            alert('Hóa đơn chưa có món');
            history.back();
        </script>
        ";
        exit();
    }
  
    mysqli_begin_transaction($conn);

    try
    {
        $tien_giam = 0;

        /*
        =====================================
        XỬ LÝ VOUCHER
        =====================================
        */

        if($ma_voucher > 0)
        {
            $voucher = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT *
                     FROM voucher
                     WHERE ma_voucher=$ma_voucher
                     AND trang_thai='Hoat dong'"
                )
            );

            if(!$voucher)
            {
                throw new Exception(
                    "Voucher không tồn tại hoặc đã ngừng hoạt động"
                );
            }

            if($voucher['so_luong'] <= 0)
            {
                throw new Exception(
                    "Voucher đã hết lượt sử dụng"
                );
            }

            if(
                $hd['tong_tien']
                <
                $voucher['don_hang_toi_thieu']
            )
            {
                throw new Exception(
                    "Chưa đủ giá trị đơn hàng tối thiểu để dùng voucher"
                );
            }

            if($voucher['loai_giam'] == 'Tien')
            {
                $tien_giam =
                    (float)$voucher['gia_tri'];
            }
            else
            {
                $tien_giam =
                    (
                        (float)$hd['tong_tien']
                        *
                        (float)$voucher['gia_tri']
                    ) / 100;
            }

            if($tien_giam > $hd['tong_tien'])
            {
                $tien_giam = $hd['tong_tien'];
            }

            mysqli_query(
                $conn,
                "UPDATE voucher
                 SET so_luong = so_luong - 1
                 WHERE ma_voucher=$ma_voucher"
            );
        }

        /*
        =====================================
        TÍNH THÀNH TIỀN
        =====================================
        */

        $thanh_toan =
            max(
                0,
                $hd['tong_tien'] - $tien_giam
            );

        mysqli_query(
            $conn,
            "UPDATE hoa_don
             SET
                ma_voucher=".
                ($ma_voucher > 0
                    ? $ma_voucher
                    : "NULL")
                .",
                tien_giam='$tien_giam',
                thanh_toan='$thanh_toan',
                phuong_thuc_tt='$phuong_thuc_tt',
                trang_thai='Da thanh toan'
             WHERE ma_hd=$ma_hd"
        );

        /*
        =====================================
        TRẢ BÀN
        =====================================
        */

        if(!empty($hd['ma_ban']))
        {
            mysqli_query(
                $conn,
                "UPDATE ban
                 SET trang_thai='Trong'
                 WHERE ma_ban=".$hd['ma_ban']
            );
        }

        /*
        =====================================
        TÍCH ĐIỂM KHÁCH HÀNG
        =====================================
        */

        if(!empty($hd['ma_kh']))
        {
            $diem_cong =
                floor(
                    $thanh_toan / 10000
                );

            if($diem_cong > 0)
            {
                mysqli_query(
                    $conn,
                    "UPDATE khach_hang
                     SET diem_tich_luy =
                         diem_tich_luy + $diem_cong
                     WHERE ma_kh=".$hd['ma_kh']
                );

                mysqli_query(
                    $conn,
                    "INSERT INTO lich_su_diem
                    (
                        ma_kh,
                        diem_thay_doi,
                        ly_do
                    )
                    VALUES
                    (
                        ".$hd['ma_kh'].",
                        $diem_cong,
                        'Thanh toán hóa đơn #$ma_hd'
                    )"
                );
            }
        }

        /*
        =====================================
        NHẬT KÝ HỆ THỐNG
        =====================================
        */

        if(isset($_SESSION['user_id']))
        {
            $user_id =
                (int)$_SESSION['user_id'];

            mysqli_query(
                $conn,
                "INSERT INTO nhat_ky_he_thong
                (
                    user_id,
                    hanh_dong,
                    bang_tac_dong,
                    ma_ban_ghi,
                    mo_ta,
                    ip_address
                )
                VALUES
                (
                    '$user_id',
                    'Thanh toan',
                    'hoa_don',
                    '$ma_hd',
                    'Thanh toán hóa đơn',
                    '".$_SERVER['REMOTE_ADDR']."'
                )"
            );
        }

        mysqli_commit($conn);

        header(
            'Location: trangchu.php?page=hoadon'
        );

        exit();
    }
    catch(Exception $e)
    {
        mysqli_rollback($conn);

        die($e->getMessage());
    }
}
if(isset($_POST['them_chinhanh']))
{
    $ten_cn = trim($_POST['ten_cn']);
    $dia_chi = trim($_POST['dia_chi']);
    $sdt = trim($_POST['sdt']);
    $trang_thai = $_POST['trang_thai'];

    $sql = "INSERT INTO chi_nhanh
            (ten_cn,dia_chi,sdt,trang_thai)
            VALUES
            ('$ten_cn','$dia_chi','$sdt','$trang_thai')";

    mysqli_query($conn,$sql);

    header("Location: trangchu.php?page=chinhanh");
    exit();
}

// ==========================
// XOA CHI NHANH
// ==========================

if(isset($_GET['xoa_cn']))
{
    $ma_cn = (int)$_GET['xoa_cn'];
    $check = mysqli_query(
    $conn,
    "SELECT *
     FROM nhan_vien
     WHERE ma_cn=$ma_cn"
);

if(mysqli_num_rows($check)>0)
{
    die("Chi nhánh đang có nhân viên");
}
    mysqli_query(
        $conn,
        "DELETE FROM chi_nhanh
        WHERE ma_cn = $ma_cn"
    );

    header("Location: trangchu.php?page=chinhanh");
    exit();
}

// ==========================
// CAP NHAT CHI NHANH
// ==========================

if(isset($_POST['capnhat_chinhanh']))
{
    $ma_cn = (int)$_POST['ma_cn'];

    $ten_cn = trim($_POST['ten_cn']);
    $dia_chi = trim($_POST['dia_chi']);
    $sdt = trim($_POST['sdt']);
    $trang_thai = $_POST['trang_thai'];

    mysqli_query(
        $conn,
        "UPDATE chi_nhanh
        SET
        ten_cn='$ten_cn',
        dia_chi='$dia_chi',
        sdt='$sdt',
        trang_thai='$trang_thai'
        WHERE ma_cn=$ma_cn"
    );

    header("Location: trangchu.php?page=chinhanh");
    exit();
}
if(isset($_POST['them_nhanvien']))
{
    $ten_nv = $_POST['ten_nv'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $dia_chi = $_POST['dia_chi'];
    $chuc_vu = $_POST['chuc_vu'];
    $luong = $_POST['luong'];
    $ma_cn = $_POST['ma_cn'];
    $check = mysqli_query(
    $conn,
    "SELECT *
     FROM nhan_vien
     WHERE email='$email'"
);

if(mysqli_num_rows($check)>0)
{
    die("Email đã tồn tại");
}
    $sql = "INSERT INTO nhan_vien
(
    ten_nv,
    gioi_tinh,
    ngay_sinh,
    sdt,
    email,
    dia_chi,
    chuc_vu,
    luong,
    ma_cn
)
VALUES
(
    '$ten_nv',
    '$gioi_tinh',
    '$ngay_sinh',
    '$sdt',
    '$email',
    '$dia_chi',
    '$chuc_vu',
    '$luong',
    '$ma_cn'
)";

if(!mysqli_query($conn,$sql))
{
    die(mysqli_error($conn));
}

    header("Location: trangchu.php?page=nhanvien");
    exit();
}
if(isset($_GET['xoa_nv']))
{
    $ma_nv = (int)$_GET['xoa_nv'];
$check = mysqli_query(
    $conn,
    "SELECT *
     FROM hoa_don
     WHERE ma_nv=$ma_nv"
);
if(mysqli_num_rows($check)>0)
{
    die("Nhân viên đã phát sinh hóa đơn");
}

mysqli_query(
    $conn,
    "DELETE FROM nhan_vien
     WHERE ma_nv=$ma_nv"
);

header("Location: trangchu.php?page=nhanvien");
exit();
}
if(isset($_POST['capnhat_nhanvien']))
{
    $ma_nv = (int)$_POST['ma_nv'];

    mysqli_query(
        $conn,
        "UPDATE nhan_vien
        SET
            ten_nv='".$_POST['ten_nv']."',
            gioi_tinh='".$_POST['gioi_tinh']."',
            ngay_sinh='".$_POST['ngay_sinh']."',
            sdt='".$_POST['sdt']."',
            email='".$_POST['email']."',
            dia_chi='".$_POST['dia_chi']."',
            chuc_vu='".$_POST['chuc_vu']."',
            luong='".$_POST['luong']."',
            ma_cn='".$_POST['ma_cn']."'
        WHERE ma_nv=$ma_nv"
    );

    header("Location: trangchu.php?page=nhanvien");
    exit();
}
if(isset($_POST['them_khachhang']))
{
    $ten_kh = $_POST['ten_kh'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $diem_tich_luy = $_POST['diem_tich_luy'];
    $check = mysqli_query(
    $conn,
    "SELECT *
     FROM khach_hang
     WHERE sdt='$sdt'"
);

if(mysqli_num_rows($check)>0)
{
    die("Số điện thoại đã tồn tại");
}
    mysqli_query(
        $conn,
        "INSERT INTO khach_hang
        (
            ten_kh,
            sdt,
            email,
            diem_tich_luy
        )
        VALUES
        (
            '$ten_kh',
            '$sdt',
            '$email',
            '$diem_tich_luy'
        )"
    );

    header("Location: trangchu.php?page=khachhang");
    exit();
}
if(isset($_GET['xoa_kh']))
{
    $ma_kh = (int)$_GET['xoa_kh'];
$check = mysqli_query(
    $conn,
    "SELECT *
     FROM hoa_don
     WHERE ma_kh=$ma_kh"
);

if(mysqli_num_rows($check)>0)
{
    die("Khách hàng đã phát sinh giao dịch");
}
mysqli_query(
    $conn,
    "DELETE FROM khach_hang
     WHERE ma_kh=$ma_kh"
);
    header("Location: trangchu.php?page=khachhang");
    exit();
}
if(isset($_POST['capnhat_khachhang']))
{
    $ma_kh = (int)$_POST['ma_kh'];

    mysqli_query(
        $conn,
        "UPDATE khach_hang
        SET
            ten_kh='".$_POST['ten_kh']."',
            sdt='".$_POST['sdt']."',
            email='".$_POST['email']."',
            diem_tich_luy='".$_POST['diem_tich_luy']."'
        WHERE ma_kh=$ma_kh"
    );

    header("Location: trangchu.php?page=khachhang");
    exit();
}
if(isset($_POST['them_danhmuc']))
{
    $ten_dm = trim($_POST['ten_dm']);

    $check = mysqli_query(
        $conn,
        "SELECT *
         FROM danh_muc
         WHERE ten_dm='$ten_dm'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "
        <script>
            alert('Danh mục đã tồn tại');
            window.location='trangchu.php?page=danhmuc';
        </script>
        ";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO danh_muc
            (
                ten_dm
            )
            VALUES
            (
                '$ten_dm'
            )"
        );

        header("Location: trangchu.php?page=danhmuc");
        exit();
    }
}
if(isset($_GET['xoa_dm']))
{
    $ma_dm = (int)$_GET['xoa_dm'];
    $check = mysqli_query(
    $conn,
    "SELECT *
     FROM mon
     WHERE ma_dm=$ma_dm"
);

if(mysqli_num_rows($check)>0)
{
    die("Danh mục đang chứa món");
}
    mysqli_query(
        $conn,
        "DELETE FROM danh_muc
        WHERE ma_dm=$ma_dm"
    );

    header("Location: trangchu.php?page=danhmuc");
    exit();
}
if(isset($_POST['capnhat_danhmuc']))
{
    $ma_dm = (int)$_POST['ma_dm'];
    $ten_dm = trim($_POST['ten_dm']);

    $check = mysqli_query(
        $conn,
        "SELECT *
         FROM danh_muc
         WHERE ten_dm='$ten_dm'
         AND ma_dm <> $ma_dm"
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "<script>alert('Tên danh mục đã tồn tại');</script>";
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE danh_muc
             SET ten_dm='$ten_dm'
             WHERE ma_dm=$ma_dm"
        );

        header("Location: trangchu.php?page=danhmuc");
        exit();
    }
}
if(isset($_POST['them_mon']))
{
    $ten_mon = trim($_POST['ten_mon']);
    $gia = $_POST['gia'];
    $hinh_anh = $_POST['hinh_anh'];
    $mo_ta = $_POST['mo_ta'];
    $ma_dm = $_POST['ma_dm'];
    $trang_thai = $_POST['trang_thai'];

    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM mon
        WHERE ten_mon='$ten_mon'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "
        <script>
        alert('Món đã tồn tại');
        </script>
        ";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO mon
            (
                ten_mon,
                gia,
                hinh_anh,
                mo_ta,
                ma_dm,
                trang_thai
            )
            VALUES
            (
                '$ten_mon',
                '$gia',
                '$hinh_anh',
                '$mo_ta',
                '$ma_dm',
                '$trang_thai'
            )"
        );

        header("Location: trangchu.php?page=mon");
        exit();
    }
}
if(isset($_POST['thanhtoan']))
{
    $ma_hd =
        (int)$_POST['ma_hd'];

    $ma_voucher =
        !empty($_POST['ma_voucher'])
        ?
        (int)$_POST['ma_voucher']
        :
        "NULL";

    $phuong_thuc_tt =
        mysqli_real_escape_string(
            $conn,
            $_POST['phuong_thuc_tt']
        );

    $hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    if(!$hd)
    {
        die('Không tìm thấy hóa đơn');
    }

    if(
        $hd['trang_thai']
        == 'Da thanh toan'
    )
    {
        echo "
        <script>
            alert('Hóa đơn đã thanh toán');
            history.back();
        </script>";
        exit();
    }

    $tong_tien =
        (float)$hd['tong_tien'];

    $tien_giam = 0;

    /* ÁP VOUCHER */
    if($ma_voucher != "NULL")
    {
        $vc = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT *
                 FROM voucher
                 WHERE ma_voucher=$ma_voucher"
            )
        );

        if($vc)
        {
            if(
                $vc['loai_giam']
                == 'Phan tram'
            )
            {
                $tien_giam =
                    (
                        $tong_tien
                        *
                        $vc['gia_tri']
                    ) / 100;
            }
            else
            {
                $tien_giam =
                    $vc['gia_tri'];
            }
        }
    }

    $thanh_toan =
        max(
            0,
            $tong_tien - $tien_giam
        );

    mysqli_query(
        $conn,
        "UPDATE hoa_don
         SET
            trang_thai='Da thanh toan',

            ma_voucher =
            ".($ma_voucher=="NULL"
            ? "NULL"
            : $ma_voucher).",

            tien_giam =
            $tien_giam,

            thanh_toan =
            $thanh_toan,

            phuong_thuc_tt =
            '$phuong_thuc_tt'

         WHERE ma_hd=$ma_hd"
    );

    /* TRẢ BÀN */
    mysqli_query(
        $conn,
        "UPDATE ban
         SET trang_thai='Trong'
         WHERE ma_ban=".$hd['ma_ban']
    );

    echo "
    <script>

    alert('Thanh toán thành công');

    if(
        confirm(
            'Bạn có muốn in hóa đơn không?'
        )
    )
    {
        window.open(
            'inhoadon.php?ma_hd=$ma_hd',
            '_blank'
        );
    }

    location =
        '?page=hoadon';

    </script>";

    exit();
}
if(isset($_GET['xoa_mon']))
{
    $ma_mon = (int)$_GET['xoa_mon'];

    mysqli_query(
        $conn,
        "UPDATE mon
SET trang_thai='Ngung ban'
WHERE ma_mon=$ma_mon"
    );
    header("Location: trangchu.php?page=mon");
    exit();
}
if(isset($_POST['capnhat_mon']))
{
    $ma_mon = (int)$_POST['ma_mon'];

    $ten_mon = trim($_POST['ten_mon']);
    $gia = $_POST['gia'];
    $hinh_anh = $_POST['hinh_anh'];
    $mo_ta = $_POST['mo_ta'];
    $ma_dm = $_POST['ma_dm'];
    $trang_thai = $_POST['trang_thai'];

    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM mon
        WHERE ten_mon='$ten_mon'
        AND ma_mon<>$ma_mon"
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "
        <script>
        alert('Tên món đã tồn tại');
        </script>
        ";
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE mon
            SET
                ten_mon='$ten_mon',
                gia='$gia',
                hinh_anh='$hinh_anh',
                mo_ta='$mo_ta',
                ma_dm='$ma_dm',
                trang_thai='$trang_thai'
            WHERE ma_mon=$ma_mon"
        );

        header("Location: trangchu.php?page=mon");
        exit();
    }
}
if(isset($_POST['them_nguyenlieu']))
{
    $ten_nl = trim($_POST['ten_nl']);
    $don_vi = $_POST['don_vi'];
    $muc_toi_thieu = $_POST['muc_toi_thieu'];

    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM kho_nguyen_lieu
        WHERE ten_nl='$ten_nl'"
    );

    if(mysqli_num_rows($check)>0)
    {
        echo "<script>alert('Nguyên liệu đã tồn tại');</script>";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO kho_nguyen_lieu
(
    ten_nl,
    don_vi,
    muc_toi_thieu
)
VALUES
(
    '$ten_nl',
    '$don_vi',
    '$muc_toi_thieu'
)"
        );

        header("Location: trangchu.php?page=kho");
        exit();
    }
}
if(isset($_GET['xoa_nl']))
{
    $ma_nl = (int)$_GET['xoa_nl'];
    $check = mysqli_query(
    $conn,
    "SELECT *
     FROM cong_thuc_mon
     WHERE ma_nl=$ma_nl"
);

if(mysqli_num_rows($check)>0)
{
    die("Nguyên liệu đang được sử dụng trong công thức món");
}
$checkTon = mysqli_query(
    $conn,
    "SELECT *
     FROM ton_kho_chi_nhanh
     WHERE ma_nl=$ma_nl"
);

if(mysqli_num_rows($checkTon)>0)
{
    die("Nguyên liệu đang tồn tại trong kho chi nhánh");
}
    mysqli_query(
        $conn,
        "DELETE FROM kho_nguyen_lieu
         WHERE ma_nl=$ma_nl"
    );

    header("Location: trangchu.php?page=kho");
    exit();
}
if(isset($_POST['capnhat_nguyenlieu']))
{
    $ma_nl = (int)$_POST['ma_nl'];

    $ten_nl = trim($_POST['ten_nl']);
    $don_vi = $_POST['don_vi'];
    $muc_toi_thieu = $_POST['muc_toi_thieu'];

    $check = mysqli_query(
        $conn,
        "SELECT *
         FROM kho_nguyen_lieu
         WHERE ten_nl='$ten_nl'
         AND ma_nl<>$ma_nl"
    );

    if(mysqli_num_rows($check)>0)
    {
        echo "<script>alert('Tên nguyên liệu đã tồn tại');</script>";
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE kho_nguyen_lieu
SET
    ten_nl='$ten_nl',
    don_vi='$don_vi',
    muc_toi_thieu='$muc_toi_thieu'
WHERE ma_nl=$ma_nl"
        );

        header("Location: trangchu.php?page=kho");
        exit();
    }
}
if(isset($_POST['them_congthuc']))
{
    $ma_mon = $_POST['ma_mon'];
    $ma_nl = $_POST['ma_nl'];
    $so_luong = $_POST['so_luong'];
    if($so_luong <= 0)
{
    die("Số lượng phải lớn hơn 0");
}
    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM cong_thuc_mon
        WHERE ma_mon='$ma_mon'
        AND ma_nl='$ma_nl'"
    );

    if(mysqli_num_rows($check)>0)
    {
        echo "<script>alert('Nguyên liệu đã tồn tại trong món này');</script>";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO cong_thuc_mon
            (
                ma_mon,
                ma_nl,
                so_luong
            )
            VALUES
            (
                '$ma_mon',
                '$ma_nl',
                '$so_luong'
            )"
        );

        header("Location: trangchu.php?page=congthuc");
        exit();
    }
}
if(isset($_GET['xoa_ct']))
{
    $ma_ct = (int)$_GET['xoa_ct'];

    mysqli_query(
        $conn,
        "DELETE FROM cong_thuc_mon
        WHERE ma_ct=$ma_ct"
    );

    header("Location: trangchu.php?page=congthuc");
    exit();
}
if(isset($_POST['capnhat_congthuc']))
{
    $ma_ct = (int)$_POST['ma_ct'];

    mysqli_query(
        $conn,
        "UPDATE cong_thuc_mon
        SET
            ma_mon='".$_POST['ma_mon']."',
            ma_nl='".$_POST['ma_nl']."',
            so_luong='".$_POST['so_luong']."'
        WHERE ma_ct=$ma_ct"
    );

    header("Location: trangchu.php?page=congthuc");
    exit();
}
if(isset($_POST['them_nhapkho']))
{
    $ma_cn   = (int)$_POST['ma_cn'];

    $ma_nl    = $_POST['ma_nl'];
    $so_luong = $_POST['so_luong'];
    $gia_nhap = $_POST['gia_nhap'];

    if(empty($ma_nl) || count($ma_nl) == 0)
    {
        die("Chưa chọn nguyên liệu");
    }

    $tong_tien = 0;

    // kiểm tra dữ liệu trước
    for($i=0; $i<count($ma_nl); $i++)
    {
        $sl  = (float)$so_luong[$i];
        $gia = (float)$gia_nhap[$i];

        if($sl <= 0)
            die("Số lượng phải > 0");

        if($gia <= 0)
            die("Giá nhập phải > 0");

        $tong_tien += $sl * $gia;
    }

    mysqli_begin_transaction($conn);

    try
    {
        // 1. TẠO PHIẾU NHẬP
        $sqlNhap = "
            INSERT INTO nhap_kho(ma_cn, ngay_nhap, tong_tien)
            VALUES('$ma_cn', NOW(), '$tong_tien')
        ";

        if(!mysqli_query($conn, $sqlNhap))
            throw new Exception(mysqli_error($conn));

        $ma_nhap = mysqli_insert_id($conn);
        $grouped = [];

for($i = 0; $i < count($ma_nl); $i++)
{
    $nl = (int)$ma_nl[$i];
    $sl = (float)$so_luong[$i];
    $gia = (float)$gia_nhap[$i];

    // nếu chưa có thì tạo
    if(!isset($grouped[$nl]))
    {
        $grouped[$nl] = [
            'so_luong' => 0,
            'gia_nhap' => $gia, // lấy giá đầu tiên
        ];
    }

    // gộp số lượng
    $grouped[$nl]['so_luong'] += $sl;
}
       foreach($grouped as $nl => $data)
{
    $sl = $data['so_luong'];
    $gia = $data['gia_nhap'];

    $thanh_tien = $sl * $gia;

    $sqlct = "
        INSERT INTO chi_tiet_nhap_kho
        (ma_nhap, ma_nl, so_luong, gia_nhap, thanh_tien)
        VALUES
        ('$ma_nhap','$nl','$sl','$gia','$thanh_tien')
    ";

    if(!mysqli_query($conn, $sqlct))
        throw new Exception(mysqli_error($conn));

    // update tồn kho
    mysqli_query($conn,
        "INSERT INTO ton_kho_chi_nhanh(ma_cn, ma_nl, so_luong)
         VALUES('$ma_cn','$nl','$sl')
         ON DUPLICATE KEY UPDATE so_luong = so_luong + $sl"
    );
}

        // 4. LOG
        if(isset($_SESSION['user_id']))
        {
            $user_id = (int)$_SESSION['user_id'];

            mysqli_query($conn,
                "INSERT INTO nhat_ky_he_thong
                (user_id, hanh_dong, bang_tac_dong, ma_ban_ghi, mo_ta)
                VALUES
                ('$user_id','Nhap kho','nhap_kho','$ma_nhap','Tạo phiếu nhập')"
            );
        }

        mysqli_commit($conn);

        header("Location: trangchu.php?page=nhapkho");
        exit();
    }
    catch(Exception $e)
    {
        mysqli_rollback($conn);
        die("Lỗi nhập kho: " . $e->getMessage());
    }
}
if(isset($_GET['xoa_nhap']))
{
    $ma_nhap = (int)$_GET['xoa_nhap'];

    mysqli_begin_transaction($conn);

    try
    {
        $phieu = mysqli_fetch_assoc(mysqli_query(
            $conn,
            "SELECT * FROM nhap_kho WHERE ma_nhap=$ma_nhap"
        ));

        if(!$phieu)
            throw new Exception("Không tìm thấy phiếu nhập");

        $ma_cn = $phieu['ma_cn'];

        $ct = mysqli_query(
            $conn,
            "SELECT * FROM chi_tiet_nhap_kho WHERE ma_nhap=$ma_nhap"
        );

        while($row = mysqli_fetch_assoc($ct))
        {
            $ma_nl = (int)$row['ma_nl'];
            $so_luong = (float)$row['so_luong'];

            $ton = mysqli_fetch_assoc(mysqli_query(
                $conn,
                "SELECT so_luong
                 FROM ton_kho_chi_nhanh
                 WHERE ma_cn=$ma_cn AND ma_nl=$ma_nl"
            ));

            $ton_hien_tai = $ton['so_luong'] ?? 0;

            if($ton_hien_tai < $so_luong)
            {
                throw new Exception("Không thể xóa vì nguyên liệu đã bị sử dụng");
            }

            mysqli_query($conn,
                "UPDATE ton_kho_chi_nhanh
                 SET so_luong = so_luong - $so_luong
                 WHERE ma_cn=$ma_cn AND ma_nl=$ma_nl"
            );
        }

        mysqli_query($conn,
            "DELETE FROM chi_tiet_nhap_kho WHERE ma_nhap=$ma_nhap"
        );

        mysqli_query($conn,
            "DELETE FROM nhap_kho WHERE ma_nhap=$ma_nhap"
        );

        mysqli_commit($conn);

        header("Location: trangchu.php?page=nhapkho");
        exit();
    }
    catch(Exception $e)
    {
        mysqli_rollback($conn);
        die("Lỗi xóa phiếu nhập: " . $e->getMessage());
    }
}
if(isset($_POST['them_xuatkho']))
{
    $ma_cn = (int)$_POST['ma_cn'];
    $ma_nv = (int)$_POST['ma_nv'];

    $ds_ma_nl = $_POST['ma_nl'];
    $ds_so_luong = $_POST['so_luong'];

    $ghi_chu = mysqli_real_escape_string(
        $conn,
        trim($_POST['ghi_chu'])
    );
    $nguyenLieuTongHop = [];

for($i = 0; $i < count($ds_ma_nl); $i++)
{
    $ma_nl = (int)$ds_ma_nl[$i];
    $so_luong = (float)$ds_so_luong[$i];

    if($so_luong <= 0)
    {
        throw new Exception(
            "Số lượng xuất phải lớn hơn 0"
        );
    }

    if(!isset($nguyenLieuTongHop[$ma_nl]))
    {
        $nguyenLieuTongHop[$ma_nl] = 0;
    }

    $nguyenLieuTongHop[$ma_nl] += $so_luong;
}
    mysqli_begin_transaction($conn);

    try
    {

      foreach($nguyenLieuTongHop as $ma_nl => $tong_so_luong)
{
    $tonKho = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM ton_kho_chi_nhanh
             WHERE ma_cn=$ma_cn
             AND ma_nl=$ma_nl
             FOR UPDATE"
        )
    );

    if(!$tonKho)
    {
        throw new Exception(
            "Nguyên liệu chưa có trong kho chi nhánh"
        );
    }

    if($tonKho['so_luong'] < $tong_so_luong)
    {
        throw new Exception(
            "Không đủ tồn kho cho nguyên liệu ID ".$ma_nl
        );
    }
}

        mysqli_query(
            $conn,
            "INSERT INTO xuat_kho
            (
                ma_cn,
                ma_nv,
                ghi_chu
            )
            VALUES
            (
                '$ma_cn',
                '$ma_nv',
                '$ghi_chu'
            )"
        );

        $ma_xuat = mysqli_insert_id($conn);

        foreach($nguyenLieuTongHop as $ma_nl => $tong_so_luong)
{
    mysqli_query(
        $conn,
        "INSERT INTO chi_tiet_xuat_kho
        (
            ma_xuat,
            ma_nl,
            so_luong
        )
        VALUES
        (
            '$ma_xuat',
            '$ma_nl',
            '$tong_so_luong'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE ton_kho_chi_nhanh
         SET so_luong =
             so_luong - $tong_so_luong
         WHERE ma_cn=$ma_cn
         AND ma_nl=$ma_nl"
    );
}
        if(isset($_SESSION['user_id']))
        {
            $user_id = (int)$_SESSION['user_id'];

            mysqli_query(
                $conn,
                "INSERT INTO nhat_ky_he_thong
                (
                    user_id,
                    hanh_dong,
                    bang_tac_dong,
                    ma_ban_ghi,
                    mo_ta
                )
                VALUES
                (
                    '$user_id',
                    'Xuat kho',
                    'xuat_kho',
                    '$ma_xuat',
                    'Tạo phiếu xuất kho'
                )"
            );
        }

        mysqli_commit($conn);

        echo "
        <script>
            alert('Xuất kho thành công');
            window.location='trangchu.php?page=xuatkho';
        </script>
        ";
        exit();
    }
    catch(Exception $e)
    {
        mysqli_rollback($conn);

        echo "
        <script>
            alert('".$e->getMessage()."');
            history.back();
        </script>
        ";
        exit();
    }
}
if(isset($_GET['xoa_xuat']))
{
    $ma_xuat = (int)$_GET['xoa_xuat'];

    mysqli_begin_transaction($conn);

    try
    {
        $phieu = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT *
                 FROM xuat_kho
                 WHERE ma_xuat=$ma_xuat"
            )
        );

        if(!$phieu)
        {
            throw new Exception(
                "Không tìm thấy phiếu xuất"
            );
        }

        $ma_cn = $phieu['ma_cn'];

        $ct = mysqli_query(
            $conn,
            "SELECT *
             FROM chi_tiet_xuat_kho
             WHERE ma_xuat=$ma_xuat"
        );

        while($row = mysqli_fetch_assoc($ct))
        {
            $ma_nl = $row['ma_nl'];
            $sl    = $row['so_luong'];

            mysqli_query(
                $conn,
                "UPDATE ton_kho_chi_nhanh
                 SET so_luong =
                     so_luong + $sl
                 WHERE ma_cn=$ma_cn
                 AND ma_nl=$ma_nl"
            );
        }

        mysqli_query(
            $conn,
            "DELETE FROM chi_tiet_xuat_kho
             WHERE ma_xuat=$ma_xuat"
        );

        mysqli_query(
            $conn,
            "DELETE FROM xuat_kho
             WHERE ma_xuat=$ma_xuat"
        );

        mysqli_commit($conn);

        header(
            "Location: trangchu.php?page=xuatkho"
        );
        exit();
    }
    catch(Exception $e)
    {
        mysqli_rollback($conn);

        die(
            "Lỗi xóa phiếu xuất: "
            .$e->getMessage()
        );
    }
}
if(isset($_POST['them_ban']))
{
    $ten_ban = trim($_POST['ten_ban']);
    $ma_cn = $_POST['ma_cn'];
    $trang_thai = $_POST['trang_thai'];

    $check = mysqli_query(
        $conn,
        "SELECT *
         FROM ban
         WHERE ten_ban='$ten_ban'
         AND ma_cn='$ma_cn'"
    );

    if(mysqli_num_rows($check)>0)
    {
        echo "<script>alert('Bàn đã tồn tại trong chi nhánh này');</script>";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO ban
            (
                ten_ban,
                ma_cn,
                trang_thai
            )
            VALUES
            (
                '$ten_ban',
                '$ma_cn',
                '$trang_thai'
            )"
        );

        header("Location: trangchu.php?page=ban");
        exit();
    }
}
if(isset($_GET['xoa_ban']))
{
    $ma_ban = (int)$_GET['xoa_ban'];

    $ban = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT trang_thai
             FROM ban
             WHERE ma_ban=$ma_ban"
        )
    );

    if(!$ban)
    {
        die("Bàn không tồn tại");
    }

    if($ban['trang_thai'] == 'Dang phuc vu')
    {
        die("Bàn đang có khách");
    }

    mysqli_query(
        $conn,
        "DELETE FROM ban
         WHERE ma_ban=$ma_ban"
    );

    header("Location: trangchu.php?page=ban");
    exit();
}
if(isset($_POST['capnhat_hd']))
{
    $ma_hd  = (int)$_POST['ma_hd'];

    $ten_kh = trim($_POST['ten_kh']);
    $sdt    = trim($_POST['sdt']);

    $ma_kh = "NULL";

    if($sdt != '')
    {
        $kh = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT *
                 FROM khach_hang
                 WHERE sdt='$sdt'
                 LIMIT 1"
            )
        );

        if($kh)
        {
            $ma_kh = $kh['ma_kh'];

            if($ten_kh != '')
            {
                mysqli_query(
                    $conn,
                    "UPDATE khach_hang
                     SET ten_kh='$ten_kh'
                     WHERE ma_kh=$ma_kh"
                );
            }
        }
        else
        {
            mysqli_query(
                $conn,
                "INSERT INTO khach_hang
                (
                    ten_kh,
                    sdt
                )
                VALUES
                (
                    '$ten_kh',
                    '$sdt'
                )"
            );

            $ma_kh = mysqli_insert_id($conn);
        }
    }

    mysqli_query(
        $conn,
        "UPDATE hoa_don
         SET ma_kh=".
         ($ma_kh == "NULL"
            ? "NULL"
            : $ma_kh)
         ."
         WHERE ma_hd=$ma_hd"
    );

   header(
    "Location: trangchu.php?page=hoadon&sua_hd=".$ma_hd
);
    exit();
}
if(isset($_POST['them_hoadon']))
{
    $ma_nv  = (int)$_POST['ma_nv'];
    $ma_ban = (int)$_POST['ma_ban'];
    $ma_cn = (int)$_POST['ma_cn'];
    $ten_kh = trim($_POST['ten_kh']);
    $sdt    = trim($_POST['sdt']);

    $ma_kh = "NULL";

    if($sdt != '')
    {
        $kh = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT *
                 FROM khach_hang
                 WHERE sdt='$sdt'"
            )
        );

        if($kh)
        {
            $ma_kh = $kh['ma_kh'];
        }
        else
        {
            mysqli_query(
                $conn,
                "INSERT INTO khach_hang
                (
                    ten_kh,
                    sdt
                )
                VALUES
                (
                    '$ten_kh',
                    '$sdt'
                )"
            );

            $ma_kh = mysqli_insert_id($conn);
        }
    }

    $ban = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM ban
             WHERE ma_ban=$ma_ban"
        )
    );

    if(!$ban)
    {
        die("Bàn không tồn tại");
    }

    if($ban['trang_thai']!='Trong')
    {
        die("Bàn hiện không khả dụng");
    }

    $ma_cn = $ban['ma_cn'];

    mysqli_query(
        $conn,
        "INSERT INTO hoa_don
        (
            ma_nv,
            ma_kh,
            ma_ban,
            ma_cn,
            tong_tien,
            thanh_toan,
            trang_thai
        )
        VALUES
        (
            $ma_nv,
            $ma_kh,
            $ma_ban,
             ".$ban['ma_cn'].",
            0,
            0,
            'Chua thanh toan'
        )"
    );

    $ma_hd = mysqli_insert_id($conn);

    mysqli_query(
        $conn,
        "UPDATE ban
         SET trang_thai='Dang phuc vu'
         WHERE ma_ban=$ma_ban"
    );

    header(
        "Location: trangchu.php?page=hoadon&ma_hd=$ma_hd"
    );
    exit();
}
if(isset($_GET['xoa_hd']))
{
    $ma_hd = (int)$_GET['xoa_hd'];

    mysqli_begin_transaction($conn);

    try
    {
        $hd = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT *
                 FROM hoa_don
                 WHERE ma_hd=$ma_hd"
            )
        );

        if(!$hd)
        {
            throw new Exception(
                "Không tìm thấy hóa đơn"
            );
        }

        if($hd['trang_thai'] == 'Da thanh toan')
        {
            throw new Exception(
                "Không thể xóa hóa đơn đã thanh toán"
            );
        }

        $cthd = mysqli_query(
            $conn,
            "SELECT *
             FROM chi_tiet_hoa_don
             WHERE ma_hd=$ma_hd"
        );

        while($item = mysqli_fetch_assoc($cthd))
        {
            $ma_mon = $item['ma_mon'];
            $sl_mon = $item['so_luong'];

            $ct = mysqli_query(
                $conn,
                "SELECT *
                 FROM cong_thuc_mon
                 WHERE ma_mon=$ma_mon"
            );

            while($nl = mysqli_fetch_assoc($ct))
            {
                $hoan =
                    $nl['so_luong']
                    * $sl_mon;

                mysqli_query(
                    $conn,
                    "UPDATE ton_kho_chi_nhanh
                     SET so_luong =
                         so_luong + $hoan
                     WHERE ma_cn=".$hd['ma_cn']."
                     AND ma_nl=".$nl['ma_nl']
                );
            }
        }

        mysqli_query(
            $conn,
            "DELETE FROM chi_tiet_hoa_don
             WHERE ma_hd=$ma_hd"
        );

        mysqli_query(
            $conn,
            "DELETE FROM hoa_don
             WHERE ma_hd=$ma_hd"
        );

        if(!empty($hd['ma_ban']))
        {
            mysqli_query(
                $conn,
                "UPDATE ban
                 SET trang_thai='Trong'
                 WHERE ma_ban=".$hd['ma_ban']
            );
        }

        mysqli_commit($conn);

        header(
            "Location: trangchu.php?page=hoadon"
        );
        exit();
    }
    catch(Exception $e)
    {
        mysqli_rollback($conn);

        die(
            $e->getMessage()
        );
    }
}
if(isset($_POST['them_mon_hd']))
{
    $ma_hd    = (int)$_POST['ma_hd'];
    $ma_mon   = (int)$_POST['ma_mon'];
    $ma_size  = (int)$_POST['ma_size'];
    $so_luong = (int)$_POST['so_luong'];
    $size = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT gia_them
         FROM size_mon
         WHERE ma_size=$ma_size"
    )
);
$mon = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT gia
         FROM mon
         WHERE ma_mon=$ma_mon"
    )
);
$don_gia =
    $mon['gia']
    +
    $size['gia_them'];
    if($so_luong <= 0)
    {
        echo "
        <script>
            alert('Số lượng phải lớn hơn 0');
            history.back();
        </script>
        ";
        exit();
    }

    $hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );
    $ma_cn = $hd['ma_cn'];
    if(!$hd)
    {
        die("Hóa đơn không tồn tại");
    }

    if($hd['trang_thai'] == 'Da thanh toan')
    {
        die("Hóa đơn đã thanh toán");
    }

    $ma_cn = (int)$hd['ma_cn'];

    $mon = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM mon
             WHERE ma_mon=$ma_mon"
        )
    );

    if(!$mon)
    {
        die("Món không tồn tại");
    }

    $size = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM size_mon
             WHERE ma_size=$ma_size"
        )
    );

    if(!$size)
    {
        die("Size không tồn tại");
    }

    /*
    ==================================================
    TÍNH GIÁ BÁN
    ==================================================
    */

    $don_gia =
        (float)$mon['gia']
        +
        (float)$size['gia_them'];

    $thanh_tien =
        $don_gia * $so_luong;

  /*
/*
==================================================
KIỂM TRA TỒN KHO CHI NHÁNH
==================================================
*/

$sqlKho = "
SELECT
    ct.ma_nl,
    ct.so_luong,
    nl.ten_nl,
    COALESCE(tk.so_luong,0) AS ton_kho
FROM cong_thuc_mon ct

INNER JOIN kho_nguyen_lieu nl
ON nl.ma_nl = ct.ma_nl

LEFT JOIN ton_kho_chi_nhanh tk
ON tk.ma_nl = ct.ma_nl
AND tk.ma_cn = $ma_cn

WHERE ct.ma_mon = $ma_mon
";

$checkKho = mysqli_query($conn, $sqlKho);

if(!$checkKho)
{
    die(
        'Lỗi kiểm tra tồn kho: '
        .mysqli_error($conn)
    );
}

if(mysqli_num_rows($checkKho) == 0)
{
    echo "
    <script>
        alert('Món chưa có công thức nguyên liệu');
        history.back();
    </script>
    ";
    exit();
}

$du_hang = true;
$nguyen_lieu_thieu = '';

while($nl = mysqli_fetch_assoc($checkKho))
{
    $can =
        (float)$nl['so_luong']
        *
        $so_luong;

    $ton_kho =
        (float)$nl['ton_kho'];

    if($ton_kho < $can)
    {
        $du_hang = false;
        $nguyen_lieu_thieu =
            $nl['ten_nl'];

        break;
    }
}

if(!$du_hang)
{
    echo "
    <script>
        alert(
            'Không đủ nguyên liệu: ".$nguyen_lieu_thieu."'
        );
        history.back();
    </script>
    ";
    exit();
}

/*
==================================================
TRỪ NGUYÊN LIỆU
==================================================
*/

$truKho = mysqli_query(
    $conn,
    $sqlKho
);

while($nl = mysqli_fetch_assoc($truKho))
{
    $can_tru =
        (float)$nl['so_luong']
        *
        $so_luong;

    mysqli_query(
        $conn,
        "UPDATE ton_kho_chi_nhanh
         SET so_luong =
            so_luong - $can_tru
         WHERE ma_cn = $ma_cn
         AND ma_nl = ".$nl['ma_nl']
    );
}

    /*
    ==================================================
    THÊM CHI TIẾT HÓA ĐƠN
    ==================================================
    */

    mysqli_query(
        $conn,
        "INSERT INTO chi_tiet_hoa_don
(
    ma_hd,
    ma_mon,
    ma_size,
    so_luong,
    don_gia,
    thanh_tien
)
        VALUES
        (
            '$ma_hd',
            '$ma_mon',
            '$ma_size',
            '$so_luong',
            '$don_gia',
            '$thanh_tien'
        )
        ON DUPLICATE KEY UPDATE
    so_luong = so_luong + VALUES(so_luong),
    thanh_tien = thanh_tien + VALUES(thanh_tien)"
    );

    /*
    ==================================================
    TRỪ TỒN KHO CHI NHÁNH
    ==================================================
    */

    $ct = mysqli_query(
        $conn,
        "SELECT *
         FROM cong_thuc_mon
         WHERE ma_mon=$ma_mon"
    );

    while($nl = mysqli_fetch_assoc($ct))
    {
        $tru =
            (float)$nl['so_luong']
            *
            $so_luong;

        $updateKho = mysqli_query(
    $conn,
    "UPDATE ton_kho_chi_nhanh
     SET so_luong = so_luong - $tru
     WHERE ma_cn = $ma_cn
     AND ma_nl = ".$nl['ma_nl']
);

if(!$updateKho)
{
    die(mysqli_error($conn));
}
    }

    /*
    ==================================================
    CẬP NHẬT TỔNG HÓA ĐƠN
    ==================================================
    */

    updateInvoiceTotal($conn,$ma_hd);

    /*
    ==================================================
    NHẬT KÝ HỆ THỐNG
    ==================================================
    */

    if(isset($_SESSION['user_id']))
    {
        $user_id = (int)$_SESSION['user_id'];

        mysqli_query(
            $conn,
            "INSERT INTO nhat_ky_he_thong
            (
                user_id,
                hanh_dong,
                bang_tac_dong,
                ma_ban_ghi,
                mo_ta,
                ip_address
            )
            VALUES
            (
                '$user_id',
                'Them mon',
                'chi_tiet_hoa_don',
                '$ma_hd',
                'Thêm món vào hóa đơn',
                '".$_SERVER['REMOTE_ADDR']."'
            )"
        );
    }

    header(
        "Location: trangchu.php?page=hoadon&ma_hd=$ma_hd"
    );

    exit();
}
if(isset($_GET['xoa_cthd']))
{
    $ma_cthd = (int)$_GET['xoa_cthd'];
    $ma_hd   = (int)$_GET['ma_hd'];

    $check_hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    if($check_hd['trang_thai']=='Da thanh toan')
    {
        die("Hóa đơn đã thanh toán");
    }

    $ma_cn = $check_hd['ma_cn'];

    $cthd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM chi_tiet_hoa_don
             WHERE ma_cthd=$ma_cthd"
        )
    );

    if(!$cthd)
    {
        die("Chi tiết hóa đơn không tồn tại");
    }

    $ma_mon = $cthd['ma_mon'];
    $sl     = $cthd['so_luong'];

    $ct = mysqli_query(
        $conn,
        "SELECT *
         FROM cong_thuc_mon
         WHERE ma_mon=$ma_mon"
    );
    $hd = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT ma_cn
         FROM hoa_don
         WHERE ma_hd=$ma_hd"
    )
);

$ma_cn = $hd['ma_cn'];
    while($nl = mysqli_fetch_assoc($ct))
    {
        $hoan = $nl['so_luong'] * $sl;

        mysqli_query(
            $conn,
            "UPDATE ton_kho_chi_nhanh
             SET so_luong = so_luong + $hoan
             WHERE ma_cn=$ma_cn
             AND ma_nl=".$nl['ma_nl']
        );
    }

    mysqli_query(
        $conn,
        "DELETE FROM chi_tiet_hoa_don
         WHERE ma_cthd=$ma_cthd"
    );

    updateInvoiceTotal($conn,$ma_hd);

    header(
        "Location: trangchu.php?page=hoadon&ma_hd=$ma_hd"
    );
    exit();
}
if(isset($_POST['capnhat_cthd']))
{
    $ma_cthd  = (int)$_POST['ma_cthd'];
    $ma_hd    = (int)$_POST['ma_hd'];
    $so_luong = (int)$_POST['so_luong'];
    $hd = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT ma_cn
         FROM hoa_don
         WHERE ma_hd=$ma_hd"
    )
);

$ma_cn = $hd['ma_cn'];
    // Không cho nhập <= 0
    if($so_luong <= 0)
    {
        echo "
        <script>
            alert('Số lượng phải lớn hơn 0');
            history.back();
        </script>
        ";
        exit();
    }

    // Kiểm tra hóa đơn đã thanh toán chưa
    $check_hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT trang_thai
             FROM hoa_don
             WHERE ma_hd = $ma_hd"
        )
    );

    if(!$check_hd)
    {
        die("Hóa đơn không tồn tại");
    }

    if($check_hd['trang_thai'] == 'Da thanh toan')
    {
        die("Hóa đơn đã thanh toán");
    }

    // Lấy chi tiết hóa đơn cũ
    $old = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM chi_tiet_hoa_don
             WHERE ma_cthd = $ma_cthd"
        )
    );

    if(!$old)
    {
        die("Chi tiết hóa đơn không tồn tại");
    }

    $sl_cu  = $old['so_luong'];
    $ma_mon = $old['ma_mon'];

    // Chênh lệch số lượng
    $chenh = $so_luong - $sl_cu;

    // Nếu tăng số lượng
    if($chenh > 0)
    {
        $ct = mysqli_query(
            $conn,
            "SELECT *
             FROM cong_thuc_mon
             WHERE ma_mon = $ma_mon"
        );

        while($nl = mysqli_fetch_assoc($ct))
        {
            $ma_nl = $nl['ma_nl'];

            $kho = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT so_luong
         FROM ton_kho_chi_nhanh
         WHERE ma_nl = $ma_nl
         AND ma_cn = $ma_cn"
    )
);

            $tru = $nl['so_luong'] * $chenh;

            if($kho['so_luong'] < $tru)
            {
                echo "
                <script>
                    alert('Không đủ nguyên liệu');
                    history.back();
                </script>
                ";
                exit();
            }

            mysqli_query(
    $conn,
    "UPDATE ton_kho_chi_nhanh
     SET so_luong = so_luong - $tru
     WHERE ma_nl = $ma_nl
     AND ma_cn = $ma_cn"
);
        }
    }
if($chenh < 0)
{
    $ct = mysqli_query(
        $conn,
        "SELECT *
         FROM cong_thuc_mon
         WHERE ma_mon = $ma_mon"
    );

    while($nl = mysqli_fetch_assoc($ct))
    {
        $cong =
            $nl['so_luong']
            * abs($chenh);

        mysqli_query(
            $conn,
            "UPDATE ton_kho_chi_nhanh
             SET so_luong = so_luong + $cong
             WHERE ma_nl=".$nl['ma_nl']."
             AND ma_cn=$ma_cn"
        );
    }
}
    $thanh_tien =
        $old['don_gia']
        * $so_luong;

    mysqli_query(
        $conn,
        "UPDATE chi_tiet_hoa_don
         SET
            so_luong = '$so_luong',
            thanh_tien = '$thanh_tien'
         WHERE ma_cthd = $ma_cthd"
    );

    updateInvoiceTotal($conn, $ma_hd);

    header(
        "Location: trangchu.php?page=hoadon&ma_hd=".$ma_hd
    );
    exit();
}
if(isset($_POST['them_voucher']))
{
    $ten_voucher   = trim($_POST['ten_voucher']);
    $gia_tri       = (float)$_POST['gia_tri'];
    $ngay_bat_dau = $_POST['ngay_bat_dau'];
    $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
    $so_luong      = (int)$_POST['so_luong'];

    // Kiểm tra dữ liệu
    if(
        empty($ten_voucher) ||
        $gia_tri <= 0 ||
        $so_luong <= 0
    )
    {
        echo "
        <script>
            alert('Dữ liệu không hợp lệ');
            history.back();
        </script>
        ";
        exit();
    }

    // Kiểm tra ngày
    if(strtotime($ngay_bat_dau) > strtotime($ngay_ket_thuc))
    {
        echo "
        <script>
            alert('Ngày bắt đầu không được lớn hơn ngày kết thúc');
            history.back();
        </script>
        ";
        exit();
    }

    // Kiểm tra trùng tên
    $check = mysqli_query(
        $conn,
        "SELECT *
         FROM voucher
         WHERE ten_voucher='$ten_voucher'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "
        <script>
            alert('Tên voucher đã tồn tại');
            history.back();
        </script>
        ";
        exit();
    }

    mysqli_query(
        $conn,
        "INSERT INTO voucher
        (
            ten_voucher,
            gia_tri,
            ngay_bat_dau,
            ngay_ket_thuc,
            so_luong
        )
        VALUES
        (
            '$ten_voucher',
            '$gia_tri',
            '$ngay_bat_dau',
            '$ngay_ket_thuc',
            '$so_luong'
        )"
    );

    header("Location: trangchu.php?page=voucher");
    exit();
}
if(isset($_POST['capnhat_voucher']))
{
    $ma_voucher = $_POST['ma_voucher'];

    $ten_voucher = $_POST['ten_voucher'];
    $gia_tri = $_POST['gia_tri'];
    $ngay_bat_dau = $_POST['ngay_bat_dau'];
    $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
    $so_luong = $_POST['so_luong'];
    $trang_thai = $_POST['trang_thai'];

    mysqli_query(
        $conn,
        "UPDATE voucher
         SET
            ten_voucher='$ten_voucher',
            gia_tri='$gia_tri',
            ngay_bat_dau='$ngay_bat_dau',
            ngay_ket_thuc='$ngay_ket_thuc',
            so_luong='$so_luong',
            trang_thai='$trang_thai'
         WHERE ma_voucher='$ma_voucher'"
    );

    header("Location: trangchu.php?page=voucher");
    exit();
}
if(isset($_GET['xoa_voucher']))
{
    $ma_voucher = (int)$_GET['xoa_voucher'];

    mysqli_query(
        $conn,
        "DELETE
         FROM voucher
         WHERE ma_voucher=$ma_voucher"
    );

    header("Location: trangchu.php?page=voucher");
    exit();
}
// =====================================
// DASHBOARD
// =====================================

$doanh_thu_hom_nay = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT IFNULL(SUM(thanh_toan),0) tong
         FROM hoa_don
         WHERE DATE(ngay_lap)=CURDATE()
         AND trang_thai='Da thanh toan'"
    )
);

$doanh_thu_thang = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT IFNULL(SUM(thanh_toan),0) tong
         FROM hoa_don
         WHERE MONTH(ngay_lap)=MONTH(CURDATE())
         AND YEAR(ngay_lap)=YEAR(CURDATE())
         AND trang_thai='Da thanh toan'"
    )
);

$so_hd = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) tong
         FROM hoa_don"
    )
);

$hoadon_homnay = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) tong
         FROM hoa_don
         WHERE DATE(ngay_lap)=CURDATE()"
    )
);

$so_kh = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) tong
         FROM khach_hang"
    )
);

$so_nv = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) tong
         FROM nhan_vien"
    )
);

$so_mon = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) tong
         FROM mon
         WHERE trang_thai='Con ban'"
    )
);
$nl_sap_het = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(DISTINCT k.ma_nl) tong
         FROM kho_nguyen_lieu k
         INNER JOIN ton_kho_chi_nhanh t
            ON k.ma_nl = t.ma_nl
         WHERE t.so_luong <= k.muc_toi_thieu"
    )
);

$top_mon = mysqli_query(
    $conn,
    "SELECT
        m.ten_mon,
        SUM(ct.so_luong) tong_ban
     FROM chi_tiet_hoa_don ct

     INNER JOIN mon m
        ON ct.ma_mon = m.ma_mon

     INNER JOIN hoa_don hd
        ON ct.ma_hd = hd.ma_hd

     WHERE hd.trang_thai='Da thanh toan'

     GROUP BY ct.ma_mon

     ORDER BY tong_ban DESC

     LIMIT 5"
);

$nguyen_lieu_sap_het = $sql = mysqli_query(
    $conn,
    "SELECT
        k.ten_nl,
        k.don_vi,
        k.muc_toi_thieu,
        SUM(t.so_luong) AS so_luong
     FROM kho_nguyen_lieu k
     INNER JOIN ton_kho_chi_nhanh t
        ON k.ma_nl = t.ma_nl
     GROUP BY k.ma_nl
     HAVING so_luong <= k.muc_toi_thieu
     ORDER BY so_luong ASC"
);

include "view.php";
mysqli_report(
    MYSQLI_REPORT_ERROR |
    MYSQLI_REPORT_STRICT
);
?>
