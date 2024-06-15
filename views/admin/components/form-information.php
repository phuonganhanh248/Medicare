<div class="row">
    <hr>
    <h4 class="col-12"><strong>Nhập thông tin cá nhân</strong></h4>
    <div class="col-6">
        <div class="row mb-2">
            <div class="col-8">
                <div class="input-group-sm">
                    <input type="text" class="form-control" id="patient-name" placeholder="Nhập họ và tên (*)">
                </div>
                <span id="error-name-gender" class="ml-2" style="color: red; display: none"></span>
            </div>
            <div class="col-4 text-center row">
                <div class="col-6 m-0 p-0">
                    <input type="radio" id="male" name="gender" value="1"
                           style="width: 14px; height: 14px;">
                    <label for="male">Nam</label>
                </div>
                <div class="col-6 m-0 p-0">
                    <input type="radio" id="female" name="gender" value="0"
                           style="width: 14px; height: 14px;">
                    <label for="female">Nữ</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4 m-0 p-0 ml-3">
                <div class="input-group-sm">
                    <input type="date" class="form-control" id="patient-dob" placeholder="Ngày sinh (*)">
                </div>
                <span id="error-dob" class="ml-2" style="color: red; display: none"></span>
            </div>
            <div class="col-7 m-0 p-0 ml-4">
                <div class="input-group-sm">
                    <input type="text" class="form-control" id="patient-phone"
                           placeholder="Nhập số điện thoại(*)">
                </div>
                <span id="error-phone" class="ml-2" style="color: red; display: none"></span>
            </div>
        </div>
        <div class="mb-2" style="margin-bottom: 0!important;">
            <div class="input-group-sm">
                <input type="email" class="form-control" id="patient-email"
                       placeholder="Để lại email để nhận thông tin lịch hẹn">
            </div>
            <span id="error-email" class="ml-2" style="color: red;"></span>
        </div>
        <div class="row" style="margin-top:-8px!important; padding-left: 2px">
            <div class="col-3">
                <p style="margin-top: 8px">Trạng thái</p>
            </div>
            <div class="col-9">
                <select id="status-appointment" class="form-select" aria-label="Small select example" style="background-color: #61d4d8">
                    <option selected hidden="true">Chọn trạng thái</option>
                    <option value="0">Chờ xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Hoàn thành</option>
                    <option value="3">Đã hủy</option>
                </select>
            </div>
            <span id="error-status" class="ml-2" style="color: red; display: none"></span>
        </div>
    </div>
    <div class="col-6 mb-2">
    <textarea class="form-control" id="patient-description" rows="7" style="resize: none"
              placeholder="Mô tả triệu chứng"></textarea>
        <span id="error-description" class="ml-2" style="color: red;"></span>
    </div>
</div>


