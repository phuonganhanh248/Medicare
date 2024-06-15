<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm mới bác sĩ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 row">
                    <div class="col-6">
                        <label for="emName" class="form-label">Tên bác sĩ *</label>
                        <input type="text" class="form-control" id="emName" placeholder="Nhập tên bác sĩ mới" autocomplete="off">
                        <span style="margin-left: 10px; color: red" id="errorEmName"></span>
                    </div>
                    <div class="col-2 p-0">
                        <label for="emGender" class="form-label">Giới tính</label>
                        <select id="emGender" class="form-select mb-3" aria-label="Large select example" style="height: 50px">
                            <option value="1" selected>Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="emDob" class="form-label">Ngày sinh *</label>
                        <input type="date" class="form-control" id="emDob" autocomplete="off">
                        <span style="margin-left: 10px; color: red" id="errorEmDob"></span>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-6">
                        <label for="emEmail" class="form-label">Email *</label>
                        <input type="text" class="form-control" id="emEmail" placeholder="Nhập email" autocomplete="off">
                        <span style="margin-left: 10px; color: red" id="errorEmEmail"></span>
                    </div>
                    <div class="col-6">
                        <label for="emPhone" class="form-label">Số điện thoại *</label>
                        <input type="text" class="form-control" id="emPhone" placeholder="Nhập số điện thoại" autocomplete="off">
                        <span style="margin-left: 10px; color: red" id="errorEmPhone"></span>
                    </div>
                </div>
                <div class="mb-1 row">
                    <div class="col-9">
                        <label for="emAddress" class="form-label">Địa chỉ *</label>
                        <input type="text" class="form-control" id="emAddress" placeholder="Nhập địa chỉ bác sĩ" autocomplete="off">
                        <span style="margin-left: 10px; color: red" id="errorEmAddress"></span>
                    </div>
                    <div class="col-3">
                        <label for="emStatus" class="form-label">Trạng thái</label>
                        <select id="emStatus" class="form-select mb-3" aria-label="Large select example" style="height: 50px">
                            <option value="0">Đóng</option>
                            <option value="1" selected>Mở</option>
                        </select>
                    </div>
                </div>
                <div class="mb-1 row">
                    <div class="col-5">
                        <label for="emSpecialty" class="form-label">Chuyên khoa *</label>
                        <select id="emSpecialty" class="form-select" aria-label="Large select example" style="height: 50px">
                            <option hidden="hidden" value="0">Chọn chuyên khoa</option>
                            <?php
                            foreach ($listSpecialties as $specialty) {
                                echo "<option value='" . htmlspecialchars($specialty['specialty_id']) . "'>" . htmlspecialchars($specialty['name']) . "</option>";
                            }
                            ?>
                        </select>
                        <span style="margin-left: 10px; color: red" id="errorEmSpecialty"></span>
                    </div>
                    <div class="col-7">
                        <div class="mb-3">
                            <label for="emAvt" class="form-label">Tải lên ảnh</label>
                            <input class="form-control" type="file" id="emAvt">
                            <span style="margin-left: 10px; color: red" id="errorEmAvt"></span>
                        </div>
                    </div>
                </div>
                <strong class="pl-3"><i>* Mật khẩu mặc định là: Abc12345</i></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="btnAddEm" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </div>
</div>