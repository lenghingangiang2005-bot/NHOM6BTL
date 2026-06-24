<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cafe Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
</head>

<body>
    <style>
#stage {
  position: fixed;
  inset: 0;
  pointer-events: none;
  z-index: 999998; /* nằm trên toàn bộ dashboard */
}

.coffee {
  position: absolute;
  font-size: 18px;
  transform: translate(0,0) scale(0.5);
  animation: boom 0.7s ease-out forwards;

  z-index: 999999;          /* luôn nổi trên cùng */
  filter: contrast(1.6) saturate(1.8); /* làm màu đậm hơn */
  text-shadow: 0 2px 6px rgba(0,0,0,0.35); /* giúp rõ nét hơn */
}

@keyframes boom {
  0% {
    opacity: 1;
    transform: translate(0,0) scale(0.5);
  }
  100% {
    opacity: 0;
    transform: translate(var(--x), var(--y)) scale(1.4);
  }
}
    </style>
<div id="stage"></div>

<script>
document.addEventListener("click", function (e) {
    const stage = document.getElementById("stage");

    const count = 20; // số hạt pháo hoa

    for (let i = 0; i < count; i++) {
        const spark = document.createElement("div");
        spark.className = "coffee";
        spark.innerHTML = "☕";

        spark.style.left = e.clientX + "px";
        spark.style.top = e.clientY + "px";

        // hướng bay ngẫu nhiên 360°
        const angle = Math.random() * 2 * Math.PI;
        const distance = 40 + Math.random() * 100;

        const x = Math.cos(angle) * distance;
        const y = Math.sin(angle) * distance;

        spark.style.setProperty("--x", x + "px");
        spark.style.setProperty("--y", y + "px");

        stage.appendChild(spark);

        setTimeout(() => {
            spark.remove();
        }, 700);
    }
});
</script>
<div class="sidebar">

    <h2>BLOOM CAFÉ</h2>

    <!-- ADMIN -->
    <?php if($userRole == 'admin'): ?>

        <a href="?page=dashboard">Dashboard</a>

        <a href="?page=hoadon">Hóa đơn</a>

        <a href="?page=ban">Bàn</a>

        <a href="?page=khachhang">Khách hàng</a>

        <a href="?page=mon">Món</a>

        <a href="?page=danhmuc">Danh mục</a>

        <a href="?page=chinhanh">Chi nhánh</a>

        <a href="?page=nhanvien">Nhân viên</a>

        <a href="?page=kho">Kho nguyên liệu tổng</a>

        <a href="?page=tonkho">Kho chi nhánh</a>

        <a href="?page=congthuc">Công thức món</a>

        <a href="?page=nhapkho">Nhập kho</a>

        <a href="?page=xuatkho">Xuất kho</a>

        <a href="?page=voucher">Voucher</a>

    <?php endif; ?>


    <!-- MANAGER -->
    <?php if($userRole == 'manager'): ?>

        <a href="?page=dashboard">Dashboard</a>

        <a href="?page=hoadon">Hóa đơn</a>

        <a href="?page=khachhang">Khách hàng</a>

        <a href="?page=nhanvien">Nhân viên</a>

        <a href="?page=nhapkho">Nhập kho</a>

        <a href="?page=xuatkho">Xuất kho</a>

        <a href="?page=ban">Bàn</a>

        <a href="?page=mon">Món</a>

        <a href="?page=danhmuc">Danh mục</a>

        <a href="?page=congthuc">Công thức món</a>

        <a href="?page=voucher">Voucher</a>

        <a href="?page=tonkho">Kho chi nhánh</a>

    <?php endif; ?>


    <!-- STAFF -->
    <?php if($userRole == 'staff'): ?>

        <a href="?page=hoadon">Hóa đơn</a>

        <a href="?page=ban">Bàn</a>

        <a href="?page=mon">Món</a>

        <a href="?page=danhmuc">Danh mục</a>

        <a href="?page=congthuc">Công thức món</a>

        <a href="?page=voucher">Voucher</a>

    <?php endif; ?>


    <!-- CUSTOMER -->
    <?php if($userRole == 'customer'): ?>

        <a href="?page=mon">Món</a>

    <?php endif; ?>


    <!-- Đăng xuất -->
    <a href="logout.php">Đăng xuất</a>

</div>
<div class="content">
<?php

switch($page)
{
    case 'dashboard':

?>
<style>
    body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-dashboard{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.dashboard-cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}
.card{
    position:relative;
    background:#fff;
    border-radius:14px;
    padding:22px;
    overflow:visible !important;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    transition:all .3s ease;
    border-left:5px solid #0d6efd;
}
.card:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 24px rgba(0,0,0,.12);
}

.card-icon{
    position:absolute;
    right:18px;
    top:18px;
    font-size:42px;
    opacity:.15;
}

.card h2{
    margin:0;
    color:#222;
    font-size:30px;
    font-weight:700;
}

.card p{
    margin-top:8px;
    color:#777;
    font-size:14px;
    font-weight:500;
}

/* màu từng card */

.card.money{
    border-left-color:#27ae60;
}

.card.month{
    border-left-color:#2980b9;
}

.card.bill{
    border-left-color:#f39c12;
}

.card.total{
    border-left-color:#8e44ad;
}

.card.customer{
    border-left-color:#16a085;
}

.card.staff{
    border-left-color:#34495e;
}

.card.product{
    border-left-color:#e67e22;
}

.card.stock{
    border-left-color:#e74c3c;
}

/* BOX */

.dashboard-box{
    background:#fff;
    border-radius:16px;
        overflow:visible !important;
    box-shadow:0 4px 15px rgba(0,0,0,.06);
    margin-bottom:25px;
}
.dashboard-box h2{
    margin:0;
    padding:18px 20px;
    background:#f8f9fa;
    border-bottom:1px solid #e9ecef;
    font-size:20px;
    font-weight:600;
    color:#212529;
}

/* TABLE */

.dashboard-table{
    width:100%;
    border-collapse:collapse;
}
.dashboard-table th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
    font-size:14px;
    font-weight:600;
}
.dashboard-table td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.dashboard-table tr:last-child td{
    border-bottom:none;
}

