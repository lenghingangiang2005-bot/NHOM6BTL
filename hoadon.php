<?php

switch($page)
{
 case 'hoadon':
echo "<h1>QUẢN LÝ HÓA ĐƠN</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-hoadon{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.hoadon-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.form-card{
    width:420px;
    position:sticky;
    top:20px;
}

.table-card{
    flex:1;
    overflow:auto;
}
.form-card h2,
.table-card h2{
    margin-top:0;
    margin-bottom:20px;
    padding-bottom:12px;

    border-bottom:1px solid #e9ecef;

    color:#212529;
    font-size:20px;
    font-weight:600;
}

.form-group{
    margin-bottom:15px;
}
.form-group label{
    display:block;
    margin-bottom:6px;

    font-size:14px;
    font-weight:600;

    color:#555;
}
.form-control{
    width:100%;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;

    font-size:14px;
    font-family:inherit;
}
.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn-group > *{
    flex:1;
}

.btn-submit,
.btn-refresh{
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:8px;

    font-size:14px;
    font-weight:600;
    text-decoration:none;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}
.btn-submit{
    width:100%;
    border:none;
    background:#0d6efd;
    color:#fff;
    cursor:pointer;
}
.btn-submit:hover{
    background:#0b5ed7;
}
.table-hoadon{
    width:100%;
    border-collapse:collapse;
    min-width:1000px;
    font-size:14px;
}
.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}
.table-hoadon th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-hoadon td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;

    font-size:14px;
}

.table-hoadon tr:hover{
    background:#f8f9fa;
}
.badge-paid,
.badge-pending{
    font-size:12px;
    font-weight:600;
}
.btn-view{
    color:#0d6efd;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

@media(max-width:1200px){

    .hoadon-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}
.btn-edit{
    background:#198754;
    color:#fff;

    border:none;
    border-radius:6px;

    padding:8px 12px;

    font-size:13px;
    font-weight:600;

    cursor:pointer;
}
.btn-delete{
    color:#dc3545;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}
.dashboard-box{
    background:#fff;
    border-radius:12px;
    padding:20px;
    margin-top:20px;

    box-shadow:0 4px 12px rgba(0,0,0,.1);
}
.btn-payment{
    display:inline-flex;
    width:auto;

    padding:0 25px;
}
.badge-paid{
    color:#198754;
}

.badge-pending{
    color:#fd7e14;
}
/* =========================
   POPUP
========================= */

.modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);

    display:flex;
    justify-content:center;
    align-items:flex-start;

    overflow:auto;

    padding:40px 20px;

    z-index:9999;
}

.modal-content{
    width:95%;
    max-width:1200px;

    background:#fff;

    border-radius:14px;

    padding:25px;

    position:relative;

    box-shadow:
    0 10px 30px rgba(0,0,0,.25);
}

.modal-sm{
    max-width:600px;
}

.modal-header{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:20px;
    padding-bottom:15px;

    border-bottom:1px solid #eee;
}

.modal-title{
    font-size:22px;
    font-weight:700;
    color:#212529;
}

.modal-close{
    width:38px;
    height:38px;

    border:none;
    border-radius:50%;

    background:#dc3545;
    color:#fff;

    cursor:pointer;

    font-size:18px;
    font-weight:bold;
}

.modal-close:hover{
    background:#bb2d3b;
}

.modal-body{
    margin-top:10px;
}

.modal-grid{
    display:grid;
    grid-template-columns:350px 1fr;
    gap:20px;
}

@media(max-width:1000px)
{
    .modal-grid{
        grid-template-columns:1fr;
    }
}

/* =========================
   NÚT
========================= */

.btn-action{
    display:inline-block;

    padding:8px 14px;

    border-radius:6px;

    text-decoration:none;

    font-size:13px;
    font-weight:600;
}

.btn-open{
    background:#0d6efd;
    color:#fff;
}

.btn-open:hover{
    background:#0b5ed7;
}

.btn-edit-hd{
    background:#198754;
    color:#fff;
}

.btn-edit-hd:hover{
    background:#157347;
}

/* =========================
   TỔNG TIỀN
========================= */

