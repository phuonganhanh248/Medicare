<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra cứu lịch khám</title>
    <link href="assets/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/Medicare/views/admin/assets/css/app.css" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
<?php include "components/topbar.php" ?>
<?php include "components/header.php" ?>
<div id="loading-spinner"
     style="text-align: center;line-height:700px;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1050; display: flex; align-items: center; justify-content: center;">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<main class="container p-0" style="margin-top: 150px!important; margin-bottom: 30px">
    <div class="main-content container-fluid" style="margin-top: -30px">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="page-head p-0 mb-3">
                    <h2 class="page-head-title">Tra cứu lịch khám</h2>
                </div>
                <div class="card card-table">
                    <div class="card-body">
                        <div class="row table-filters-container justify-content-sm-between">
                            <div class="col-4 table-filters pb-0">
                                <div class="filter-container">
                                    <div class="row">
                                        <div class="col-12">
                                            <input id="searchInput" type="tel" placeholder="Nhập số điện thoại..."
                                                   autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 table-filters pb-0">
                                <div class="filter-container">
                                    <button id="btnSearch" type="button" class="btn btn-success form-control">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="noSwipe">
                                <table class="table table-striped table-hover be-table-responsive" id="table1">
                                    <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:15%;">Bác sĩ</th>
                                        <th style="width:12%;">Bệnh nhân</th>
                                        <th style="width:12%;">Thông tin liên hệ</th>
                                        <th style="width:15%;">Chuyên khoa khám</th>
                                        <th style="width:10%;">Thời gian khám</th>
                                        <th style="width:10%;" class="text-center">Trạng thái</th>
                                        <th style="width:10%;" class="text-center">Kết quả</th>
                                        <th style="width:2%;"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="resultTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php include "components/footer.html" ?>

