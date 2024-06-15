function validateAppointment(specialId, doctorId, dateSlot, timeSlotId) {
    var errorSpecialty = document.getElementById('error-specialty');
    if (!specialId) {
        errorSpecialty.style.display = 'block';
        errorSpecialty.textContent = 'Vui lòng chọn chuyên khoa khám'
        return false;
    } else {
        errorSpecialty.style.display = 'none';
    }

    var errorDoctor = document.getElementById('error-doctor');
    if (!doctorId) {
        errorDoctor.style.display = 'block';
        errorDoctor.textContent = 'Vui lòng chọn bác sĩ'
        return false;
    } else {
        errorDoctor.style.display = 'none';
    }

    var errorDate = document.getElementById('error-date');
    if (!dateSlot) {
        errorDate.style.display = 'block';
        errorDate.textContent = 'Vui lòng chọn ngày khám'
        return false;
    } else {
        errorDoctor.style.display = 'none';
    }

    var errorTime = document.getElementById('error-time');
    if (!timeSlotId) {
        errorTime.style.display = 'block';
        errorTime.textContent = 'Vui lòng chọn gi khám'
        return false;
    } else {
        errorTime.style.display = 'none';
    }
    return true;
}

function validatePatientInfo(patientName, patientGender, patientDob, patientPhone, patientEmail, patientDescription) {

    // Kiểm tra tên bệnh nhân
    var errorName = document.getElementById('error-name-gender');
    if (!patientName || patientName.length < 5 || patientName.length > 100) {
        errorName.style.display = 'block';
        errorName.textContent = 'Tên có độ dài từ 5 đến 100 kí tự'
        return false;
    } else {
        errorName.style.display = 'none';
    }

    // Kiểm tra giới tính bệnh nhân
    if (!patientGender) {
        errorName.style.display = 'block';
        errorName.textContent = 'Vui lòng chọn giới tính'
        return false;
    } else {
        errorName.style.display = 'none';
    }

    // Kiểm tra ngày sinh
    var errorDob = document.getElementById('error-dob');
    if (!patientDob) {
        errorDob.style.display = 'block';
        errorDob.textContent = 'Vui lòng chọn ngày sinh';
        return false;
    } else {
        errorDob.style.display = 'none';
    }

    const dob = new Date(patientDob);
    const now = new Date();
    const oneYearAgo = new Date(now.getFullYear() - 1, now.getMonth(), now.getDate());


    if ( dob >= oneYearAgo) {
        errorDob.style.display = 'block';
        errorDob.textContent = 'Vui lòng chọn ngày sinh hợp lệ';
        return false;
    } else {
        errorDob.style.display = 'none';
    }

    // Kiểm tra số điện thoại
    var errorPhone = document.getElementById('error-phone');
    const phoneRegex = /^(0|\+84)(3[2-9]|5[689]|7[06-9]|8[1-689]|9[0-46-9])[0-9]{7}$/;
    if (!patientPhone || !phoneRegex.test(patientPhone)) {
        errorPhone.style.display = 'block';
        errorPhone.textContent = 'Vui lòng nhập số điện thoại hợp lệ'
        return false;
    } else {
        errorPhone.style.display = 'none';
    }

    // Kiểm tra email
    var errorEmail = document.getElementById('error-email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!patientEmail || !emailRegex.test(patientEmail)) {
        errorEmail.style.display = 'block';
        errorEmail.textContent = 'Vui lòng nhập email hợp lệ'
        return false;
    } else {
        errorEmail.style.display = 'none';
    }

    // Kiểm tra mô tả bệnh nhân
    var errorDes = document.getElementById('error-description');
    if (patientDescription.length > 500) {
        errorDes.style.display = 'block';
        errorDes.textContent = 'Vui lòng mô tả triệu trứng ngắn gọn dưới 500 kí tự'
        return false;
    } else {
        errorDes.style.display = 'none';
    }

    return true;
}