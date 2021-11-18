$(document).on("change", "#education_level_id", function () {
    let education_level_id = $(this).val();

    if (education_level_id == "") education_level_id = 0;

    getLevelWiseClassList(education_level_id);
});

function getLevelWiseClassList(id) {
    var base_url = window.location.origin;
    let url = base_url + "/findLevelWiseClass";
    let educationLevelUrl = url + "/" + id;
    let output = "";

    console.log("Taken ID= " + educationLevelUrl);
    $.get(educationLevelUrl)
        .always(function () {
            $("#class_name_id").empty();
        })
        .done(function (data) {
            for (var i = 0; i < data.length; i++) {
                console.log(data[i].class_name);
                output +=
                    '<option value="' +
                    data[i].id +
                    '">' +
                    data[i].class_name +
                    "</option>";
            }
            $("#class_name_id").append(output);
        });
}