.dashboard-table tr:hover{
    background:#f8fbff;
}
.badge-sale{
    background:#dbeafe;
    color:#1e40af;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}
/* responsive */

@media(max-width:1400px){

    .dashboard-cards{
        grid-template-columns:repeat(2,1fr);
    }

}

@media(max-width:768px){

    .dashboard-cards{
        grid-template-columns:1fr;
    }

}
.badge-stock{
    background:#fee2e2;
    color:#b91c1c;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}
</style>

<?php
echo "<div class='page-dashboard'>";

echo "
<h1>
Trang chủ
</h1>
";

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
$so_cn = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) tong
FROM chi_nhanh"
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

echo "

<div class='dashboard-cards'>
<div class='card money'>
    <div class='card-icon'>💰</div>
    <h2>".number_format($doanh_thu_hom_nay['tong'])." đ</h2>
    <p>Doanh thu hôm nay</p>
</div>

<div class='card month'>
    <div class='card-icon'>📈</div>
    <h2>".number_format($doanh_thu_thang['tong'])." đ</h2>
    <p>Doanh thu tháng</p>
</div>
<div class='card'>
    <div class='card-icon'>🏢</div>
    <h2>".$so_cn['tong']."</h2>
    <p>Chi nhánh</p>
</div>
<div class='card bill'>
    <div class='card-icon'>🧾</div>
    <h2>".$hoadon_homnay['tong']."</h2>
    <p>Hóa đơn hôm nay</p>
</div>

<div class='card total'>
    <div class='card-icon'>📚</div>
    <h2>".$so_hd['tong']."</h2>
    <p>Tổng hóa đơn</p>
</div>

<div class='card customer'>
    <div class='card-icon'>👥</div>
    <h2>".$so_kh['tong']."</h2>
    <p>Khách hàng</p>
</div>

<div class='card staff'>
    <div class='card-icon'>👨‍🍳</div>
    <h2>".$so_nv['tong']."</h2>
    <p>Nhân viên</p>
</div>


<div class='card stock'>
    <div class='card-icon'>⚠️</div>
    <h2>".$nl_sap_het['tong']."</h2>
    <p>Nguyên liệu sắp hết</p>
</div>
</div>

";

$sql = mysqli_query(
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

echo "

<div class='dashboard-box'>

<h2>🔥 Top 5 món bán chạy</h2>

<table class='dashboard-table'>

<tr>
    <th>Tên món</th>
    <th>Số lượng bán</th>
</tr>

";

while($row = mysqli_fetch_assoc($sql))
{
    echo "
    <tr>
        <td>".$row['ten_mon']."</td>
        <td>
<span class='badge-sale'>
".$row['tong_ban']." ly
</span>
</td>
    </tr>
    ";
}

echo "
</table>

</div>
";

$sql = mysqli_query(
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

echo "

<div class='dashboard-box'>

<h2>⚠️ Nguyên liệu sắp hết</h2>

<table class='dashboard-table'>

<tr>
    <th>Tên nguyên liệu</th>
    <th>Tồn kho</th>
    <th>Mức tối thiểu</th>
</tr>

";

while($row = mysqli_fetch_assoc($sql))
{
    echo "
    <tr>
        <td>".$row['ten_nl']."</td>
        <td>
<span class='badge-stock'>
".$row['so_luong']." ".$row['don_vi']."
</span>
</td>
        <td>".$row['muc_toi_thieu']." ".$row['don_vi']."</td>
    </tr>
    ";
}

echo "
</table>

</div>

";
echo "</div>";
break;

    case 'chinhanh':

echo "<h1>QUẢN LÝ CHI NHÁNH</h1>";
echo "<hr>";

?>

<style>

body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-cn{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}

.form-card h2,
.table-card h2,
.edit-card h2{
    font-size:20px;
    font-weight:600;
    color:#212529;
}

.form-group label{
    font-size:14px;
    font-weight:600;
}

.form-control{
    font-size:14px;
    font-family:inherit;
}

.form-control::placeholder{
    font-size:14px;
}

.table-cn{
    font-size:14px;
}

.table-cn th{
    font-size:14px;
    font-weight:600;
}

.table-cn td{
    font-size:14px;
}

.btn-submit,
.btn-update,
.btn-refresh,
.btn-cancel{
    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.btn-edit,
.btn-delete{
    font-size:14px;
    font-weight:600;
}
.edit-card{
    width:100%;
    margin-top:20px;
}
.form-card h2,
.table-card h2,
.edit-card h2{
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;
    margin-bottom:20px;
}
.cn-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card,
.edit-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.form-card{
    width:350px;
}

.table-card{
    flex:1;
}

.edit-card{
    margin-top:20px;
}

.form-card h2,
.table-card h2,
.edit-card h2{
    margin-top:0;
    margin-bottom:20px;
    color:#333;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
    color:#555;
}

.form-control{
    width:100%;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;
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
    padding:12px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}

.btn-submit:hover{
    background:#0b5ed7;
}

.btn-update{
    width:100%;
    border:none;
    background:#198754;
    color:#fff;
    padding:12px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}

.btn-update:hover{
    background:#157347;
}
.btn-refresh{
    display:inline-block;
    background:#0dcaf0;
    color:#fff;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    text-align:center;
}

.btn-refresh:hover{
    background:#31d2f2;
}

.btn-cancel{
    display:inline-block;
    background:#dc3545;
    color:#fff;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    text-align:center;
}

.btn-cancel:hover{
    background:#bb2d3b;
}

.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}
.table-cn{
    width:100%;
    border-collapse:collapse;
}

.table-cn th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
}

.table-cn td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.table-cn tr:hover{
    background:#f8f9fa;
}

.action{
    white-space:nowrap;
}

.btn-edit{
    color:#198754;
    text-decoration:none;
    font-weight:bold;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;
    font-weight:bold;
}
.btn-submit,
.btn-update,
.btn-refresh,
.btn-cancel{
    height:48px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex:1;
}
</style>

<div class="page-cn">

    <div class="cn-wrapper">

        <!-- FORM THÊM -->
        <div class="form-card">

            <h2>Thêm chi nhánh</h2>

            <form method="POST">

                <div class="form-group">
                    <label>Tên chi nhánh</label>
                    <input
                        type="text"
                        name="ten_cn"
                        class="form-control"
                        placeholder="Nhập tên chi nhánh"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input
                        type="text"
                        name="dia_chi"
                        class="form-control"
                        placeholder="Nhập địa chỉ"
                    >
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input
                        type="text"
                        name="sdt"
                        class="form-control"
                        placeholder="Nhập số điện thoại"
                    >
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>

                    <select
                        name="trang_thai"
                        class="form-control"
                    >
                        <option value="Hoat dong">
                            Hoạt động
                        </option>

                        <option value="Tam dung">
                            Tạm dừng
                        </option>
                    </select>
                </div>

                <div class="btn-group">

    <button
        type="submit"
        name="them_chinhanh"
        class="btn-submit"
    >
        Thêm chi nhánh
    </button>

    <a
        href="?page=chinhanh"
        class="btn-refresh"
    >
        Làm mới
    </a>

</div>

            </form>

        </div>

        <!-- DANH SÁCH -->
        <div class="table-card">

            <h2>Danh sách chi nhánh</h2>

            <?php

            $sql = "
                SELECT *
                FROM chi_nhanh
                ORDER BY ma_cn DESC
            ";

            $result = mysqli_query($conn,$sql);

            echo "
            <table class='table-cn' id='tableChiNhanh' >
<thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên chi nhánh</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
            ";

            while($row = mysqli_fetch_assoc($result))
            {
                echo "
                <tr>

                    <td>".$row['ma_cn']."</td>

                    <td>".$row['ten_cn']."</td>

                    <td>".$row['dia_chi']."</td>

                    <td>".$row['sdt']."</td>

                    <td>".$row['trang_thai']."</td>

                    <td class='action'>

                        <a
                        class='btn-edit'
                        href='?page=chinhanh&sua_cn=".$row['ma_cn']."'>
                            ✏ Sửa
                        </a>

                        &nbsp;|&nbsp;

                        <a
                        class='btn-delete'
                        onclick=\"return confirm('Xóa chi nhánh này?')\"
                        href='?page=chinhanh&xoa_cn=".$row['ma_cn']."'>
                            🗑 Xóa
                        </a>

                    </td>

                </tr>
                ";
            }

           echo "

    </tbody>

</table>

";

            ?>

        </div>

    </div>

    <?php

    if(isset($_GET['sua_cn']))
    {
        $ma_cn = (int)$_GET['sua_cn'];

        $sql = mysqli_query(
            $conn,
            "SELECT *
             FROM chi_nhanh
             WHERE ma_cn=$ma_cn"
        );

        $data = mysqli_fetch_assoc($sql);

        ?>

        <div class="edit-card">

            <h2>✏ Sửa chi nhánh</h2>

            <form method="POST">

                <input
                    type="hidden"
                    name="ma_cn"
                    value="<?php echo $data['ma_cn']; ?>"
                >

                <div class="form-group">
                    <label>Tên chi nhánh</label>

                    <input
                        type="text"
                        name="ten_cn"
                        class="form-control"
                        value="<?php echo $data['ten_cn']; ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>

                    <input
                        type="text"
                        name="dia_chi"
                        class="form-control"
                        value="<?php echo $data['dia_chi']; ?>"
                    >
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>

                    <input
                        type="text"
                        name="sdt"
                        class="form-control"
                        value="<?php echo $data['sdt']; ?>"
                    >
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>

                    <select
                        name="trang_thai"
                        class="form-control"
                    >
                        <option
                            value="Hoat dong"
                            <?php if($data['trang_thai']=="Hoat dong") echo "selected"; ?>
                        >
                            Hoạt động
                        </option>

                        <option
                            value="Tam dung"
                            <?php if($data['trang_thai']=="Tam dung") echo "selected"; ?>
                        >
                            Tạm dừng
                        </option>
                    </select>
                </div>
<div class="btn-group">

    <button
        type="submit"
        name="capnhat_chinhanh"
        class="btn-update"
    >
        Cập nhật chi nhánh
    </button>

    <a
        href="?page=chinhanh"
        class="btn-cancel"
    >
        Hủy
    </a>

</div>

            </form>

        </div>

        <?php
    }
    ?>

</div>

<?php

break;
    case 'nhanvien':

echo "<h1>QUẢN LÝ NHÂN VIÊN</h1>";

echo "<hr>";

?>

<style>
.form-card,
.table-card,
.edit-card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-nv{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.nv-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card h2,
.table-card h2,
.edit-card h2{
    margin-top:0;
    margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;

    color:#212529;
    font-size:20px;
    font-weight:600;
}

.form-card{
    width:380px;
    position:sticky;
    top:20px;
}

.table-card{
    flex:1;
    overflow:auto;
}

.edit-card{
    margin-top:20px;
}


.form-group{
    margin-bottom:15px;
}
.form-group label{
    display:block;
    margin-bottom:5px;
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
.form-control::placeholder{
    font-size:14px;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}

.btn-submit{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#0d6efd;
    color:#fff;
    cursor:pointer;
    font-size:14px;
font-weight:600;
font-family:inherit;
}

.btn-submit:hover{
    background:#0b5ed7;
}

.btn-update{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#198754;
    color:#fff;
    cursor:pointer;
    font-size:14px;
font-weight:600;
font-family:inherit;
}
.table-nv{
    font-size:14px;
}
.btn-update:hover{
    background:#157347;
}
.btn-action{
    display:inline-block;
    text-align:center;
    padding:12px;
    border-radius:8px;
    text-decoration:none;
    color:#fff;
    font-size:14px;
font-weight:600;
font-family:inherit;
}

.btn-refresh{
    background:#0dcaf0;
}

.btn-refresh:hover{
    background:#31d2f2;
}

.btn-cancel{
    background:#dc3545;
}

.btn-cancel:hover{
    background:#bb2d3b;
}

.btn-group{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.btn-group a{
    flex:1;
}
.table-nv{
    width:100%;
    border-collapse:collapse;
    min-width:1200px;
}
.table-nv th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-nv td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;

    font-size:14px;
}

.table-nv tr:hover{
    background:#f8f9fa;
}

.action{
    white-space:nowrap;
}
.btn-edit{
    color:#198754;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}
.edit-card{
    margin-top:20px;
    width:100%;
}
.salary{
    text-align:right;
    font-weight:bold;
}
@media(max-width:1200px){

    .nv-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

    .table-card{
        width:100%;
    }

}


</style>

<div class="page-nv">

<div class="nv-wrapper">

<!-- FORM THÊM NHÂN VIÊN -->
<div class="form-card">

<h2>Thêm nhân viên</h2>

<form method="POST">
    <div class="form-group">
    <label>Họ và tên</label>

    <input
        type="text"
        name="ten_nv"
        class="form-control"
        placeholder="Nhập tên nhân viên"
        required
    >
</div>

<div class="form-group">
    <label>Giới tính</label>

    <select
        name="gioi_tinh"
        class="form-control"
    >
        <option value="Nam">Nam</option>
        <option value="Nu">Nữ</option>
        <option value="Khac">Khác</option>
    </select>
</div>

<div class="form-group">
    <label>Ngày sinh</label>

    <input
        type="date"
        name="ngay_sinh"
        class="form-control"
    >
</div>

<div class="form-group">
    <label>Số điện thoại</label>

    <input
        type="text"
        name="sdt"
        class="form-control"
        placeholder="Nhập số điện thoại"
    >
</div>

<div class="form-group">
    <label>Email</label>

    <input
        type="email"
        name="email"
        class="form-control"
        placeholder="Nhập email"
    >
</div>

<div class="form-group">
    <label>Địa chỉ</label>

    <input
        type="text"
        name="dia_chi"
        class="form-control"
        placeholder="Nhập địa chỉ"
    >
</div>

<div class="form-group">
    <label>Chức vụ</label>

    <select
        name="chuc_vu"
        class="form-control"
    >
        <option value="Quan ly">
            Quản lý
        </option>

        <option value="Nhan vien">
            Nhân viên
        </option>
    </select>
</div>

<div class="form-group">
    <label>Lương</label>

    <input
        type="number"
        name="luong"
        class="form-control"
        placeholder="Nhập mức lương"
    >
</div>

<div class="form-group">
    <label>Chi nhánh</label>

    <select
        name="ma_cn"
        class="form-control"
    >

    <?php

    $cn = mysqli_query(
        $conn,
        "SELECT * FROM chi_nhanh"
    );

    while($item = mysqli_fetch_assoc($cn))
    {
    ?>

        <option
        value="<?php echo $item['ma_cn']; ?>">
            <?php echo $item['ten_cn']; ?>
        </option>

    <?php
    }
    ?>

    </select>
</div>
<?php if($userRole=='admin' || $userRole=='manager'): ?>

<button
type="submit"
name="them_nhanvien"
class="btn-submit">
    Thêm nhân viên
</button>

<?php endif; ?>

<div class="btn-group">

    <a
    href="?page=nhanvien"
    class="btn-action btn-refresh">
    Làm mới
    </a>

</div>

</form>

</div>

<!-- DANH SÁCH NHÂN VIÊN -->
<div class="table-card">

<h2>Danh sách nhân viên</h2>
<?php

$sql = mysqli_query(
    $conn,
    "SELECT nv.*,
            cn.ten_cn
     FROM nhan_vien nv
     LEFT JOIN chi_nhanh cn
     ON nv.ma_cn = cn.ma_cn
     ORDER BY nv.ma_nv DESC"
);

echo "
<table class='table-nv' id='tableNhanVien'>
<thead>
<tr>

    <th>Mã</th>
    <th>Họ tên</th>
    <th>Giới tính</th>
    <th>Ngày sinh</th>
    <th>SĐT</th>
    <th>Email</th>
    <th>Địa chỉ</th>
    <th>Chức vụ</th>
    <th>Lương</th>
    <th>Chi nhánh</th>
    <th>Thao tác</th>

</tr>
</thead>
";
while($row = mysqli_fetch_assoc($sql))
{
    echo "
    <tr>

        <td>".$row['ma_nv']."</td>

        <td>".$row['ten_nv']."</td>

        <td>".$row['gioi_tinh']."</td>

        <td>".$row['ngay_sinh']."</td>

        <td>".$row['sdt']."</td>

        <td>".$row['email']."</td>

        <td>".$row['dia_chi']."</td>

        <td>".$row['chuc_vu']."</td>

        <td class='salary'>
            ".number_format((float)$row['luong'])."
        </td>

        <td>".$row['ten_cn']."</td>

        <td>
    ";

    if($userRole=='admin' || $userRole=='manager')
    {
        echo "
        <a
        class='btn-edit'
        href='?page=nhanvien&sua_nv=".$row['ma_nv']."'>
            ✏ Sửa
        </a>

        &nbsp;|&nbsp;

        <a
        class='btn-delete'
        onclick=\"return confirm('Xóa nhân viên này?')\"
        href='?page=nhanvien&xoa_nv=".$row['ma_nv']."'>
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

echo "
    </tbody>
</table>
";

?>

</div>

</div>
<?php

if(isset($_GET['sua_nv']))
{
    $ma_nv = (int)$_GET['sua_nv'];

    $data = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM nhan_vien
             WHERE ma_nv=$ma_nv"
        )
    );

?>

<div class="edit-card">

    <h2>✏ Sửa nhân viên</h2>

    <form method="POST">

        <input
            type="hidden"
            name="ma_nv"
            value="<?php echo $data['ma_nv']; ?>"
        >

        <div class="form-group">
            <label>Họ và tên</label>

            <input
                type="text"
                name="ten_nv"
                class="form-control"
                value="<?php echo $data['ten_nv']; ?>"
                required
            >
        </div>

        <div class="form-group">
            <label>Giới tính</label>

            <select
                name="gioi_tinh"
                class="form-control"
            >
                <option
                    value="Nam"
                    <?php if($data['gioi_tinh']=="Nam") echo "selected"; ?>
                >
                    Nam
                </option>

                <option
                    value="Nu"
                    <?php if($data['gioi_tinh']=="Nu") echo "selected"; ?>
                >
                    Nữ
                </option>

                <option
                    value="Khac"
                    <?php if($data['gioi_tinh']=="Khac") echo "selected"; ?>
                >
                    Khác
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Ngày sinh</label>

            <input
                type="date"
                name="ngay_sinh"
                class="form-control"
                value="<?php echo $data['ngay_sinh']; ?>"
            >
        </div>

        <div class="form-group">
            <label>Số điện thoại</label>

            <input
                type="text"
                name="sdt"
                class="form-control"
                value="<?php echo $data['sdt']; ?>"
            >
        </div>

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="<?php echo $data['email']; ?>"
            >
        </div>

        <div class="form-group">
            <label>Địa chỉ</label>

            <input
                type="text"
                name="dia_chi"
                class="form-control"
                value="<?php echo $data['dia_chi']; ?>"
            >
        </div>

        <div class="form-group">
            <label>Chức vụ</label>

            <select
                name="chuc_vu"
                class="form-control"
            >
                <option
                    value="Quan ly"
                    <?php if($data['chuc_vu']=="Quan ly") echo "selected"; ?>
                >
                    Quản lý
                </option>

                <option
                    value="Nhan vien"
                    <?php if($data['chuc_vu']=="Nhan vien") echo "selected"; ?>
                >
                    Nhân viên
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Lương</label>

            <input
                type="number"
                name="luong"
                class="form-control"
                value="<?php echo $data['luong']; ?>"
            >
        </div>

        <div class="form-group">
            <label>Chi nhánh</label>

            <select
                name="ma_cn"
                class="form-control"
            >

            <?php

            $cn = mysqli_query(
                $conn,
                "SELECT * FROM chi_nhanh"
            );

            while($item = mysqli_fetch_assoc($cn))
            {
            ?>

                <option
                    value="<?php echo $item['ma_cn']; ?>"
                    <?php
                    if($item['ma_cn'] == $data['ma_cn'])
                    {
                        echo "selected";
                    }
                    ?>
                >
                    <?php echo $item['ten_cn']; ?>
                </option>

            <?php
            }
            ?>

            </select>
        </div>
<button
    type="submit"
    name="capnhat_nhanvien"
    class="btn-update"
>
    Cập nhật nhân viên
</button>

<div class="btn-group">

    <a
    href="?page=nhanvien"
    class="btn-action btn-cancel">
    Hủy
    </a>

</div>

    </form>

</div>

<?php
}
?>
<?php
break;
   case 'khachhang':

echo "<h1>QUẢN LÝ KHÁCH HÀNG</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-kh{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.kh-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card,
.edit-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.form-card{
    width:380px;
    position:sticky;
    top:20px;
}

.table-card{
    flex:1;
    overflow:auto;
}
.edit-card{
    margin-top:20px;
    width: 100%;;
}
.form-card h2,
.table-card h2,
.edit-card h2{
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
.form-control::placeholder{
    font-size:14px;
}
.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}
.btn-submit{
    width:100%;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#0d6efd;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.btn-submit:hover{
    background:#0b5ed7;
}
.btn-update{
    width:100%;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#198754;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.btn-update:hover{
    background:#157347;
}
.btn-refresh,
.btn-cancel{
    display:flex;
    align-items:center;
    justify-content:center;

    height:48px;
    flex:1;

    text-decoration:none;
    border-radius:8px;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.btn-refresh:hover{
    background:#31d2f2;
}


.btn-cancel:hover{
    background:#5c636a;
}
.action-buttons{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.action-buttons > *{
    flex:1;
}

.table-kh{
    width:100%;
    border-collapse:collapse;
    min-width:900px;
}
.table-kh{
    font-size:14px;
}
.table-kh th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-kh td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;

    font-size:14px;
}

.table-kh tr:hover{
    background:#f8f9fa;
}
.btn-edit{
    color:#198754;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}

@media(max-width:1200px){

    .kh-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}
.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}

.btn-cancel{
    background:#dc3545;
    color:#fff;
}

.btn-cancel:hover{
    background:#bb2d3b;
}

</style>
<div class="page-kh">
<div class="kh-wrapper">
<div class="table-card">

<h2>Danh sách khách hàng</h2>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT *
     FROM khach_hang
     ORDER BY ma_kh DESC"
);

echo "

<table class='table-kh' id='tableKhachHang' >
<thead>
<tr>

<th>Mã KH</th>
<th>Tên khách hàng</th>
<th>SĐT</th>
<th>Điểm tích lũy</th>
<th>Ngày tạo</th>
<th>Thao tác</th>

</tr>
</thead>
";

while($row = mysqli_fetch_assoc($sql))
{
    echo "

    <tr>

        <td>".$row['ma_kh']."</td>

        <td>".$row['ten_kh']."</td>

        <td>".$row['sdt']."</td>

        <td>".$row['diem_tich_luy']."</td>

        <td>".$row['ngay_tao']."</td>

        <td>

            <a
            class='btn-edit'
            href='?page=khachhang&sua_kh=".$row['ma_kh']."'>
                ✏ Sửa
            </a>

            |

            <a
            class='btn-delete'
            onclick=\"return confirm('Xóa khách hàng này?')\"
            href='?page=khachhang&xoa_kh=".$row['ma_kh']."'>
                🗑 Xóa
            </a>

        </td>

    </tr>

    ";
}

echo "

    </tbody>

</table>

";

?>

</div>

</div>

<?php

if(isset($_GET['sua_kh']))
{
    $ma_kh = (int)$_GET['sua_kh'];

    $data = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM khach_hang
             WHERE ma_kh=$ma_kh"
        )
    );

?>

<div class="edit-card">

<h2>✏ Sửa khách hàng</h2>

<form method="POST">

<input
type="hidden"
name="ma_kh"
value="<?php echo $data['ma_kh']; ?>">

<div class="form-group">
    <label>Tên khách hàng</label>
    <input
    type="text"
    name="ten_kh"
    class="form-control"
    value="<?php echo $data['ten_kh']; ?>"
    required>
</div>

<div class="form-group">
    <label>Số điện thoại</label>
    <input
    type="text"
    name="sdt"
    class="form-control"
    value="<?php echo $data['sdt']; ?>">
</div>

<div class="form-group">
    <label>Điểm tích lũy</label>
    <input
    type="number"
    name="diem_tich_luy"
    class="form-control"
    value="<?php echo $data['diem_tich_luy']; ?>">
</div>
<div class="action-buttons">

    <button
    type="submit"
    name="capnhat_khachhang"
    class="btn-update">
    Cập nhật khách hàng
    </button>

    <a
    href="?page=khachhang"
    class="btn-cancel">
    Hủy
    </a>

</div>

</form>

</div>
</div>
<?php
}

break;
    case 'danhmuc':

echo "<h1>QUẢN LÝ DANH MỤC</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-dm{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.dm-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card,
.edit-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.form-card{
    width:350px;
    position:sticky;
    top:20px;
}

.table-card{
    flex:1;
    overflow:auto;
}
.edit-card{
    margin-top:20px;
    width: 100%;
}
.form-card h2,
.table-card h2,
.edit-card h2{
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
.form-control::placeholder{
    font-size:14px;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}
.btn-submit{
    width:100%;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#0d6efd;
    color:#fff;

    border:none;
    border-radius:8px;

    cursor:pointer;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.btn-submit:hover{
    background:#0b5ed7;
}
.btn-update{
    width:100%;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#198754;
    color:#fff;

    border:none;
    border-radius:8px;

    cursor:pointer;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.btn-update:hover{
    background:#157347;
}
.table-dm{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
.table-dm th{
    background:#0d6efd;
    color:#fff;

    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-dm td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;

    font-size:14px;
}
.table-dm tr:hover{
    background:#f8f9fa;
}
.btn-edit{
    color:#198754;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

@media(max-width:1200px){

    .dm-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}
.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn-refresh{
    display:flex;
    align-items:center;
    justify-content:center;

    width:100%;
    height:48px;

    background:#0dcaf0;
    color:#fff;

    border-radius:8px;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

.btn-refresh:hover{
    background:#31d2f2;
}
.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn-group > *{
    flex:1;
}

.btn-cancel{
    display:flex;
    align-items:center;
    justify-content:center;

    height:48px;

    background:#dc3545;
    color:#fff;

    border-radius:8px;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

.btn-cancel:hover{
    background:#bb2d3b;
}
</style>
<div class="page-dm">
<div class="dm-wrapper">

<div class="form-card">

<h2>Thêm danh mục</h2>

<form method="POST">

    <div class="form-group">
        <label>Tên danh mục</label>

        <input
        type="text"
        name="ten_dm"
        class="form-control"
        placeholder="Nhập tên danh mục"
        required>
    </div>

   <?php if($userRole=='admin' ): ?>

<button
    type="submit"
    name="them_danhmuc"
    class="btn-submit">
        Thêm danh mục
</button>

<?php endif; ?>
    <div class="btn-group">

    <a
    href="?page=danhmuc"
    class="btn-refresh">
        Làm mới
    </a>

</div>

</form>

</div>

<div class="table-card">

<h2>Danh sách danh mục</h2>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT *
     FROM danh_muc
     ORDER BY ma_dm DESC"
);

echo "

<table class='table-dm'id='tableDanhMuc'>
<thead>
<tr>
    <th>Mã danh mục</th>
    <th>Tên danh mục</th>
    <th>Thao tác</th>
</tr>
</thead>
";
while($row = mysqli_fetch_assoc($sql))
{
    echo "

    <tr>

        <td>".$row['ma_dm']."</td>

        <td>".$row['ten_dm']."</td>

        <td>
    ";

    if($userRole=='admin' )
    {
        echo "
            <a
            class='btn-edit'
            href='?page=danhmuc&sua_dm=".$row['ma_dm']."'>
                ✏ Sửa
            </a>
        ";
    }

    if($userRole=='admin')
    {
        echo "

            |

            <a
            class='btn-delete'
            onclick=\"return confirm('Xóa danh mục này?')\"
            href='?page=danhmuc&xoa_dm=".$row['ma_dm']."'>
                🗑 Xóa
            </a>

        ";
    }

    if($userRole=='staff'|| $userRole=='manager')
    {
        echo "-";
    }

    echo "

        </td>

    </tr>

    ";
}

echo "

    </tbody>

</table>

";

?>

</div>

</div>

<?php

if(isset($_GET['sua_dm']))
{
    $ma_dm = (int)$_GET['sua_dm'];

    $data = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM danh_muc
             WHERE ma_dm=$ma_dm"
        )
    );
?>

<div class="edit-card">

<h2>✏ Sửa danh mục</h2>

<form method="POST">

<input
type="hidden"
name="ma_dm"
value="<?php echo $data['ma_dm']; ?>">

<div class="form-group">

    <label>Tên danh mục</label>

    <input
    type="text"
    name="ten_dm"
    class="form-control"
    value="<?php echo $data['ten_dm']; ?>"
    required>

</div>
<div class="btn-group">

    <button
    type="submit"
    name="capnhat_danhmuc"
    class="btn-update">
        Cập nhật danh mục
    </button>

    <a
    href="?page=danhmuc"
    class="btn-cancel">
        Hủy
    </a>

</div>

</form>

</div>
</div>
<?php
}

break;

    case 'mon':

echo "<h1>QUẢN LÝ MÓN</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-mon{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.mon-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card,
.edit-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}
.edit-card{
    margin-top:20px;
    width: 100%;
}
.form-card{
    width:400px;
    position:sticky;
    top:20px;
}

.table-card{
    flex:1;
    overflow:auto;
}

.edit-card{
    margin-top:20px;
}
.form-card h2,
.table-card h2,
.edit-card h2{
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
.form-control::placeholder{
    font-size:14px;
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
.btn-update,
.btn-refresh,
.btn-cancel{
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:8px;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}
.btn-submit{
    width:100%;
    background:#0d6efd;
    color:#fff;
    border:none;
    cursor:pointer;
}

.btn-submit:hover{
    background:#0b5ed7;
}
.btn-update{
    width:100%;
    background:#198754;
    color:#fff;
    border:none;
    cursor:pointer;
}
.btn-update:hover{
    background:#157347;
}
.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}
.btn-cancel{
    background:#dc3545;
    color:#fff;
}

.btn-cancel:hover{
    background:#bb2d3b;
}
.table-mon{
    width:100%;
    border-collapse:collapse;
    min-width:1000px;
    font-size:14px;
}
.table-mon th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-mon td{
    padding:10px;
    border-bottom:1px solid #eee;
    vertical-align:middle;
    text-align:center;

    font-size:14px;
}

.table-mon tr:hover{
    background:#f8f9fa;
}

.mon-img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #ddd;
}
.badge-active,
.badge-stop{
    font-size:12px;
    font-weight:600;
}
.btn-edit{
    color:#198754;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

@media(max-width:1200px){

    .mon-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}
.col-mota{
    min-width:250px;
    max-width:300px;
    text-align:left !important;
    line-height:1.5;
    white-space:normal;
    word-break:break-word;
}

</style>
<div class="page-mon">
<div class="mon-wrapper">

<div class="form-card">

<h2>Thêm món</h2>

<form method="POST">

<div class="form-group">
<label>Tên món</label>
<input
type="text"
name="ten_mon"
class="form-control"
required>
</div>

<div class="form-group">
<label>Giá bán</label>
<input
type="number"
name="gia"
class="form-control"
required>
</div>

<div class="form-group">
<label>Link hình ảnh</label>
<input
type="text"
name="hinh_anh"
class="form-control">
</div>

<div class="form-group">
<label>Mô tả</label>
<textarea
name="mo_ta"
class="form-control"
rows="4"></textarea>
</div>

<div class="form-group">
<label>Danh mục</label>

<select
name="ma_dm"
class="form-control">

<?php

$dm = mysqli_query(
    $conn,
    "SELECT *
     FROM danh_muc
     ORDER BY ten_dm"
);

while($item = mysqli_fetch_assoc($dm))
{
?>

<option value="<?php echo $item['ma_dm']; ?>">
<?php echo $item['ten_dm']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="form-group">
<label>Trạng thái</label>

<select
name="trang_thai"
class="form-control">

<option value="Con ban">
Còn bán
</option>

<option value="Ngung ban">
Ngừng bán
</option>

</select>

</div>
<div class="btn-group">

    <?php if($userRole=='admin'): ?>

<button
type="submit"
name="them_mon">
    Thêm món
</button>

<?php endif; ?>

    <a
    href="?page=mon"
    class="btn-refresh">
        Làm mới
    </a>

</div>

</form>

</div>
<div class="table-card">

<h2>Danh sách món</h2>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT mon.*,
            danh_muc.ten_dm
     FROM mon
     LEFT JOIN danh_muc
     ON mon.ma_dm=danh_muc.ma_dm
     ORDER BY mon.ma_mon DESC"
);

echo "
<table class='table-mon' id='tableMon'>

    <thead>
        <tr>
            <th>Mã</th>
            <th>Ảnh</th>
            <th>Tên món</th>
            <th>Mô tả</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>

    <tbody>
";

while($row = mysqli_fetch_assoc($sql))
{
    echo "
    <tr>

        <td>".$row['ma_mon']."</td>

        <td>
            <img
                src='".$row['hinh_anh']."'
                width='70'>
        </td>

        <td>".$row['ten_mon']."</td>

        <td>".$row['mo_ta']."</td>

        <td>".$row['ten_dm']."</td>

        <td>".number_format($row['gia'],0,',','.')." đ</td>

        <td>".$row['trang_thai']."</td>

        <td>";

        if($userRole=='admin')
        {
            echo "
            <a
            class='btn-edit'
            href='?page=mon&sua_mon=".$row['ma_mon']."'>
                ✏ Sửa
            </a>

            |

            <a
            class='btn-delete'
            onclick=\"return confirm('Xóa món này?')\"
            href='?page=mon&xoa_mon=".$row['ma_mon']."'>
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

echo "
    </tbody>
</table>
";
?>

</div>

</div>

<?php

if(isset($_GET['sua_mon']))
{
    $ma_mon = (int)$_GET['sua_mon'];

    $data = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM mon
             WHERE ma_mon=$ma_mon"
        )
    );

    if($data)
    {
?>

<div class="edit-card">

<h2>✏ Sửa món</h2>

<form method="POST">

<input
type="hidden"
name="ma_mon"
value="<?php echo $data['ma_mon']; ?>">

<div class="form-group">
<label>Tên món</label>
<input
type="text"
name="ten_mon"
class="form-control"
value="<?php echo $data['ten_mon']; ?>"
required>
</div>

<div class="form-group">
<label>Giá bán</label>
<input
type="number"
name="gia"
class="form-control"
value="<?php echo $data['gia']; ?>"
required>
</div>

<div class="form-group">
<label>Link hình ảnh</label>
<input
type="text"
name="hinh_anh"
class="form-control"
value="<?php echo $data['hinh_anh']; ?>">
</div>

<div class="form-group">
<label>Mô tả</label>
<textarea
name="mo_ta"
class="form-control"
rows="4"><?php echo $data['mo_ta']; ?></textarea>
</div>

<div class="form-group">
<label>Danh mục</label>

<select
name="ma_dm"
class="form-control">

<?php

$dm = mysqli_query(
    $conn,
    "SELECT *
     FROM danh_muc
     ORDER BY ten_dm"
);

while($item = mysqli_fetch_assoc($dm))
{
?>

<option
value="<?php echo $item['ma_dm']; ?>"
<?php
if($item['ma_dm']==$data['ma_dm'])
{
    echo "selected";
}
?>
>
<?php echo $item['ten_dm']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="form-group">
<label>Trạng thái</label>

<select
name="trang_thai"
class="form-control">

<option
value="Con ban"
<?php if($data['trang_thai']=="Con ban") echo "selected"; ?>>
Còn bán
</option>

<option
value="Ngung ban"
<?php if($data['trang_thai']=="Ngung ban") echo "selected"; ?>>
Ngừng bán
</option>

</select>

</div>
<div class="btn-group">

    <button
    type="submit"
    name="capnhat_mon"
    class="btn-update">
        Cập nhật món
    </button>

    <a
    href="?page=mon"
    class="btn-cancel">
        Hủy
    </a>

</div>

</form>

</div>
<?php
    }
}
break;
   case 'kho':

echo "<h1>QUẢN LÝ KHO NGUYÊN LIỆU TỔNG</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-kho{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.kho-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card,
.edit-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}
.edit-card{
    margin-top:20px;
    width: 100%;
}
.form-card{
    width:400px;
    position:sticky;
    top:20px;
}

.table-card{
    flex:1;
    overflow:auto;
}

.form-card h2,
.table-card h2,
.edit-card h2{
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
.form-control::placeholder{
    font-size:14px;
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
.btn-update,
.btn-refresh,
.btn-cancel{
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:8px;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
    font-family:inherit;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}
.btn-submit{
    width:100%;
    background:#0d6efd;
    color:#fff;
    border:none;
    cursor:pointer;
}

.btn-submit:hover{
    background:#0b5ed7;
}
.btn-update{
    width:100%;
    background:#198754;
    color:#fff;
    border:none;
    cursor:pointer;
}
.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}
.btn-cancel{
    background:#dc3545;
    color:#fff;
}

.btn-cancel:hover{
    background:#bb2d3b;
}
.btn-update:hover{
    background:#157347;
}
.table-kho{
    width:100%;
    border-collapse:collapse;
    min-width:1000px;
    font-size:14px;
}
.table-kho th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-kho td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;

    font-size:14px;
}
.table-kho tr:hover{
    background:#f8f9fa;
}
.badge-warning,
.badge-normal{
    font-size:12px;
    font-weight:600;
}
.btn-edit{
    color:#198754;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

@media(max-width:1200px){

    .kho-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}

</style>
<div class="page-kho">
<div class="kho-wrapper">


<div class="table-card">

<h2>Danh sách nguyên liệu</h2>

<?php
$sql = mysqli_query(
    $conn,
    "SELECT
        nl.ma_nl,
        nl.ten_nl,
        nl.don_vi,
        cn.ten_cn,
        SUM(ct.so_luong) AS tong_nhap

     FROM chi_tiet_nhap_kho ct

     INNER JOIN nhap_kho nk
        ON ct.ma_nhap = nk.ma_nhap

     INNER JOIN kho_nguyen_lieu nl
        ON ct.ma_nl = nl.ma_nl

     INNER JOIN chi_nhanh cn
        ON nk.ma_cn = cn.ma_cn

     GROUP BY
        nl.ma_nl,
        nk.ma_cn

     ORDER BY
        cn.ten_cn,
        nl.ten_nl"
);
echo "

<table class='table-kho'id='tableKho'>
<thead>
<tr>

<th>Mã</th>
<th>Nguyên liệu</th>
<th>Chi nhánh</th>
<th>Tổng đã nhập</th>
<th>Đơn vị</th>
</tr>
</thead>
";

while($row = mysqli_fetch_assoc($sql))
{
echo "
<tr>
<td>".$row['ma_nl']."</td>
<td>".$row['ten_nl']."</td>
<td>".$row['ten_cn']."</td>
<td>".$row['tong_nhap']."</td>
<td>".$row['don_vi']."</td>

</tr>
";
}

echo "

    </tbody>

</table>

";
?>

</div>

</div>
</div>

<?php
break;
    case 'congthuc':

echo "<h1>CÔNG THỨC MÓN</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-ct{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.ct-wrapper{
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
    width:400px;
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
.form-control::placeholder{
    font-size:14px;
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

    text-decoration:none;

    font-size:14px;
    font-weight:600;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}
.btn-submit{
    width:100%;
    background:#0d6efd;
    color:#fff;
    border:none;
    cursor:pointer;
}
.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}

.btn-submit:hover{
    background:#0b5ed7;
}
.table-ct{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
.table-ct th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;

    font-size:14px;
    font-weight:600;
}
.table-ct td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;

    font-size:14px;
}
.table-ct tr:hover{
    background:#f8f9fa;
}
.btn-delete{
    color:#dc3545;
    text-decoration:none;

    font-size:14px;
    font-weight:600;
}
.badge-mon,
.badge-nl{
    font-size:12px;
    font-weight:600;
}

@media(max-width:1200px){

    .ct-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}
.popup-bg{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:9999;
}
.popup-box{
    width:700px;
    max-width:95%;
    max-height:80vh;

    overflow-y:auto;

    background:#fff;
    border-radius:12px;
    padding:20px;

    box-shadow:0 5px 20px rgba(0,0,0,.3);
}

.popup-box h3{
    margin-top:0;
}

.popup-close{
    float:right;
    color:red;
    text-decoration:none;
    font-weight:bold;
}
.edit-form{
    margin-top:15px;
}

.edit-form .form-group{
    margin-bottom:15px;
}

.edit-form label{
    display:block;
    margin-bottom:6px;
    font-weight:600;
}

.edit-form .form-control{
    width:100%;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;
}

.edit-actions{
    display:flex;
    gap:10px;
    margin-top:20px;
}

.btn-save{
    flex:1;
    background:#198754;
    color:#fff;
    border:none;
    height:45px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.btn-save:hover{
    background:#157347;
}

.btn-cancel{
    flex:1;
    background:#dc3545;
    color:#fff;
    text-decoration:none;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:8px;
    font-weight:600;
}

.btn-cancel:hover{
    background:#bb2d3b;
}

</style>
<div class="page-ct">
<div class="ct-wrapper">

<div class="form-card">

<h2>Thêm công thức</h2>

<form method="POST">

<div class="form-group">
<label>Món</label>

<select
name="ma_mon"
class="form-control">

<?php

$mon = mysqli_query(
    $conn,
    "SELECT *
     FROM mon
     ORDER BY ten_mon"
);

while($m = mysqli_fetch_assoc($mon))
{
?>

<option value="<?php echo $m['ma_mon']; ?>">
    <?php echo $m['ten_mon']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="form-group">

<label>Nguyên liệu</label>

<select
name="ma_nl"
class="form-control">

<?php

$nl = mysqli_query(
    $conn,
    "SELECT *
     FROM kho_nguyen_lieu
     ORDER BY ten_nl"
);

while($n = mysqli_fetch_assoc($nl))
{
?>

<option value="<?php echo $n['ma_nl']; ?>">
    <?php echo $n['ten_nl']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="form-group">

<label>Số lượng sử dụng</label>

<input
type="number"
step="0.01"
name="so_luong"
class="form-control"
placeholder="Nhập số lượng"
required>

</div>
<div class="btn-group">

   <?php if($userRole=='admin'): ?>

<button
type="submit"
name="them_congthuc"
class="btn-submit">
    Thêm công thức
</button>

<?php endif; ?>

    <a
    href="?page=congthuc"
    class="btn-refresh">
        Làm mới
    </a>

</div>

</form>

</div>

<div class="table-card">

<h2>Danh sách công thức món</h2>

<?php
$sql = mysqli_query(
    $conn,
    "SELECT
        mon.ma_mon,
        mon.ten_mon,
        COUNT(ct.ma_ct) AS tong_nguyen_lieu

     FROM mon

     LEFT JOIN cong_thuc_mon ct
        ON mon.ma_mon = ct.ma_mon

     GROUP BY mon.ma_mon

     ORDER BY mon.ten_mon"
);

echo "

<table class='table-ct'id='tableCongThuc'>
<thead>
<tr>

<th>Mã món</th>
<th>Tên món</th>
<th>Số nguyên liệu</th>
<th>Xem chi tiết</th>

</tr>
</thead>

";
while($row = mysqli_fetch_assoc($sql))
{
    echo "

    <tr>

        <td>".$row['ma_mon']."</td>

        <td>
            <b>".$row['ten_mon']."</b>
        </td>

        <td>
            ".$row['tong_nguyen_lieu']." nguyên liệu
        </td>

        <td>

<a
href='?page=congthuc&xem_ct=".$row['ma_mon']."'
style='color:#0d6efd;font-weight:600;text-decoration:none'>
👁 Chi tiết
</a>

</td>

    </tr>

    ";
}
echo "

    </tbody>

</table>

";
?>

</div>

</div>

</div>

<?php
if(isset($_GET['xem_ct']))
{
    $ma_mon = (int)$_GET['xem_ct'];

    $ct = mysqli_query(
        $conn,
        "SELECT
    ct.ma_ct,
    mon.ten_mon,
    nl.ten_nl,
    ct.so_luong,
    nl.don_vi

         FROM cong_thuc_mon ct

         JOIN mon
            ON ct.ma_mon = mon.ma_mon

         JOIN kho_nguyen_lieu nl
            ON ct.ma_nl = nl.ma_nl

         WHERE ct.ma_mon = $ma_mon"
    );

    $info = mysqli_fetch_assoc($ct);

if(!$info)
{
    echo "
    <script>
        alert('Món này chưa có công thức!');
        window.location='?page=congthuc';
    </script>
    ";
    exit();
}
?>
<div class="popup-bg">

<div class="popup-box">

<a
href="?page=congthuc"
class="popup-close">
✖
</a>

<h3>
Công thức món:
<?php echo $info['ten_mon']; ?>
</h3>

<table class="table-ct">
<tr>
    <th>STT</th>
    <th>Nguyên liệu</th>
    <th>Số lượng</th>
    <th>Đơn vị</th>
    <th>Thao tác</th>
</tr>

<?php

mysqli_data_seek($ct,0);
$stt = 1;

while($r = mysqli_fetch_assoc($ct))
{
    echo "

    <tr>

        <td>".$stt++."</td>

        <td>{$r['ten_nl']}</td>

        <td>{$r['so_luong']}</td>

        <td>{$r['don_vi']}</td>

        <td>

            <a
            href='?page=congthuc&sua_ct=".$r['ma_ct']."'
            style='color:#198754;font-weight:600;text-decoration:none'>
                ✏ Sửa
            </a>

            |

            <a
            onclick=\"return confirm('Xóa nguyên liệu khỏi công thức?')\"
            href='?page=congthuc&xoa_ct=".$r['ma_ct']."'
            style='color:#dc3545;font-weight:600;text-decoration:none'>
                🗑 Xóa
            </a>

        </td>

    </tr>

    ";
}

?>

</table>

</div>

</div>
<?php
}
if(isset($_GET['sua_ct']))
{
    $ma_ct = (int)$_GET['sua_ct'];

    $data = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT
                ct.*,
                mon.ten_mon,
                nl.ten_nl,
                nl.don_vi
             FROM cong_thuc_mon ct

             JOIN mon
                ON ct.ma_mon = mon.ma_mon

             JOIN kho_nguyen_lieu nl
                ON ct.ma_nl = nl.ma_nl

             WHERE ct.ma_ct = $ma_ct"
        )
    );
?>

<div class="popup-bg">

<div class="popup-box">

<a
href="?page=congthuc"
class="popup-close">
✖
</a>

<h3>✏ Sửa công thức</h3>

<form method="POST" class="edit-form">

<input
type="hidden"
name="ma_ct"
value="<?php echo $data['ma_ct']; ?>">

<div class="form-group">
<label>Món</label>

<input
type="text"
class="form-control"
value="<?php echo $data['ten_mon']; ?>"
readonly>
</div>

<div class="form-group">
<label>Nguyên liệu</label>

<input
type="text"
class="form-control"
value="<?php echo $data['ten_nl']; ?>"
readonly>
</div>

<div class="form-group">
<label>Số lượng sử dụng</label>

<input
type="number"
step="0.01"
name="so_luong"
class="form-control"
value="<?php echo (int)$data['so_luong']; ?>"
required>
</div>

<div class="form-group">
<label>Đơn vị</label>

<input
type="text"
class="form-control"
value="<?php echo $data['don_vi']; ?>"
readonly>
</div>

<div class="edit-actions">

<button
type="submit"
name="capnhat_congthuc"
class="btn-save">
Cập nhật
</button>

<a
href="?page=congthuc"
class="btn-cancel">
Hủy
</a>

</div>

</form>

</div>

</div>

<?php
}

break;
case 'nhapkho':

echo "<h1>NHẬP KHO</h1>";
echo "<hr>";

?>
<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-nhapkho{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}

.form-card h2,
.table-card h2,
.edit-card h2{
    font-size:20px;
    font-weight:600;
    color:#212529;
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;
    margin-bottom:20px;
}

.form-group label{
    font-size:14px;
    font-weight:600;
}

.form-control{
    font-size:14px;
    font-family:inherit;
}

.table-nhap{
    font-size:14px;
}

.table-nhap th{
    font-size:14px;
    font-weight:600;
}

.table-nhap td{
    font-size:14px;
}

.nhapkho-wrapper{
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
    width:350px;
}

.table-card{
    flex:1;
    overflow:auto;
}

.form-card h2,
.table-card h2{
    margin-top:0;
    margin-bottom:20px;
    color:#333;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
    color:#555;
}

.form-control{
    width:100%;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}

.item-row{
    border:1px solid #eee;
    border-radius:10px;
    padding:15px;
    margin-bottom:15px;
    background:#fafafa;
}

/* ===== BUTTONS ===== */

.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn-submit,
.btn-add,
.btn-refresh,
.btn-cancel{
    flex:1;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:0 16px;
    box-sizing:border-box;

    border:none;
    border-radius:8px;

    font-size:14px;
    font-weight:600;
    font-family:inherit;

    cursor:pointer;
    text-decoration:none;
    text-align:center;
}

.btn-add{
    background:#ffc107;
    color:#000;
    margin-bottom:10px;
}

.btn-add:hover{
    background:#ffca2c;
}

.btn-submit{
    background:#0d6efd;
    color:#fff;
}

.btn-submit:hover{
    background:#0b5ed7;
}

.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}

.btn-cancel{
    background:#dc3545;
    color:#fff;
}

.btn-cancel:hover{
    background:#bb2d3b;
}

/* ===== TABLE ===== */

.table-nhap{
    width:100%;
    border-collapse:collapse;
    min-width:900px;
}

.table-nhap th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
}

.table-nhap td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.table-nhap tr:hover{
    background:#f8f9fa;
}

/* ===== BADGES ===== */

.badge-money{
    background:#d1e7dd;
    color:#0f5132;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-sl{
    background:#dbeafe;
    color:#1e40af;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

@media(max-width:1200px){

    .nhapkho-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
    }

}
</style>
<div class="page-nhapkho">

<div class="nhapkho-wrapper">
<div class="form-card">

<h2>Nhập kho</h2>

<form method="POST" id="nhapkhoForm">
<div class="form-group">
<label>Chi nhánh nhập kho</label>

<select
name="ma_cn"
class="form-control"
required>

<option value="">
-- Chọn chi nhánh --
</option>

<?php

$cn = mysqli_query(
    $conn,
    "SELECT *
     FROM chi_nhanh
     ORDER BY ten_cn"
);

while($c = mysqli_fetch_assoc($cn))
{
?>

<option value="<?php echo $c['ma_cn']; ?>">
    <?php echo $c['ten_cn']; ?>
</option>

<?php
}
?>

</select>

</div>
<div id="danhSachNguyenLieu">

<div class="item-row">

<div class="form-group">
<label>Nguyên liệu</label>

<select
name="ma_nl[]"
class="form-control">

<?php

$nl = mysqli_query(
    $conn,
    "SELECT *
     FROM kho_nguyen_lieu
     ORDER BY ten_nl"
);

while($row = mysqli_fetch_assoc($nl))
{
?>

<option value="<?php echo $row['ma_nl']; ?>">
    <?php echo $row['ten_nl']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="form-group">
<label>Số lượng nhập</label>

<input
type="number"
step="0.01"
name="so_luong[]"
class="form-control"
required>

</div>

<div class="form-group">
<label>Giá nhập</label>

<input
type="number"
step="0.01"
name="gia_nhap[]"
class="form-control"
required>

</div>

</div>

</div>
<div class="btn-group">


  <?php
if($userRole=='admin' || $userRole=='manager'):
?>

<button
type="button"
onclick="themDong()">
    + Thêm nguyên liệu
</button>

<?php endif; ?>

    <a
        href="?page=nhapkho"
        class="btn-refresh">
        Làm mới
    </a>

</div>
<div class="btn-group">

    <?php
if($userRole=='admin' || $userRole=='manager'):
?>

<button
type="submit"
name="them_nhapkho"
class="btn-submit">
    Lưu phiếu nhập kho
</button>

<?php endif; ?>

    <a
        href="?page=nhapkho"
        class="btn-cancel">
        Hủy
    </a>

</div>

</form>

</div>

<div class="table-card">

<h2>Lịch sử nhập kho</h2>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT
    nk.*,
    ct.so_luong,
    ct.gia_nhap,
    nl.ten_nl,
    cn.ten_cn

FROM nhap_kho nk

JOIN chi_tiet_nhap_kho ct
ON nk.ma_nhap = ct.ma_nhap

JOIN kho_nguyen_lieu nl
ON ct.ma_nl = nl.ma_nl

JOIN chi_nhanh cn
ON nk.ma_cn = cn.ma_cn

ORDER BY nk.ma_nhap DESC"
);

echo "

<table class='table-nhap'id='tableNhapKho'>
<thead>
<tr>

<th>Mã nhập</th>
<th>Ngày nhập</th>
<th>Chi nhánh</th>
<th>Nguyên liệu</th>
<th>Số lượng</th>
<th>Giá nhập</th>
<th>Tổng tiền</th>
<th>Thao tác</th>

</tr>
</thead>
";

while($row = mysqli_fetch_assoc($sql))
{
echo "

<tr>

<td>".$row['ma_nhap']."</td>

<td>".$row['ngay_nhap']."</td>
<td>".$row['ten_cn']."</td>

<td>".$row['ten_nl']."</td>

<td>
<span class='badge-sl'>
".$row['so_luong']."
</span>
</td>

<td>
<span class='badge-money'>
".number_format($row['gia_nhap'])." đ
</span>
</td>

<td>
<strong>
".number_format($row['tong_tien'])." đ
</strong>
</td>


<td>
<a
onclick=\"return confirm('Xóa phiếu nhập này?')\"
href='?page=nhapkho&xoa_nhap=".$row['ma_nhap']."'
style='color:#dc3545;font-weight:600;text-decoration:none'>
🗑 Xóa
</a>

</td>
</tr>

";
}

echo "

    </tbody>

</table>

";
?>

</div>

</div>
</div>
<script>
function themDong()
{
    let firstRow = document.querySelector('.item-row');
    let clone = firstRow.cloneNode(true);

    clone.querySelectorAll('input, textarea').forEach(el => {
        el.value = '';
    });

    clone.querySelectorAll('select').forEach(el => {
        el.selectedIndex = 0;
    });

    document.getElementById('danhSachNguyenLieu')
        .appendChild(clone);
}

</script>

<?php

break;
case 'xuatkho':

echo "<h1>XUẤT KHO</h1>";
echo "<hr>";

?>
<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-xuatkho{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}

.form-card h2,
.table-card h2,
.edit-card h2{
    font-size:20px;
    font-weight:600;
    color:#212529;
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;
    margin-bottom:20px;
}

.form-group label{
    font-size:14px;
    font-weight:600;
}

.form-control{
    font-size:14px;
    font-family:inherit;
}

.table-xuat{
    font-size:14px;
}

.table-xuat th{
    font-size:14px;
    font-weight:600;
}

.table-xuat td{
    font-size:14px;
}

.xuatkho-wrapper{
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
    width:350px;
}

.table-card{
    flex:1;
    overflow:auto;
}

.form-card h2,
.table-card h2{
    margin-top:0;
    margin-bottom:20px;
    color:#333;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
    color:#555;
}

.form-control{
    width:100%;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}

.item-row{
    border:1px solid #eee;
    border-radius:10px;
    padding:15px;
    margin-bottom:15px;
    background:#fafafa;
}

/* ===== BUTTONS ===== */

.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn-submit,
.btn-add,
.btn-refresh,
.btn-cancel{
    flex:1;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:0 16px;
    box-sizing:border-box;

    border:none;
    border-radius:8px;

    font-size:14px;
    font-weight:600;
    font-family:inherit;

    cursor:pointer;
    text-decoration:none;
    text-align:center;
}

.btn-add{
    background:#ffc107;
    color:#000;
}

.btn-add:hover{
    background:#ffca2c;
}

.btn-submit{
    background:#dc3545;
    color:#fff;
}

.btn-submit:hover{
    background:#bb2d3b;
}

.btn-refresh{
    background:#0dcaf0;
    color:#fff;
}

.btn-refresh:hover{
    background:#31d2f2;
}
.btn-cancel{
    background:#198754;
    color:#fff;
}

.btn-cancel:hover{
    background:#157347;
}

/* ===== TABLE ===== */

.table-xuat{
    width:100%;
    border-collapse:collapse;
    min-width:1000px;
}

.table-xuat th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
}

.table-xuat td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.table-xuat tr:hover{
    background:#f8f9fa;
}

/* ===== BADGES ===== */

.badge-cn{
    background:#dbeafe;
    color:#1e40af;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-nv{
    background:#d1fae5;
    color:#065f46;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-sl{
    background:#fee2e2;
    color:#b91c1c;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

@media(max-width:1200px){

    .xuatkho-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
        position:static;
    }

}
</style>
<div class="page-xuatkho">

<div class="xuatkho-wrapper">
<div class="form-card">

<h2>Phiếu xuất kho</h2>

<form method="POST">

<div class="form-group">

<label>Chi nhánh</label>

<select
name="ma_cn"
class="form-control"
required>

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

<label>Nhân viên xuất</label>

<select
name="ma_nv"
class="form-control"
required>

<?php

$nv = mysqli_query(
    $conn,
    "SELECT *
     FROM nhan_vien
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
<div id="danhSachNguyenLieu">

<div class="item-row">

<div class="form-group">
<label>Nguyên liệu</label>

<select
name="ma_nl[]"
class="form-control"
required>

<?php
$nl = mysqli_query(
    $conn,
    "SELECT *
     FROM kho_nguyen_lieu
     ORDER BY ten_nl"
);

while($row = mysqli_fetch_assoc($nl))
{
?>
<option value="<?php echo $row['ma_nl']; ?>">
    <?php echo $row['ten_nl']; ?>
</option>
<?php
}
?>

</select>

</div>

<div class="form-group">

<label>Số lượng xuất</label>

<input
type="number"
step="0.01"
name="so_luong[]"
class="form-control"
required>

</div>

</div>

</div>

<div class="form-group">

<label>Ghi chú</label>

<textarea
name="ghi_chu"
rows="4"
class="form-control"></textarea>

</div>
<div class="btn-group">
<?php
if($userRole=='admin' || $userRole=='manager'):
?>

<button
type="button"
onclick="themDong()">
    + Thêm nguyên liệu
</button>

<?php endif; ?>

<a
href="?page=xuatkho"
class="btn-refresh">
Làm mới
</a>

</div>
<div class="btn-group">

   <?php
if($userRole=='admin' || $userRole=='manager'):
?>

<button
type="submit"
name="them_xuatkho"
class="btn-submit">
    Lưu phiếu xuất
</button>

<?php endif; ?>

    
    <a
        href="?page=xuatkho"
        class="btn-cancel">
        Hủy
    </a>

</div>

</form>

</div>

<div class="table-card">

<h2>Lịch sử xuất kho</h2>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT
        x.ma_xuat,
        x.ngay_xuat,
        x.ghi_chu,
        cn.ten_cn,
        nv.ten_nv,
        k.ten_nl,
        ct.so_luong

     FROM xuat_kho x

     INNER JOIN chi_tiet_xuat_kho ct
        ON x.ma_xuat = ct.ma_xuat

     INNER JOIN kho_nguyen_lieu k
        ON ct.ma_nl = k.ma_nl

     INNER JOIN chi_nhanh cn
        ON x.ma_cn = cn.ma_cn

     INNER JOIN nhan_vien nv
        ON x.ma_nv = nv.ma_nv

     ORDER BY x.ma_xuat DESC"
);

echo "

<table class='table-xuat'id='tableXuatKho'>
<thead>
<tr>
    <th>Mã xuất</th>
    <th>Ngày xuất</th>
    <th>Chi nhánh</th>
    <th>Nhân viên</th>
    <th>Nguyên liệu</th>
    <th>Số lượng</th>
    <th>Ghi chú</th>
    <th>Thao tác</th>
</tr>
</thead>
";

while($row = mysqli_fetch_assoc($sql))
{
    echo "

    <tr>

        <td>".$row['ma_xuat']."</td>

        <td>".$row['ngay_xuat']."</td>

        <td>
            <span class='badge-cn'>
                ".$row['ten_cn']."
            </span>
        </td>

        <td>
            <span class='badge-nv'>
                ".$row['ten_nv']."
            </span>
        </td>

        <td>".$row['ten_nl']."</td>

        <td>
            <span class='badge-sl'>
                ".$row['so_luong']."
            </span>
        </td>

        <td>".$row['ghi_chu']."</td>

        <td>
    ";

    if($userRole=='admin' || $userRole=='manager')
    {
        echo "
        <a
        href='?page=xuatkho&xoa_xuat=".$row['ma_xuat']."'
        onclick=\"return confirm('Xóa phiếu xuất kho này?')\"
        style='color:red;font-weight:bold;text-decoration:none'>
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

echo "

    </tbody>

</table>

";
?>

</div>

</div>
</div>
<script>

function themDong()
{
    let row =
        document.querySelector('.item-row');

    let clone =
        row.cloneNode(true);

    clone.querySelectorAll('input')
    .forEach(function(el)
    {
        el.value='';
    });

    document
    .getElementById('danhSachNguyenLieu')
    .appendChild(clone);
}

</script>
<?php

break;
    case 'voucher':

echo "<h1>QUẢN LÝ VOUCHER</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size:14px;
    color:#333;
}

.page-voucher{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}

.form-card h2,
.table-card h2{
    font-size:20px;
    font-weight:600;
    color:#212529;
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;
    margin-bottom:20px;
}

.form-group label{
    font-size:14px;
    font-weight:600;
}

.form-control{
    font-size:14px;
    font-family:inherit;
}

.form-control::placeholder{
    font-size:14px;
}

.table-voucher{
    font-size:14px;
}

.table-voucher th{
    font-size:14px;
    font-weight:600;
}

.table-voucher td{
    font-size:14px;
}

.btn-submit,
.btn-refresh{
    font-size:14px;
    font-weight:600;
    font-family:inherit;
}
.voucher-wrapper{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-top:20px;
}

.form-card,
.table-card,
.edit-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}
.form-card{
    width:350px;
}
.btn-refresh{
    display:inline-block;
    background:#0dcaf0;
    color:#fff;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    text-align:center;
}

.btn-refresh:hover{
    background:#31d2f2;
}

.btn-cancel{
    display:inline-block;
    background:#dc3545;
    color:#fff;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    text-align:center;
}

.btn-cancel:hover{
    background:#bb2d3b;
}

.btn-group{
    display:flex;
    gap:10px;
    margin-top:15px;
}

.btn-submit,
.btn-update,
.btn-refresh,
.btn-cancel{
    height:48px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex:1;
}
.table-card{
    flex:1;
    overflow:auto;
}

.edit-card{
    margin-top:20px;
}

.form-card h2,
.table-card h2,
.edit-card h2{
    margin-top:0;
    margin-bottom:20px;
    color:#333;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
    color:#555;
}

.form-control{
    width:100%;
    padding:10px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;
}

.form-control:focus{
    outline:none;
    border-color:#0d6efd;
    box-shadow:0 0 5px rgba(13,110,253,.3);
}

.btn-submit{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#0d6efd;
    color:#fff;
    font-weight:bold;
    cursor:pointer;
}

.btn-submit:hover{
    background:#0b5ed7;
}

.btn-update{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#198754;
    color:#fff;
    font-weight:bold;
    cursor:pointer;
}

.btn-update:hover{
    background:#157347;
}

.table-voucher{
    width:100%;
    border-collapse:collapse;
    min-width:1000px;
}

.table-voucher th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
}

.table-voucher td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.table-voucher tr:hover{
    background:#f8f9fa;
}

.badge-active{
    background:#d1e7dd;
    color:#0f5132;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-expired{
    background:#f8d7da;
    color:#842029;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.btn-edit{
    color:#198754;
    text-decoration:none;
    font-weight:bold;
}

.btn-delete{
    color:#dc3545;
    text-decoration:none;
    font-weight:bold;
}

@media(max-width:1200px){

    .voucher-wrapper{
        flex-direction:column;
    }

    .form-card{
        width:100%;
    }

}

</style>
<div class="page-voucher">

<div class="voucher-wrapper">

<div class="form-card">

<h2>Thêm Voucher</h2>

<form method="POST">

<div class="form-group">
<label>Tên Voucher</label>
<input
type="text"
name="ten_voucher"
class="form-control"
required>
</div>

<div class="form-group">
<label>Giá trị giảm (VNĐ)</label>
<input
type="number"
name="gia_tri"
class="form-control"
required>
</div>

<div class="form-group">
<label>Ngày bắt đầu</label>
<input
type="date"
name="ngay_bat_dau"
class="form-control"
required>
</div>

<div class="form-group">
<label>Ngày kết thúc</label>
<input
type="date"
name="ngay_ket_thuc"
class="form-control"
required>
</div>

<div class="form-group">
<label>Số lượng</label>
<input
type="number"
name="so_luong"
class="form-control"
required>
</div>
<div class="btn-group">

  <?php if($userRole=='admin'): ?>

<button
type="submit"
name="them_voucher">
    Thêm voucher
</button>

<?php endif; ?>

    <a
        href="?page=voucher"
        class="btn-refresh">
        Làm mới
    </a>

</div>

</form>

</div>

<div class="table-card">

<h2>Danh sách Voucher</h2>

<?php
$sql = mysqli_query(
    $conn,
    "SELECT *
     FROM voucher
     ORDER BY ma_voucher DESC"
);

echo "
<table class='table-voucher' id='tableVoucher'>

<thead>
<tr>
    <th>Mã</th>
    <th>Tên Voucher</th>
    <th>Giá trị</th>
    <th>Bắt đầu</th>
    <th>Kết thúc</th>
    <th>Số lượng</th>
    <th>Trạng thái</th>
    <th>Thao tác</th>
</tr>
</thead>

<tbody>
";

while($row = mysqli_fetch_assoc($sql))
{
    echo "
    <tr>

        <td>".$row['ma_voucher']."</td>
        <td>".$row['ten_voucher']."</td>
        <td>".$row['gia_tri']."</td>
        <td>".$row['ngay_bat_dau']."</td>
        <td>".$row['ngay_ket_thuc']."</td>
        <td>".$row['so_luong']."</td>
        <td>".$row['trang_thai']."</td>

        <td>";
        
        if($userRole=='admin')
        {
            echo "
            <a
            class='btn-edit'
            href='?page=voucher&sua_voucher=".$row['ma_voucher']."'>
                ✏ Sửa
            </a>

            |

            <a
            class='btn-delete'
            onclick=\"return confirm('Xóa voucher này?')\"
            href='?page=voucher&xoa_voucher=".$row['ma_voucher']."'>
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

echo "
</tbody>
</table>
";
?>

</div>

</div>

<?php

if(isset($_GET['sua_voucher']))
{
    $ma_voucher = (int)$_GET['sua_voucher'];

    $sql = mysqli_query(
        $conn,
        "SELECT *
         FROM voucher
         WHERE ma_voucher=$ma_voucher"
    );

    $data = mysqli_fetch_assoc($sql);

?>

<div class="edit-card">

<h2>✏ Sửa voucher</h2>

<form method="POST">

<input
type="hidden"
name="ma_voucher"
value="<?php echo $data['ma_voucher']; ?>">

<div class="form-group">
<label>Tên Voucher</label>
<input
type="text"
name="ten_voucher"
class="form-control"
value="<?php echo $data['ten_voucher']; ?>"
required>
</div>

<div class="form-group">
<label>Giá trị giảm</label>
<input
type="number"
name="gia_tri"
class="form-control"
value="<?php echo $data['gia_tri']; ?>"
required>
</div>

<div class="form-group">
<label>Ngày bắt đầu</label>
<input
type="date"
name="ngay_bat_dau"
class="form-control"
value="<?php echo $data['ngay_bat_dau']; ?>"
required>
</div>

<div class="form-group">
<label>Ngày kết thúc</label>
<input
type="date"
name="ngay_ket_thuc"
class="form-control"
value="<?php echo $data['ngay_ket_thuc']; ?>"
required>
</div>

<div class="form-group">
<label>Số lượng</label>
<input
type="number"
name="so_luong"
class="form-control"
value="<?php echo (int)$data['so_luong']; ?>"
required>
</div>

<div class="form-group">
<label>Trạng thái</label>

<select
name="trang_thai"
class="form-control">

<option
value="Hoat dong"
<?php if($data['trang_thai']=="Hoat dong") echo "selected"; ?>>
Hoạt động
</option>

<option
value="Het han"
<?php if($data['trang_thai']=="Het han") echo "selected"; ?>>
Hết hạn
</option>

</select>

</div>
<div class="btn-group">

    <button
        type="submit"
        name="capnhat_voucher"
        class="btn-update">
        Cập nhật Voucher
    </button>

    <a
        href="?page=voucher"
        class="btn-cancel">
        Hủy
    </a>

</div>

</form>
</div>
</div>

<?php
}

break;

    case 'ban':

echo "<h1>QUẢN LÝ BÀN</h1>";
echo "<hr>";

?>

<style>

body{
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
    font-size:14px;
    color:#333;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}

.table-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.table-card h2{
    font-size:20px;
    font-weight:600;
    color:#212529;
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;
    margin-bottom:20px;
    margin-top:0;
}

.table-ban{
    width:100%;
    border-collapse:collapse;
    min-width:800px;
    font-size:14px;
}

.table-ban th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
    font-weight:600;
}

.table-ban td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.table-ban tr:hover{
    background:#f8f9fa;
}

.badge-trong{
    background:#d1e7dd;
    color:#0f5132;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-phucvu{
    background:#fff3cd;
    color:#856404;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-dadat{
    background:#cfe2ff;
    color:#084298;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

@media(max-width:1200px){
    .table-card{
        overflow-x:auto;
    }
}

</style>
<div class="page-ban">

<div class="table-card">

<h2>Danh sách bàn</h2>

<?php

$sql = mysqli_query(
    $conn,
    "SELECT
        ban.*,
        chi_nhanh.ten_cn
     FROM ban

     LEFT JOIN chi_nhanh
     ON ban.ma_cn = chi_nhanh.ma_cn

     ORDER BY ban.ma_ban DESC"
);

echo "

<table class='table-ban' id='tableBan'>
<thead>
<tr>
<th>Mã bàn</th>
<th>Tên bàn</th>
<th>Chi nhánh</th>
<th>Trạng thái</th>

</tr>
</thead>
";

while($row = mysqli_fetch_assoc($sql))
{
echo "

<tr>

<td>".$row['ma_ban']."</td>

<td>".$row['ten_ban']."</td>

<td>".$row['ten_cn']."</td>

<td>";

if($row['trang_thai']=="Trong")
{
    echo "<span class='badge-trong'>✓ Trống</span>";
}
elseif($row['trang_thai']=="Dang phuc vu")
{
    echo "<span class='badge-phucvu'>☕ Đang phục vụ</span>";
}
else
{
    echo "<span class='badge-dadat'>📌 Đã đặt</span>";
}

echo "</td>
</tr>

";
}

echo "

    </tbody>

</table>

";

?>

</div>

</div>
<?php
break;
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
/* thanh toán  */
.btn-payment{
    background:#7c3aed;
    color:#fff;
    padding:8px 14px;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    transition:.25s;
    display:inline-block;
}

.btn-payment:hover{
    background:#6d28d9;
    transform:translateY(-2px);
}

.paid-text{
    color:#16a34a;
    font-weight:700;
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
id="ma_nv"
class="form-control"
required>

 <?php
$ma_cn_chon =
    isset($_POST['ma_cn'])
    ? (int)$_POST['ma_cn']
    : 0;

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

        <option value="">
            -- Chọn nhân viên --
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
id="ma_ban"
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

        <option value="">
            -- Chọn bàn --
        </option>
<?php
}
?>

</select>

</div>
<div class="btn-group">

   <?php
if(
    $userRole=='admin'
    || $userRole=='manager'
    || $userRole=='staff'
):
?>

<button
type="submit"
name="them_hoadon"
class="btn-submit">
    Tạo hóa đơn
</button>

<?php endif; ?>

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
<table class='table-hoadon' id='tableHoaDon'>

    <thead>
        <tr>
            <th>Mã HD</th>
            <th>Ngày lập</th>
            <th>Nhân viên</th>
            <th>Khách hàng</th>
            <th>Bàn</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Mở</th>";

if($userRole=='admin' || $userRole=='manager')
{
    echo "       
    
            <th>Sửa</th>
            <th>Xóa</th>";

            }


echo "
        </tr>
    </thead>

    <tbody>
";

while($row = mysqli_fetch_assoc($ds_hd))
{
    echo "
    <tr>
        <td>".$row['ma_hd']."</td>
        <td>".$row['ngay_lap']."</td>
        <td>".$row['ten_nv']."</td>
        <td>".$row['ten_kh']."</td>
        <td>".$row['ten_ban']."</td>
        <td>".$row['trang_thai']."</td>
        <td>".number_format($row['tong_tien'],0,',','.')." đ</td>

        <td>
            <a class='btn-view'
               href='?page=hoadon&ma_hd=".$row['ma_hd']."'>
               👁 Mở
            </a>
        </td>";

    if($userRole=='admin' || $userRole=='manager')
    {
        
        echo "<td>";

        if($row['trang_thai']=='Chua thanh toan')
        {
            echo "
            <a
            class='btn-action btn-edit-hd'
            href='?page=hoadon&sua_hd=".$row['ma_hd']."'>
                ✏ Sửa
            </a>";
        }
        else
        {
            echo "-";
        }

        echo "</td>";

      echo "<td>";

        if($row['trang_thai']=='Chua thanh toan')
        {
            echo "
            <a
            class='btn-delete'
            onclick=\"return confirm('Xóa hóa đơn này?')\"
            href='?page=hoadon&xoa_hd=".$row['ma_hd']."'>
                🗑 Xóa
            </a>";
        }
        else
        {
            echo "-";
        }

        echo "</td>";
    }

    echo "</tr>";
}

echo "
    </tbody>
</table>";

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

$voucher_dang_chon =
    isset($_POST['ma_voucher'])
    ? (int)$_POST['ma_voucher']
    : 0;

if(
    $voucher_dang_chon > 0
    &&
    $hd['trang_thai']=='Chua thanh toan'
)

{
    $vc = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT *
             FROM voucher
             WHERE ma_voucher=$voucher_dang_chon
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

<table class="table-hoadon" >

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
(
    $hd['trang_thai']=='Da thanh toan'
)
?
$hd['tien_giam']
:
$preview_giam;

$hien_tt =
(
    $hd['trang_thai']=='Da thanh toan'
)
?
$hd['thanh_toan']
:
$preview_tt;

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
        <?php
$ds_voucher = mysqli_query(
    $conn,
    "SELECT *
     FROM voucher
     WHERE trang_thai='Hoat dong'
     AND so_luong > 0"
);
?>
        <label>Voucher</label>


    <select
name="ma_voucher"
class="form-control"
onchange="this.form.submit()">

           <option value="">
    Không dùng voucher
</option>

<?php

while($v=mysqli_fetch_assoc($ds_voucher)){
?>
<option
value="<?php echo $v['ma_voucher']; ?>"
<?php echo ($voucher_dang_chon==$v['ma_voucher']) ? 'selected' : ''; ?>
>
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

</div>

<button
type="submit"
name="capnhat_hd"
class="btn-submit">

Lưu thay đổi

</button>

</form>
</div> <!-- modal-body -->

</div> <!-- modal-content -->

</div> <!-- modal -->

<?php
}
break;
case 'tonkho':

echo "<h1>TỒN KHO CHI NHÁNH</h1>";
echo "<hr>";

?>

<style>
body{
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
    font-size:14px;
    color:#333;
}

h1{
    font-size:28px;
    font-weight:700;
    color:#212529;
    margin-bottom:10px;
}
.tonkho-wrapper{
    margin-top:20px;
}
.table-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}
.table-card h2{
    margin-top:0;
    margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:1px solid #e9ecef;
    font-size:24px;
    font-weight:600;
    color:#212529;
}
.table-tonkho{
    width:100%;
    border-collapse:collapse;
    min-width:800px;
    font-size:14px;
}
@media(max-width:1200px){
    .table-card{
        overflow-x:auto;
    }
}
.table-tonkho th{
    background:#0d6efd;
    color:#fff;
    padding:12px;
    text-align:center;
    font-size:16px;
    font-weight:600;
}

.table-tonkho td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
    font-size:16px;
}

.table-tonkho tr:hover{
    background:#f8f9fa;
}

.status-normal{
    color:green;
    font-weight:bold;
}

.status-warning{
    color:orange;
    font-weight:bold;
}

.status-danger{
    color:red;
    font-weight:bold;
}

</style>

<div class="tonkho-wrapper">

    <div class="table-card">

        <h2>Danh sách tồn kho chi nhánh</h2>

        <?php

        $sql = mysqli_query(
            $conn,
            "SELECT
                tk.*,
                cn.ten_cn,
                nl.ten_nl,
                nl.don_vi,
                nl.muc_toi_thieu

             FROM ton_kho_chi_nhanh tk

             INNER JOIN chi_nhanh cn
                ON tk.ma_cn = cn.ma_cn

             INNER JOIN kho_nguyen_lieu nl
                ON tk.ma_nl = nl.ma_nl

             ORDER BY
                cn.ten_cn,
                nl.ten_nl"
        );

        echo "
        <table class='table-tonkho'id='tableTonKho'>
<thead>
            <tr>
                <th>Chi nhánh</th>
                <th>Nguyên liệu</th>
                <th>Tồn kho</th>
                <th>Đơn vị</th>
                <th>Mức tối thiểu</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
        ";

        while($row = mysqli_fetch_assoc($sql))
        {
            if($row['so_luong'] <= 0)
            {
                $trang_thai =
                "<span class='status-danger'>
                    Hết hàng
                </span>";
            }
            elseif($row['so_luong'] <= $row['muc_toi_thieu'])
            {
                $trang_thai =
                "<span class='status-warning'>
                    Sắp hết
                </span>";
            }
            else
            {
                $trang_thai =
                "<span class='status-normal'>
                    Bình thường
                </span>";
            }

            echo "
            <tr>
                <td>{$row['ten_cn']}</td>
                <td>{$row['ten_nl']}</td>
                <td>{$row['so_luong']}</td>
                <td>{$row['don_vi']}</td>
                <td>{$row['muc_toi_thieu']}</td>
                <td>$trang_thai</td>
            </tr>
            ";
        }

echo "

    </tbody>

</table>

";
        ?>

    </div>

</div>

<?php

break;
}
?>
</div>
<script>

$(document).ready(function(){

    $('#tableChiNhanh').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
$('#tableBan').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableNhanVien').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });

    $('#tableKhachHang').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });

    $('#tableMon').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
$('#tableDanhMuc').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableHoaDon').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableKho').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableTonKho').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
$('#tableCongThuc').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableNhapKho').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableXuatKho').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
    $('#tableVoucher').DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/2.3.2/i18n/vi.json'
        }
    });
});
document.getElementById("ma_cn")
.addEventListener("change", function () {

    const maCN = this.value;

    fetch("load_hoadon.php?ma_cn=" + maCN)
    .then(response => response.json())
    .then(data => {

        let nvHTML =
            '<option value="">-- Chọn nhân viên --</option>';

        data.nhanvien.forEach(nv => {
            nvHTML += `
                <option value="${nv.ma_nv}">
                    ${nv.ten_nv}
                </option>
            `;
        });

        document.getElementById("ma_nv").innerHTML = nvHTML;


        let banHTML =
            '<option value="">-- Chọn bàn --</option>';

        data.ban.forEach(b => {
            banHTML += `
                <option value="${b.ma_ban}">
                    ${b.ten_ban}
                </option>
            `;
        });

        document.getElementById("ma_ban").innerHTML = banHTML;

    });

});
</script>
</body>
</html>