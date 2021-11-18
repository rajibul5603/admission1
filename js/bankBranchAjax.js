$.ajaxSetup({
    headers: { "X-CSRF-Token": "" },
});

$("#district_id_account").on("change", function () {
    let dist_id = $(this).val();
    let bank_id = $("#bank_name_id").val();

    getBankBranches(dist_id, bank_id);
});

$("#bank_name_id").on("change", function () {
    let dist_id = $("#district_id_account").val();
    let bank_id = $("#bank_name_id").val();

    getBankBranches(dist_id, bank_id);
});

//  upzila wise Institute function ajax calll function
function getBankBranches(dist_id, bank_id) {
    let base_url = window.location.origin;
    let bankBranchurl = base_url + "/findBankBranchName";
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    console.log("Entered. URL= " + bankBranchurl);
    $.post(
        bankBranchurl,
        {
            bank_id: bank_id,
            district_id: dist_id,
            _token: csrfToken,
        },
        function (data, status) {
            var outputbranchID = "";
            console.log(status);

            $("#bank_branch_id").find("*").not("#nullValueOption").remove();
            // $("#bank_branch_id").empty();
            $("#routing_no_id").val("");
            $("#branch_code_id").val("");

            for (var i = 0; i < data.length; i++) {
                outputbranchID +=
                    '<option value="' +
                    data[i].id +
                    '">' +
                    data[i].branch_name +
                    " (" +
                    data[i].routing_number +
                    ")";
                ("</option>");
            }

            $("#bank_branch_id").append(outputbranchID);
        }
    );
}

// Bank Routing Number and Branch Code

$("#bank_branch_id").on("change", function () {
    let bank_branch_id = $(this).val();
    // getBankRoutingNumber(bank_branch_id);

    let base_url = window.location.origin;
    let routingURL = base_url + "/findBankRoutingNumber";
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    console.log("Entered. URL= " + routingURL);

    $.post(
        routingURL,
        {
            bank_branch_id: bank_branch_id,
            _token: csrfToken,
        },
        function (data, status) {
            console.log(data);

            $("#routing_no_id").val(data.routing_number);
            $("#branch_code_id").val(data.branch_code);

            $("#routing_no_id").prop("readonly", true);
            $("#branch_code_id").prop("readonly", true);
        }
    );
});