<script src="http://localhost/Medicare/views/admin/assets/lib\jquery\jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="http://localhost/Medicare/assets/js/toast/use-bootstrap-toaster.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('loading-spinner').style.display = 'none';

        const btnSearch = document.getElementById('btnSearch');
        const searchInput = document.getElementById('searchInput');
        const loadingSpinner = document.getElementById('loading-spinner');

        // Hàm throttle
        function throttle(func, limit) {
            let lastFunc;
            let lastRan;
            return function() {
                const context = this;
                const args = arguments;
                if (!lastRan) {
                    func.apply(context, args);
                    lastRan = Date.now();
                } else {
                    clearTimeout(lastFunc);
                    lastFunc = setTimeout(function() {
                        if ((Date.now() - lastRan) >= limit) {
                            func.apply(context, args);
                            lastRan = Date.now();
                        }
                    }, limit - (Date.now() - lastRan));
                }
            }
        }

        // Hàm xử lý tìm kiếm
        function handleSearch() {
            loadingSpinner.style.display = 'block';
            $.ajax({
                url: 'http://localhost/Medicare/index.php?controller=patient&action=search',
                type: 'POST',
                data: {
                    phone: searchInput.value
                },
                success: function (response) {
                    updateTable(response);
                    loadingSpinner.style.display = 'none';
                },
                error: function (error) {
                    failed_toast();
                    loadingSpinner.style.display = 'none';
                },
            });
        }

        btnSearch.addEventListener('click', throttle(handleSearch, 5000));

    });

    function updateTable(appointments) {
        const resultTable = document.getElementById('resultTable');
        resultTable.innerHTML = ''; // Xóa nội dung hiện tại của bảng

        if (appointments.length === 0) {
            // Nếu không có dữ liệu, hiển thị thông báo
            const noDataRow = document.createElement('tr');
            noDataRow.innerHTML = `<td colspan="9" class="text-center">Không có dữ liệu</td>`; // Sử dụng colspan để thông báo chiếm toàn bộ hàng
            resultTable.appendChild(noDataRow);
        } else {
            // Nếu có dữ liệu, tạo hàng cho mỗi cuộc hẹn
            appointments.forEach((appointment, index) => {
                const row = document.createElement('tr');
                row.className = getStatusClass(appointment.status); // Hàm này cần được định nghĩa để xác định class dựa trên trạng thái

                // Tạo các ô cho mỗi cột trong bảng
                row.innerHTML = `
                <td style="text-align: center">${index + 1}</td>
                <td class="user-avatar cell-detail user-info">
                    <img class="mt-0 mt-md-2 mt-lg-0" src="${appointment.doctor_avt}" alt="Avatar">
                    <span>${appointment.doctor_name}</span>
                </td>
                <td class="cell-detail milestone">
                    <span class="completed"></span>
                    <span class="cell-detail-description" style="font-size: 13px; color: black">${appointment.patient_name}</span>
                </td>
                <td class="milestone">
                    <div>${appointment.patient_phone}</div>
                    <span class="version">${appointment.patient_email}</span>
                </td>
                <td class="cell-detail">
                    <span>${appointment.specialty_name}</span>
                </td>
                <td class="cell-detail">
                    <span class="date">${formatTime(appointment.time_slot)}</span>
                    <span class="cell-detail-description">${formatDate(appointment.date_slot)}</span>
                </td>
                <td class="text-center">
                    <div class="btn btn-secondary" style="width: 150px; color: whitesmoke; font-weight: normal;
                            background-color: ${getStatusColor(appointment.status)[0]};">
                        ${getStatusColor(appointment.status)[1]}
                    </div>
                </td>
                <td class="text-center">
                    <div class="btn btn-secondary" style="width: 150px; color: whitesmoke; font-weight: normal;
                            background-color: ${getResultColor(appointment.result)[0]};">
                        ${getResultColor(appointment.result)[1]}
                    </div>
                </td>
                <td class="p-0">
                    <div class="btn-group">
                        <button id="btn-action"
                                style="border: none; background-color: transparent;"
                                class="dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm0-5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm0 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a type="button" class="dropdown-item"
                               href="http://localhost/Medicare/index.php?controller=appointment&action=detail_client&id=${appointment.id}">Chi tiết</a>
                        </div>
                    </div>
                </td>
            `;

                resultTable.appendChild(row); // Thêm hàng mới vào bảng
            });
        }
    }

    function getStatusClass(status) {
        // Hàm này trả về class phù hợp với trạng thái
        switch (status) {
            case 0: return 'warning in-progress';
            case 1: return 'primary to-do';
            case 2: return 'success done';
            case 3: return 'danger in-review';
            default: return '';
        }
    }

    function getStatusColor(status) {
        // Hàm này trả về màu và mô tả cho trạng thái
        const statusColors = {
            0: ['#fbbc05', 'Chờ xác nhận'],
            1: ['#4285f4', 'Đã xác nhận'],
            2: ['#34a853', 'Đã hoàn thành'],
            3: ['#ea4335', 'Đã hủy'],
            default: ['#d3d3d3', 'Không xác định']
        };
        return statusColors[status] || statusColors.default;
    }

    function getResultColor(result) {
        // Hàm này trả về màu và mô tả cho kết quả
        const resultColors = {
            true: ['#34a853', 'Đã có kết quả'],
            false: ['#d3d3d3', 'Chờ kết quả'],
            default: ['#d3d3d3', 'Không xác định']
        };
        return result ? resultColors.true : resultColors.false;
    }

    function formatDate(dateSlot) {
        // Hàm này chuyển đổi date_slot thành định dạng ngày tháng
        const timestamp = dateSlot * 86400;
        return new Date(timestamp * 1000).toLocaleDateString('vi-VN');
    }

    function formatTime(timeSlot) {
        // Hàm này chuyển đổi time_slot thành định dạng giờ
        return new Date('1970-01-01T' + timeSlot + 'Z').toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    }
</script>
<script>
    function success_toast(redirectUrl) {
        toast({
            classes: `text-bg-success border-0`,
            body: `
          <div class="d-flex w-100" data-bs-theme="dark">
            <div class="flex-grow-1">
              Cập nhật thành công !
            </div>
            <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>`,
            autohide: true,
            delay: 800
        });

        // Đợi DOM cập nhật
        setTimeout(() => {
            // Lấy phần tử toast mới nhất
            var toastElement = document.querySelector('.toast.show');
            if (toastElement) {
                var bsToast = new bootstrap.Toast(toastElement); // Khởi tạo lại đối tượng Toast nếu cần
                toastElement.addEventListener('hidden.bs.toast', function () {
                    window.location.href = redirectUrl; // Sử dụng URL được truyền vào
                });
            }
        }, 100); // Đợi 100ms để đảm bảo toast đã được thêm vào DOM
    }

    function failed_toast() {
        toast({
            classes: `text-bg-danger border-0`,
            body: `
              <div class="d-flex w-100" data-bs-theme="dark">
                <div class="flex-grow-1">
                  Đã có lỗi xảy ra !
                </div>
                <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>`,
        })
    }
</script>
</body>
</html>