.total-box{
    margin-top:20px;

    background:#f8f9fa;

    border-radius:10px;

    padding:20px;

    border:1px solid #dee2e6;
}

.total-line{
    display:flex;
    justify-content:space-between;

    margin-bottom:10px;
}

.total-line strong{
    color:#212529;
}

.total-final{
    font-size:22px;
    font-weight:700;
    color:#198754;
}
/* =========================
   FIX POPUP
========================= */

.modal .form-card{
    width:100%;
    position:static;
    top:auto;
    margin:0;
}

.modal .table-card{
    width:100%;
    overflow-x:auto;
}

.modal .table-hoadon{
    min-width:700px;
}
</style>
<div class="page-hoadon">
<div class="hoadon-wrapper">

<div class="form-card">

<h2>Tạo hóa đơn mới</h2>

<form method="POST">
<div class="form-group">

<label>Chi nhánh</label>

<select
name="ma_cn"
id="ma_cn"
class="form-control"
required>

<option value="">-- Chọn chi nhánh --</option>

<?php

$cn = mysqli_query(
    $conn,
    "SELECT *
     FROM chi_nhanh
     ORDER BY ten_cn"
);

while($row = mysqli_fetch_assoc($cn))
{
?>

<option value="<?php echo $row['ma_cn']; ?>">
    <?php echo $row['ten_cn']; ?>
</option>

<?php
}
?>

</select>

</div>
<div class="form-group">

<label>Nhân viên</label>

<select
name="ma_nv"
class="form-control"
required>

<?php
$cn_default = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT ma_cn
         FROM chi_nhanh
         LIMIT 1"
    )
);

$ma_cn_chon =
isset($_POST['ma_cn'])
?
(int)$_POST['ma_cn']
:
(int)$cn_default['ma_cn'];
$nv = mysqli_query(
    $conn,
    "SELECT *
     FROM nhan_vien
     WHERE ma_cn=$ma_cn_chon
     ORDER BY ten_nv"
);

while($row = mysqli_fetch_assoc($nv))
{
?>

<option value="<?php echo $row['ma_nv']; ?>">
    <?php echo $row['ten_nv']; ?>
</option>

<?php
}
?>

</select>

</div>


<div class="form-group">

<label>Tên khách hàng</label>

<input
type="text"
name="ten_kh"
class="form-control"
placeholder="Nhập tên khách">

</div>

<div class="form-group">

<label>Số điện thoại</label>

<input
type="text"
name="sdt"
class="form-control"
placeholder="Nhập số điện thoại">

</div>

<div class="form-group">

<label>Bàn</label>

<select
name="ma_ban"
class="form-control"
required>

<?php
$ban = mysqli_query(
    $conn,
    "SELECT *
     FROM ban
     WHERE ma_cn=$ma_cn_chon
     AND trang_thai='Trong'
     ORDER BY ten_ban"
);

if(mysqli_num_rows($ban)==0)
{
    echo "<option value=''>Không còn bàn trống</option>";
}

while($row = mysqli_fetch_assoc($ban))
{
?>

<option value="<?php echo $row['ma_ban']; ?>">
    <?php echo $row['ten_ban']; ?>
</option>

<?php
}
?>

</select>

</div>
<div class="btn-group">

    <button
    type="submit"
    name="them_hoadon"
    class="btn-submit">
        Tạo hóa đơn
    </button>

    <a
    href="?page=hoadon"
    class="btn-refresh">
        Làm mới
    </a>

</div>

</form>

</div>

<div class="table-card">

<h2>Danh sách hóa đơn</h2>

<?php

$ds_hd = mysqli_query(
    $conn,
    "SELECT
        hd.*,
        nv.ten_nv,
        kh.ten_kh,
        b.ten_ban
    FROM hoa_don hd

    JOIN nhan_vien nv
    ON hd.ma_nv = nv.ma_nv

    LEFT JOIN khach_hang kh
    ON hd.ma_kh = kh.ma_kh

    LEFT JOIN ban b
    ON hd.ma_ban = b.ma_ban

    ORDER BY hd.ma_hd DESC"
);

echo "

