<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lịch Khám</title>
    <link href="assets/img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/appointment.css" rel="stylesheet">

    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Thêm jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<?php include "components/topbar.php" ?>
<?php include "components/header.php" ?>
<div id="loading-spinner" style="text-align: center; line-height: 700px; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1051; display: none; align-items: center; justify-content: center;">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<main id="main">
    <section class="container" style="padding-top: 150px">
        <h2>Đặt Lịch Khám</h2>
        <hr>
        <form method="GET" action="#">
            <div id="form-time-container">
                <?php include "components/form-time.php" ?>
            </div>
            <div id="form-info-container">
                <?php include "components/form-information.php" ?>
            </div>
        </form>
    </section>
</main>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Kiểm tra lịch khám</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="mb-2">
                        <label for="conName" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="conName" disabled>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-7">
                            <label for="conDob" class="form-label">Ngày sinh</label>
                            <input type="text" class="form-control" id="conDob" disabled>
                        </div>
                        <div class="col-5">
                            <label for="conGender" class="form-label">Giới tính</label>
                            <input type="text" class="form-control" id="conGender" disabled>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-6">
                            <label for="conEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="conEmail" disabled>
                        </div>
                        <div class="col-6">
                            <label for="conPhone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="conPhone" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2">
                        <label for="conNameDoctor" class="form-label">Tên bác sĩ</label>
                        <input type="text" class="form-control" id="conNameDoctor" disabled>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-6">
                            <label for="conSpecialty" class="form-label">Chuyên khoa khám</label>
                            <input type="text" class="form-control" id="conSpecialty" disabled>
                        </div>
                        <div class="col-6">
                            <label for="conTime" class="form-label">Thời gian khám</label>
                            <input style="background-color: #61d4d8" type="text" class="form-control" id="conTime"
                                   disabled>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="conDescription" class="form-label">Lý do khám</label>
                        <textarea class="form-control" rows="2" id="conDescription" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button id="submit-button" class="btn btn-success" type="button"
                        style="background-color:#3fbbc0 !important; font-weight: bold; border: none">
                    Đặt lịch
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="informationNoti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Thông tin không đầy đủ để tự động điền, bạn cần bổ sung thông tin tài khoản.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a href="http://localhost/Medicare/index.php?controller=patient&action=profile" class="btn btn-primary">Thêm thông tin tài khoản</a>
            </div>
        </div>
    </div>
</div>
<?php include "components/footer.html" ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Thêm JavaScript của jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/appointment.js"></script>
<script src="assets/js/validate-appointment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="http://localhost/Medicare/assets/js/toast/use-bootstrap-toaster.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('loading-spinner').style.display = 'none';

        const formTimeContainer = document.getElementById('form-time-container');
        const formInfoContainer = document.getElementById('form-info-container');
        const buttonAction = document.getElementById('action-button');

        var informationNoti = new bootstrap.Modal(document.getElementById('informationNoti'));
        // Ban đầu ẩn form thông tin
        formInfoContainer.style.display = 'none';

        document.getElementById('backAppointment').addEventListener('click' , function (){
            formTimeContainer.style.display = 'block';
            formInfoContainer.style.display = 'none';
        });

        const patientId = <?php echo isset($_SESSION['patient_id']) ? json_encode($_SESSION['patient_id']) : 'null'; ?>;
        var autoInformationButton = document.getElementById('autoInformation');


        if (patientId !== null) {
            autoInformationButton.style.display = 'block';
        } else {
            autoInformationButton.style.display = 'none';
        }

        document.getElementById('autoInformation').addEventListener('click', function () {
            document.getElementById('loading-spinner').style.display = 'block';
            $.ajax({
                url: 'http://localhost/Medicare/index.php?controller=patient&action=get_one',
                type: 'POST',
                data: {
                    patient_id: patientId
                },
                success: function (response) {
                    if (response.name && response.gender && response.dob && response.email && response.phone) {
                        document.getElementById('patient-name').value = response.name;
                        document.querySelector('input[name="gender"][value="' + response.gender + '"]').checked = true;
                        document.getElementById('patient-dob').value = response.dob;
                        document.getElementById('patient-phone').value = response.phone;
                        document.getElementById('patient-email').value = response.email;

                        document.getElementById('loading-spinner').style.display = 'none';
                        document.getElementById('autoInformation').style.display = 'none';
                        success_toast_2('Điền thông tin thành công')
                    } else {
                        informationNoti.show()
                        document.getElementById('loading-spinner').style.display = 'none';
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                    failed_toast()
                }
            });
        });

        // Kiểm tra các giá trị khi nút được nhấn
        buttonAction.addEventListener('click', function () {
            var specialId = document.getElementById('selected-specialty')?.value;
            var doctorId = document.getElementById('selected-doctor')?.value;
            var dateSlot = document.getElementById('date-slot')?.value;
            var timeSlotId = document.getElementById('time-slot')?.value;

            console.log(validateAppointment(specialId, doctorId, dateSlot, timeSlotId))
            // Kiểm tra nếu một trong các giá trị là rỗng
            if (validateAppointment(specialId, doctorId, dateSlot, timeSlotId)) {
                buttonAction.disabled = false; // Enable nút
                // Ẩn form thời gian và hiển thị form thông tin
                formTimeContainer.style.display = 'none';
                formInfoContainer.style.display = 'block';
            }
        });
    });
