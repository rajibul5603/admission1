$.ajaxSetup({
    headers: { "X-CSRF-Token": "" },
});

$(document).on("change", "#institute_division", function () {
    let division_id = $(this).val();

    if (division_id == "") division_id = 0;
    getInstituteDistrict(division_id);
});

$(document).on("change", "#institute_district", function () {
    let district_id = $(this).val();

    if (district_id == 0) district_id = 0;

    getInstituteUpazila(district_id);
});

//  when upazila id Change it will popup institute information of that upazila
$(document).on("change", "#institute_upazila", function () {
    let upazila_id = $(this).val();
    let district_id = $("#institute_district").val();
    let division_id = $("#institute_division").val();
    // console.log("division_id= " + division_id);

    getEducationInstitute(division_id, district_id, upazila_id);
});

//  when Institute Name Change it will popup institute EIIN No
$(document).on("change", "#institute_name_id", function () {
    let institute_name_id = $(this).val();

    //console.log(institute_name_id);

    getEducationInstituteEIIN(institute_name_id);
});

//    Institute's EIIN Number function ajax calll function
function getEducationInstituteEIIN(institute_name_id) {
    let base_url = window.location.origin;
    let institute_name_url = base_url + "/findUpazilaWiseInstitute";
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    // console.log("Entered. Upazila= " + upa_id);
    if (institute_name_id == "") {
        institute_name_id = 0;
    }
    $.post(
        institute_name_url,
        {
            institute_name_id: institute_name_id,
            _token: csrfToken,
        },
        function (data, status) {
            console.log(data);
            $("#eiin_id").val(data.institution_eiin_no);
            $("#eiin_account").val(data.institution_eiin_no);
            $("#eiin_id").prop("readonly", true);
            $("#eiin_account").prop("readonly", true);
        }
    );
}

//  upzila wise Institute function ajax calll function
function getEducationInstitute(div_id, dist_id, upa_id) {
    let base_url = window.location.origin;
    let upazilaWiseInstituteurl = base_url + "/findUpazilaWiseInstitute";
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    // console.log("Entered. Upazila= " + upa_id);
    $.post(
        upazilaWiseInstituteurl,
        {
            division_id: div_id,
            district_id: dist_id,
            upazila_id: upa_id,
            _token: csrfToken,
        },
        function (data, status) {
            var outputInstitute_name_id = "";

            //  console.log(data);

            $("#institute_name_id").find("*").not("#nullValueOption").remove();
            $("#eiin_id").val("");
            $("#eiin_account").val("");

            console.log("Data: " + data.length + "\nStatus: " + status);
            for (var i = 0; i < data.length; i++) {
                outputInstitute_name_id +=
                    '<option value="' +
                    data[i].id +
                    '">' +
                    data[i].institution_name +
                    " (" +
                    data[i].institution_eiin_no +
                    ")" +
                    "</option>";
            }

            $("#institute_name_id").append(outputInstitute_name_id);
        }
    );
}

//  upzila ajax calll function
function getInstituteUpazila(id) {
    var base_url = window.location.origin;
    let url = base_url + "/findUpazilaName";
    let upazilaUrl = url + "/" + id;
    let output = "";

    $.get(upazilaUrl)
        .always(function () {
            $("#institute_upazila").find("*").not("#nullValueOption").remove();
            $("#institute_name_id").find("*").not("#nullValueOption").remove();
            $("#eiin_id").val("");
            $("#eiin_account").val("");
        })
        .done(function (data) {
            for (var i = 0; i < data.length; i++) {
                console.log(data[i].upazila_name);
                output +=
                    '<option value="' +
                    data[i].id +
                    '">' +
                    data[i].upazila_name +
                    "</option>";
            }
            $("#institute_upazila").append(output);
        });
}

// district function ajax
function getInstituteDistrict(id) {
    var base_url = window.location.origin;
    let url = base_url + "/findDistrictName";
    let districtUrl = url + "/" + id;
    let output = "";

    $.get(districtUrl)
        .always(function () {
            $("#institute_district").find("*").not("#nullValueOption").remove();
            $("#institute_upazila").find("*").not("#nullValueOption").remove();
            $("#institute_name_id").find("*").not("#nullValueOption").remove();
            $("#eiin_id").val("");
            $("#eiin_account").val("");
        })
        .done(function (data) {
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                output +=
                    '<option value="' +
                    data[i].id +
                    '">' +
                    data[i].district_name +
                    "</option>";
            }
            $("#institute_district").append(output);
        });
}