<table class='table-hoadon'>
<tr>
<th>Mã HD</th>
<th>Ngày lập</th>
<th>Nhân viên</th>
<th>Khách hàng</th>
<th>Bàn</th>
<th>Trạng thái</th>
<th>Tổng tiền</th>
<th>Mở</th>
<th>Sửa</th>
<th>Xóa</th>
</tr>

";
while($row = mysqli_fetch_assoc($ds_hd))
{
    echo "
    <tr>

        <td>".$row['ma_hd']."</td>

        <td>".$row['ngay_lap']."</td>

        <td>".$row['ten_nv']."</td>

        <td>".
            (!empty($row['ten_kh'])
                ? $row['ten_kh']
                : 'Khách lẻ')
        ."</td>

        <td>".($row['ten_ban'] ?? '')."</td>

        <td>";

    if($row['trang_thai'] == "Da thanh toan")
    {
        echo "<span class='badge-paid'>Đã thanh toán</span>";
    }
    else
    {
        echo "<span class='badge-pending'>Chờ thanh toán</span>";
    }

 echo "</td>

<td>"
.number_format($row['tong_tien'])
." đ</td>

<td>

<a
class='btn-action btn-open'
href='?page=hoadon&ma_hd=".$row['ma_hd']."'>
Chi tiết
</a>

</td>

<td>
";

if($row['trang_thai'] == 'Chua thanh toan')
{
    echo "
    <a
    class='btn-action btn-edit-hd'
    href='?page=hoadon&sua_hd=".$row['ma_hd']."'>
    ✏ Sửa
    </a>
    ";
}
else
{
    echo "-";
}

echo "
</td>

<td>
";

    if($row['trang_thai'] == 'Chua thanh toan')
    {
        echo "
            <a
            class='btn-delete'
            onclick=\"return confirm('Xóa hóa đơn này?')\"
            href='?page=hoadon&xoa_hd=".$row['ma_hd']."'>
            🗑 Xóa
            </a>
        ";
    }
    else
    {
        echo "-";
    }

    echo "
        </td>

    </tr>
    ";
}
echo "</table>";

?>

</div>

</div>

<?php
if(isset($_GET['ma_hd']))
{
    $ma_hd = (int)$_GET['ma_hd'];

    $hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT
                hd.*,
                v.ten_voucher
             FROM hoa_don hd
             LEFT JOIN voucher v
                ON hd.ma_voucher = v.ma_voucher
             WHERE hd.ma_hd=$ma_hd"
        )
    );

    if(!$hd)
    {
        echo "<script>alert('Hóa đơn không tồn tại');</script>";
        break;
    }
    $da_thanhtoan =
    (
        $hd['trang_thai']
        == 'Da thanh toan'
    );
    $preview_giam = 0;
$preview_tt   = $hd['tong_tien'];

$voucher_chon =
    isset($_GET['ma_voucher'])
    ? (int)$_GET['ma_voucher']
    : 0;

if(
    $voucher_chon > 0
    &&
    $hd['trang_thai']=='Chua thanh toan'
)
{
    $vc = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM voucher
             WHERE ma_voucher=$voucher_chon
             AND trang_thai='Hoat dong'"
        )
    );

    if($vc)
    {
        if(
            $hd['tong_tien']
            >=
            $vc['don_hang_toi_thieu']
        )
        {
            if($vc['loai_giam']=='Tien')
            {
                $preview_giam =
                    $vc['gia_tri'];
            }
            else
            {
                $preview_giam =
                    $hd['tong_tien']
                    *
                    $vc['gia_tri']
                    / 100;
            }

            if(
                $preview_giam
                >
                $hd['tong_tien']
            )
            {
                $preview_giam =
                    $hd['tong_tien'];
            }

            $preview_tt =
                $hd['tong_tien']
                -
                $preview_giam;
        }
    }
}
?>

<div class="modal">

<div class="modal-content">

<div class="modal-header">

<div class="modal-title">
Chi tiết hóa đơn #<?php echo $ma_hd; ?>
</div>

<a
href="?page=hoadon"
class="modal-close"
style="
display:flex;
align-items:center;
justify-content:center;
text-decoration:none;
">
×
</a>

</div>

<div class="modal-body">