</script>
<script>
    const openConfirm = document.getElementById('openConfirm');
    const submitButton = document.getElementById('submit-button');

    openConfirm.addEventListener('click', () => {
        var specialId = parseInt(document.getElementById('selected-specialty')?.value, 10);
        var doctorId = parseInt(document.getElementById('selected-doctor')?.value, 10);
        var dateSlot = parseInt(document.getElementById('date-slot')?.value, 10);
        var timeSlotId = parseInt(document.getElementById('time-slot')?.value, 10);
        var patientName = document.getElementById('patient-name')?.value;
        var patientGender = parseInt(document.querySelector('input[name="gender"]:checked')?.value, 10);
        var patientDob = document.getElementById('patient-dob')?.value;
        var patientPhone = document.getElementById('patient-phone')?.value;
        var patientEmail = document.getElementById('patient-email')?.value;
        var patientDescription = document.getElementById('patient-description')?.value;

        // console.log('patientId:', patientId);
        console.log('specialId:', specialId);
        console.log('doctorId:', doctorId);
        console.log('dateSlot:', dateSlot);
        console.log('timeSlotId:', timeSlotId);
        console.log('patientName:', patientName);
        console.log('patientGender:', patientGender);
        console.log('patientDob:', patientDob);
        console.log('patientPhone:', patientPhone);
        console.log('patientEmail:', patientEmail);
        console.log('patientDescription:', patientDescription);

        if(validatePatientInfo(patientName, patientGender, patientDob, patientPhone, patientEmail, patientDescription)) {
            document.getElementById('conName').value = patientName;
            document.getElementById('conDob').value = patientDob;
            document.getElementById('conGender').value = patientGender === 1 ? 'Nam' : 'Nữ';
            document.getElementById('conPhone').value = patientPhone;
            document.getElementById('conEmail').value = patientEmail;
            document.getElementById('conNameDoctor').value = document.getElementById('selected-doctor-name').value;
            document.getElementById('conSpecialty').value = document.getElementById('selected-specialty-name').value;
            document.getElementById('conTime').value = document.getElementById('selected-time-slot').value
                + ', '
                + document.getElementById('selected-date-slot').value;
            document.getElementById('conDescription').value = patientDescription;

            // Hiển thị modal
            var modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            modal.show();
        }

        submitButton.addEventListener('click', () => {
            if (validatePatientInfo(patientName, patientGender, patientDob, patientPhone, patientEmail, patientDescription)) {
                document.getElementById('loading-spinner').style.display = 'block';
                $.ajax({
                    url: 'http://localhost/Medicare/index.php',
                    type: 'POST',
                    data: {
                        controller: 'appointment',
                        action: 'create',
                        specialId: specialId,
                        doctorId: doctorId,
                        dateSlot: dateSlot,
                        timeSlotId: timeSlotId,
                        patientName: patientName,
                        patientGender: patientGender,
                        patientDob: patientDob,
                        patientPhone: patientPhone,
                        patientEmail: patientEmail,
                        patientDescription: patientDescription,
                    },
                    success: function (message) {
                        console.log(message);
                        success_toast('http://localhost/Medicare/index.php?controller=home&action=home')
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        failed_toast('Có lỗi xảy ra khi tạo lịch hẹn.')
                    },
                });
            }
        })
    });

</script>
<script>
    function success_toast(redirectUrl) {
        toast({
            classes: `text-bg-success border-0`,
            body: `
          <div class="d-flex w-100" data-bs-theme="dark">
            <div class="flex-grow-1">
              Đặt lịch khám thành công !
            </div>
            <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>`,
            autohide: true,
            delay: 1000
        });

        setTimeout(() => {
            var toastElement = document.querySelector('.toast.show');
            if (toastElement) {
                var bsToast = new bootstrap.Toast(toastElement);
                toastElement.addEventListener('hidden.bs.toast', function () {
                    window.location.href = redirectUrl;
                });
            }
        }, 100);
    }

    function success_toast_2(message) {
        toast({
            classes: `text-bg-success border-0`,
            body: `
          <div class="d-flex w-100" data-bs-theme="dark">
            <div class="flex-grow-1">
              ${message}
            </div>
            <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>`,
            autohide: true,
            delay: 1000
        });
    }

    function failed_toast(message) {
        toast({
            classes: `text-bg-danger border-0`,
            body: `
              <div class="d-flex w-100" data-bs-theme="dark">
                <div class="flex-grow-1">
                  ${message}
                </div>
                <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>`,
        })
    }
</script>
</body>
</html>