<div class="modal-grid">
    <div class="form-card">

    <form method="POST">

        <input
        type="hidden"
        name="ma_hd"
        value="<?php echo $ma_hd; ?>">

        <div class="form-group">

            <label>Chọn món</label>

            <select
            name="ma_mon"
            class="form-control">

                <?php

                $mon = mysqli_query(
                    $conn,
                    "SELECT *
                     FROM mon
                     WHERE trang_thai='Con ban'
                     ORDER BY ten_mon"
                );

                while($m = mysqli_fetch_assoc($mon))
                {
                ?>

                <option
                value="<?php echo $m['ma_mon']; ?>">

                    <?php
                    echo $m['ten_mon'];
                    ?>
                    -
                    <?php
                    echo number_format($m['gia']);
                    ?> đ

                </option>

                <?php
                }
                ?>

            </select>

        </div>
    <div class="form-group">

<label>Size</label>

<select
name="ma_size"
class="form-control">

<?php

$size = mysqli_query(
    $conn,
    "SELECT *
     FROM size_mon
     ORDER BY gia_them"
);
while($s = mysqli_fetch_assoc($size))
{
?>

<option
value="<?php echo $s['ma_size']; ?>">

<?php
echo $s['ten_size'];
?>

(+<?php
echo number_format(
    $s['gia_them']
);
?>đ)

</option>

<?php
}

?>

</select>


</div>

        <div class="form-group">

            <label>Số lượng</label>

            <input
            type="number"
            name="so_luong"
            value="1"
            min="1"
            class="form-control"
            required>

        </div>

        <button
type="submit"
name="them_mon_hd"
class="btn-submit"
<?php if($da_thanhtoan) echo "disabled"; ?>>

            Thêm món

        </button>

    </form>

</div>

<div class="table-card">

<h2>Chi tiết hóa đơn</h2>

<table class="table-hoadon">

<tr>
<th>Món</th>
<th>Size</th>
<th>Số lượng</th>
<th>Đơn giá</th>
<th>Thành tiền</th>
<th>Xóa</th>

</tr>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT
    ct.*,
    m.ten_mon,
    s.ten_size
FROM chi_tiet_hoa_don ct

JOIN mon m
ON ct.ma_mon = m.ma_mon

LEFT JOIN size_mon s
ON ct.ma_size = s.ma_size

WHERE ct.ma_hd=$ma_hd"
);

while($row = mysqli_fetch_assoc($sql))
{
?>

<tr>

<td><?php echo $row['ten_mon']; ?></td>
<td><?php echo $row['ten_size']; ?></td>

<td><?php echo (int)$row['so_luong']; ?></td>

<td><?php echo number_format($row['don_gia']); ?> đ</td>

<td><?php echo number_format($row['thanh_tien']); ?> đ</td>

<td>

<?php
if(!$da_thanhtoan)
{
?>
<a
class="btn-delete"
onclick="return confirm('Xóa món này?')"
href="?page=hoadon&ma_hd=<?php echo $ma_hd; ?>&xoa_cthd=<?php echo $row['ma_cthd']; ?>">
Xóa
</a>
<?php
}
?>

</td>

</tr>

<?php
}
?>

</table>
</div>
</div>

<div class="dashboard-box">


<?php
if($hd['trang_thai']=='Da thanh toan'
   && !empty($hd['ma_voucher']))
{
?>
<div style="
margin-bottom:10px;
padding:10px;
background:#fff3cd;
border:1px solid #ffe69c;
border-radius:8px;
">

<b>Voucher:</b>
<?php echo $hd['ten_voucher']; ?>

<br>

<b>Giảm:</b>
<?php echo number_format($hd['tien_giam']); ?> đ

</div>
<?php
}
?>
<?php
$hien_giam =
(float)($hd['tien_giam'] ?? 0);

$hien_tt =
(
    $hd['thanh_toan'] > 0
)
?
$hd['thanh_toan']
:
$hd['tong_tien'];

?>

<div class="total-box">

    <div class="total-line">
        <span>Tổng tiền:</span>
        <strong>
            <?php echo number_format($hd['tong_tien']); ?> đ
        </strong>
    </div>

    <div class="total-line" style="color:#dc3545;">
        <span>Giảm giá:</span>
        <strong>
            -<?php echo number_format($hien_giam); ?> đ
        </strong>
    </div>

    <hr>

    <div class="total-line total-final">
        <span>Thanh toán:</span>
        <strong>
            <?php echo number_format($hien_tt); ?> đ
        </strong>
    </div>

</div>
<?php

if($hd['trang_thai']=='Chua thanh toan')
{
?>
<div class="payment-card">

<form method="POST">

<input type="hidden" name="page" value="hoadon">
<input type="hidden" name="ma_hd" value="<?php echo $ma_hd; ?>">

    <div class="form-group">

       <label>Voucher</label>

<select
name="ma_voucher"
class="form-control">

<option value="">
Không dùng voucher
</option>

<?php

$listVoucher = mysqli_query(
    $conn,
    "SELECT *
     FROM voucher
     WHERE trang_thai='Hoat dong'
     AND so_luong > 0
     ORDER BY ten_voucher"
);

while($v = mysqli_fetch_assoc($listVoucher))
{
?>

<option
value="<?php echo $v['ma_voucher']; ?>">

<?php echo $v['ten_voucher']; ?>

</option>

<?php
}
?>

</select>
    </div>

    <div class="form-group">

        <label>Phương thức thanh toán</label>

        <select
        name="phuong_thuc_tt"
        class="form-control">

            <option value="Tien mat">
                Tiền mặt
            </option>

            <option value="Chuyen khoan">
                Chuyển khoản
            </option>

            <option value="The">
                Thẻ
            </option>

        </select>

    </div>

    <button
    type="submit"
    name="thanhtoan"
    class="btn-submit btn-payment"
    onclick="return confirm('Xác nhận thanh toán?')">

        Thanh toán

    </button>

</form>
</div>
<?php
}
else
{
?>

<div style="
padding:15px;
background:#d1e7dd;
border:1px solid #badbcc;
color:#0f5132;
border-radius:10px;
font-weight:bold;
display:inline-block;
">
✔ Đã thanh toán
</div>

<?php
}
?>
</div>
</div> <!-- modal-body -->

</div> <!-- modal-content -->

</div> <!-- modal -->

<?php
}
?>

<?php
if(isset($_GET['sua_hd']))
{
    $ma_hd = (int)$_GET['sua_hd'];

    $hd = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM hoa_don
             WHERE ma_hd=$ma_hd"
        )
    );

    // Không tìm thấy hóa đơn
    if(!$hd)
    {
        echo "<script>alert('Hóa đơn không tồn tại');</script>";
        break;
    }

    // Không cho sửa hóa đơn đã thanh toán
    if($hd['trang_thai'] == 'Da thanh toan')
    {
        echo "<script>alert('Không thể sửa hóa đơn đã thanh toán');</script>";
        break;
    }
?>

<div class="modal">

<div class="modal-content modal-sm">

<div class="modal-header">

<div class="modal-title">
Sửa hóa đơn #<?php echo $ma_hd; ?>
</div>

<a
href="?page=hoadon"
class="modal-close"
style="
display:flex;
align-items:center;
justify-content:center;
text-decoration:none;
">
×
</a>

</div>

<div class="modal-body">

<form method="POST">
<input
type="hidden"
name="ma_hd"
value="<?php echo $hd['ma_hd']; ?>">

<?php

$kh = null;
if(!empty($hd['ma_kh']))
{
    $kh = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM khach_hang
             WHERE ma_kh=".$hd['ma_kh']
        )
    );

    if(!$kh)
    {
        $kh = [];
    }
}

?>

<div class="form-group">

<label>Tên khách hàng</label>

<input
type="text"
name="ten_kh"
class="form-control"
value="<?php echo $kh['ten_kh'] ?? ''; ?>">

</div>

<div class="form-group">

<label>Số điện thoại</label>

<input
type="text"
name="sdt"
class="form-control"
value="<?php echo $kh['sdt'] ?? ''; ?>">

</div>


<button
type="submit"
name="capnhat_hd"
class="btn-submit">

Lưu thay đổi

</button>
</div>
</form>
</div> <!-- modal-body -->

</div> <!-- modal-content -->

</div> <!-- modal -->

<?php
}
break;
}
?>