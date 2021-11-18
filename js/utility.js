function initDate(element, format, elementIcon, locale) {

//    console.log("element:"+JSON.stringify(element));
//    console.log("format:"+JSON.stringify(format));
//    console.log("elementIcon:"+JSON.stringify(elementIcon));
//    console.log("locale:"+JSON.stringify(locale));
//     console.log("initDate()");
    // element.datepicker("destroy");
    //element.datepicker("remove");
    //element.datepicker();
    //element.datepicker("disable");
    $("#ui-datepicker-div").remove();

    element.datepicker({
        closeOnDateSelect: true,
        todayButton: true,
        dateFormat: format,
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+1",
        autoclose: true,
        beforeShow: function (input, inst) {
            if (locale == 'bn') {
                element.val(getNumberInEnglish(element.val()));
            }
            // console.log("initDate() beforeShow");
        },
        onClose: function (dateText, datePickerInstance) {
            if (locale == 'bn') {
                element.val(getNumberInBangla(element.val()));
            }
            // console.log("initDate() onClose");
        }
    });
    if (typeof elementIcon !== 'undefined') {
        elementIcon.on("click", function () {
            element.datepicker('show');
            // console.log("initDate() show");

        });
    }
}

function initDateTime(element, format, elementIcon) {
    element.datetimepicker({
        closeOnDateSelect: true,
        todayButton: true,
        format: format
    });
    if (typeof elementIcon !== 'undefined') {
        elementIcon.on("click", function () {
            element.datetimepicker('show');
        });
    }
}

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth();
//    return months <= 0 ? 0 : months;
    return months;
}

function resetSelect(selectId) {
    selectId.find('option').remove();
    appendSelectInList(selectId);
    // $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(selectId);
}

function loadDivision(divisionSelectId, selectedDivision) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getDivision",
        async: false,
        dataType: "json",
        success: function (response) {
            divisionSelectId.find('option').remove();
            appendSelectInList(divisionSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(divisionSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(divisionSelectId);
                }
            });
            if (selectedDivision !== null) {
                divisionSelectId.val(selectedDivision);
            }
        },
        failure: function () {
            log("loading district failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}


function loadDivisionLocalStorage() {
    $.ajax({
        type: "POST",
        url: contextPath + "/getDivision",
        contentType: 'application/json',
        async: true,
        dataType: "json",
        success: function (response) {
            localStorage['Division'] = JSON.stringify(response);
        },
        failure: function () {
            log("loading district failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}

function loadDivisionLocalStorageXmlHttp() {

    theUrl = contextPath + "/getDivision";
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            localStorage['Division'] = xmlHttp.responseText;
//                alert(xmlHttp.responseText);
        } else {
            console.log("loading Division failed!!");
        }
    }
    xmlHttp.open("POST", theUrl, true); // true for asynchronous 
    xmlHttp.send();


}


function loadDistrictLocalStorage() {
    $.ajax({
        type: "POST",
        url: contextPath + "/getDistrict",
        contentType: 'application/json',
        async: true,
        dataType: "json",
        success: function (response) {
            localStorage['District'] = JSON.stringify(response);
        },
        failure: function () {
            log("loading District failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}


function loadDistrictLocalStorageXmlHttp() {

    theUrl = contextPath + "/getDistrict";
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            localStorage['District'] = xmlHttp.responseText;
//                alert(xmlHttp.responseText);
        } else {
            console.log("loading Division failed!!");
        }
    }
    xmlHttp.open("POST", theUrl, true); // true for asynchronous 
    xmlHttp.send();


}

function loadUpazilaLocalStorage() {
    $.ajax({
        type: "POST",
        url: contextPath + "/getUpazila",
        contentType: 'application/json',
        async: true,
        dataType: "json",
        success: function (response) {
            localStorage['Upazila'] = JSON.stringify(response);
        },
        failure: function () {
            log("loading Upazila failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}


function loadUpazilaLocalStorageXmlHttp() {

    theUrl = contextPath + "/getUpazila";
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            localStorage['Upazila'] = xmlHttp.responseText;
//                alert(xmlHttp.responseText);
        } else {
            console.log("loading Division failed!!");
        }
    }
    xmlHttp.open("POST", theUrl, true); // true for asynchronous 
    xmlHttp.send();


}

function loadUnionLocalStorage() {
    $.ajax({
        type: "POST",
        url: contextPath + "/getUnion",
        contentType: 'application/json',
        async: true,
        dataType: "json",
        success: function (response) {
            localStorage['Union'] = JSON.stringify(response);
        },
        failure: function () {
            log("loading Union failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}

function loadUnionLocalStorageXmlHttp() {

    theUrl = contextPath + "/getUnion";
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            localStorage['Union'] = xmlHttp.responseText;
//                alert(xmlHttp.responseText);
        } else {
            console.log("loading Division failed!!");
        }
    }
    xmlHttp.open("POST", theUrl, true); // true for asynchronous 
    xmlHttp.send();


}

function loadInstituteLocalStorage() {
    $.ajax({
        type: "POST",
        url: contextPath + "/getInstitute",
        contentType: 'application/json',
        async: true,
        dataType: "json",
        success: function (response) {
            localStorage['Institute'] = JSON.stringify(response);
        },
        failure: function () {
            log("loading Institute failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}


function loadInstituteLocalStorageXmlHttp() {

    theUrl = contextPath + "/getInstitute";
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            localStorage['Institute'] = xmlHttp.responseText;
//                alert(xmlHttp.responseText);
        } else {
            console.log("loading Division failed!!");
        }
    }
    xmlHttp.open("POST", theUrl, true); // true for asynchronous 
    xmlHttp.send();


}

function appendSelectInList(selectId) {
    // Not working first time
    // var select = messageResource.get('label.select', 'messages_' + selectedLocale);
    var select = (selectedLocale === 'en') ? '- Select -' : '- নির্বাচন করুন -';
    $('<option>').val("").text(select).appendTo(selectId);
}

function loadDistrict(divisionId, districtSelectId, selectedDistrict) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getDistrict/" + divisionId,
        async: false,
        dataType: "json",
        success: function (response) {
            districtSelectId.find('option').remove();
            appendSelectInList(districtSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(districtSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(districtSelectId);
                }
            });
            if (selectedDistrict !== null) {
                districtSelectId.val(selectedDistrict);
            }
        },
        failure: function () {
            log("loading district failed!!");
        }
    });
}


function loadDistrictAll(districtSelectId, selectedDistrict) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getDistrict",
        async: false,
        dataType: "json",
        success: function (response) {
            districtSelectId.find('option').remove();
            appendSelectInList(districtSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(districtSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(districtSelectId);
                }
            });
            if (selectedDistrict !== null) {
                districtSelectId.val(selectedDistrict);
            }
        },
        failure: function () {
            log("loading district failed!!");
        }
    });
}


function loadDivisionFromStorage(divisionSelectId, selectedDivision) {
    // console.log("loadDivisionFromStorage");

    divisionSelectId.find('option').remove();
    appendSelectInList(divisionSelectId);
    response = JSON.parse(localStorage['Division']);


    //response = filterUsingParentID(response, divisionId);

    $.each(response, function (index, value) {
//         console.log(JSON.stringify(index) + JSON.stringify(value));

        if (selectedLocale === 'en') {
            $('<option>').val(value.id).text(value.nameInEnglish).appendTo(divisionSelectId);
        } else if (selectedLocale === 'bn') {
            $('<option>').val(value.id).text(value.nameInBangla).appendTo(divisionSelectId);
        }
    });
    if (selectedDivision !== null) {
        divisionSelectId.val(selectedDivision);
    }

}


function loadDistrictFromStorage(divisionId, districtSelectId, selectedDistrict) {
    console.log("loadDistrictFromStorage");


    districtSelectId.find('option').remove();
    appendSelectInList(districtSelectId);
    response = JSON.parse(localStorage['District']);


    response = filterUsingParentID(response, divisionId);

    $.each(response, function (index, value) {
        // console.log(JSON.stringify(index) + JSON.stringify(value));

        if (selectedLocale === 'en') {
            $('<option>').val(value[0]).text(value[2]).appendTo(districtSelectId);
        } else if (selectedLocale === 'bn') {
            $('<option>').val(value[0]).text(value[1]).appendTo(districtSelectId);
        }
    });
    if (selectedDistrict !== null) {
        districtSelectId.val(selectedDistrict);
    }

}


function loadDistrictAllFromStorage(districtSelectId, selectedDistrict) {
    console.log("loadDistrictAllFromStorage");


    districtSelectId.find('option').remove();
    appendSelectInList(districtSelectId);
    response = JSON.parse(localStorage['District']);


//    response = filterUsingParentID(response, divisionId);

    $.each(response, function (index, value) {
        // console.log(JSON.stringify(index) + JSON.stringify(value));

        if (selectedLocale === 'en') {
            $('<option>').val(value[0]).text(value[2]).appendTo(districtSelectId);
        } else if (selectedLocale === 'bn') {
            $('<option>').val(value[0]).text(value[1]).appendTo(districtSelectId);
        }
    });
    if (selectedDistrict !== null) {
        districtSelectId.val(selectedDistrict);
    }

}


function loadUpazillaFromStorage(districtId, upazilaSelectId, selectedUpazila) {
    console.log("loadUpazillaFromStorage");

    upazilaSelectId.find('option').remove();
    appendSelectInList(upazilaSelectId);
    response = JSON.parse(localStorage['Upazila']);


    response = filterUsingParentID(response, districtId);

    $.each(response, function (index, value) {

        if (selectedLocale === 'en') {
            $('<option>').val(value[0]).text(value[2]).appendTo(upazilaSelectId);
        } else if (selectedLocale === 'bn') {
            $('<option>').val(value[0]).text(value[1]).appendTo(upazilaSelectId);
        }
    });
    if (selectedUpazila !== null) {
        upazilaSelectId.val(selectedUpazila);
    }

}


function loadInstituteFromStorage(UpazilaId, instituteSelectId, selectedInstitute) {
    console.log("loadInstituteFromStorage");

    instituteSelectId.find('option').remove();
    appendSelectInList(instituteSelectId);
    response = JSON.parse(localStorage['Institute']);

    response = filterUsingParentID(response, UpazilaId);

    $.each(response, function (index, value) {
        //console.log(JSON.stringify(value));
        $('<option>').val(value[0]).text(value[2]).appendTo(instituteSelectId);
//        if (selectedLocale === 'en') {
//            $('<option>').val(value[0]).text(value[2]).appendTo(instituteSelectId);
//        } else if (selectedLocale === 'bn') {
//            $('<option>').val(value[0]).text(value[1]).appendTo(instituteSelectId);
//        }
    });
    if (selectedInstitute !== null) {
        instituteSelectId.val(selectedInstitute);
    }

}

function loadInstituteFromStorageAll(instituteSelectId, selectedUpazila) {
    console.log("loadInstituteFromStorage");

    instituteSelectId.find('option').remove();
    appendSelectInList(instituteSelectId);
    response = JSON.parse(localStorage['Institute']);

    // response = filterUsingParentID(response, districtId);

    $.each(response, function (index, value) {
        //console.log(JSON.stringify(value));
        $('<option>').val(value[0]).text(value[2]).appendTo(instituteSelectId);
//        if (selectedLocale === 'en') {
//            $('<option>').val(value[0]).text(value[2]).appendTo(instituteSelectId);
//        } else if (selectedLocale === 'bn') {
//            $('<option>').val(value[0]).text(value[1]).appendTo(instituteSelectId);
//        }
    });
    if (selectedUpazila !== null) {
        instituteSelectId.val(selectedUpazila);
    }

}


function loadInstituteByUpazilaFromStorageAll(upazId, instituteElementId, selectedUpazila) {
    console.log("loadInstituteFrom redis/db");
    var redisEnabled = false;
    if (redisEnabled) {
        $.ajax({
            type: "GET",
            url: contextPath + "/lookup/by/parent?parentId=" + upazId + "&key=hsp_institute", //Redis
            async: false,
            dataType: "json",
            success: function (response) {
//                console.log("redissssssss " + JSON.stringify(response));
                instituteElementId.find('option').remove();
                appendSelectInList(instituteElementId);

                $.each(response, function (index, value) {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(instituteElementId);
                });
                if (selectedUpazila !== null) {
                    instituteElementId.val(selectedUpazila);
                }
            },
            failure: function () {
                log("loading institute failed!!");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('error=' + xhr.responseText);
                console.log('error=' + thrownError);
            }
        });
    } else {
        $.ajax({
            type: "GET",
            url: contextPath + "/getInstitute?upazilaId=" + upazId, //DB
            async: false,
            dataType: "json",
            success: function (response) {
//                console.log("db " + JSON.stringify(response));
                instituteElementId.find('option').remove();
                appendSelectInList(instituteElementId);

                $.each(response, function (index, value) {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(instituteElementId);
                });
                if (selectedUpazila !== null) {
                    instituteElementId.val(selectedUpazila);
                }
            },
            failure: function () {
                log("loading institute failed!!");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('error=' + xhr.responseText);
                console.log('error=' + thrownError);
            }
        });
    }

}

var loaderStatus = false;

function checkLoader() {
    $("#loadMe").show();
    var interval = setInterval(function () {
        if (loaderStatus) {
            $("#loadMe").hide();
            clearInterval(interval);
        }
    }, 500);
}


function loader(flag) {
    if (flag) {
        $("#loadMe").show();
        var interval = setInterval(function () {
            if (loaderStatus) {
                $("#loadMe").hide();
                clearInterval(interval);
            }
        }, 500);
    } else {
        loaderStatus = true;
    }

}


function loadInstituteByUpazilaFromRedis(upazId, instituteElementId, selectedUpazila, institutesActive="active") {
    if (upazId === '') {
        return;
    }

    console.log("loadInstituteFrom redis/db");
    loaderStatus = false;
    checkLoader();

    $.ajax({
        type: "GET",
        //url: contextPath + "/lookup/by/parent?parentId=" + upazId + "&key=hsp_institute", //Redis
        url: contextPath + "/lookup/by/parent/institute?parentId=" + upazId + "&key=hsp_institute" + "&institutesActive=" + institutesActive, //Redis
        async: true,
        dataType: "json",
        success: function (response) {
            //console.log("redissssssss " + JSON.stringify(response));
            instituteElementId.find('option').remove();
            appendSelectInList(instituteElementId);

            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.code + " - " + value.nameInEnglish).appendTo(instituteElementId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.code + " - " + value.nameInBangla).appendTo(instituteElementId);
                }
            });
            if (selectedUpazila !== null) {
                instituteElementId.val(selectedUpazila);
            }
        },
        failure: function () {
            log("loading institute failed!!");
            loaderStatus = true;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
            loaderStatus = true;
        },
        complete: function () {
            loaderStatus = true;
        }
    });
}

function loadUnionFromStorage(upazilaId, unionSelectId, selectedUnion) {
    console.log("loadUnionFromStorage");

    unionSelectId.find('option').remove();
    appendSelectInList(unionSelectId);
    response = JSON.parse(localStorage['Union']);

    response = filterUsingParentID(response, upazilaId);

    $.each(response, function (index, value) {

        if (selectedLocale === 'en') {
            $('<option>').val(value[0]).text(value[2]).appendTo(unionSelectId);
        } else if (selectedLocale === 'bn') {
            $('<option>').val(value[0]).text(value[1]).appendTo(unionSelectId);
        }
    });
    if (selectedUnion !== null) {
        unionSelectId.val(selectedUnion);
    }
}


function filterUsingParentID(response, id) {

    response = $.grep(response, function (value, index) {

        return parseInt(value[3] + "") === parseInt(id);
    });

    return response;
}

function loadUpazilla(districtId, upazilaSelectId, selectedUpazila) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getUpazila/" + districtId,
        async: false,
        dataType: "json",
        success: function (response) {
            upazilaSelectId.find('option').remove();
            appendSelectInList(upazilaSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(upazilaSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(upazilaSelectId);
                }
            });
            if (selectedUpazila !== null) {
                upazilaSelectId.val(selectedUpazila);
            }
        },
        failure: function () {
            log("loading district failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });

}

function loadUnion(upazilaId, unionSelectId, selectedUnion) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getUnion/" + upazilaId,
        async: false,
        dataType: "json",
        success: function (response) {
            unionSelectId.find('option').remove();
            appendSelectInList(unionSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(unionSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(unionSelectId);
                }
            });
            if (selectedUnion !== null) {
                unionSelectId.val(selectedUnion);
            }
        },
        failure: function () {
            log("loading district failed!!");
        }
    });
}

function loadBank(bankSelectId, selectedBank) {
    var redisEnabled = false;
    if (redisEnabled) {
        $.ajax({
            type: "GET",
            url: contextPath + "/bank/all", //Redis
            async: false,
            dataType: "json",
            success: function (response) {
                bankSelectId.find('option').remove();
                appendSelectInList(bankSelectId);

                $.each(response, function (index, value) {
                    if (selectedLocale === 'en') {
                        $('<option>').val(value.id).text(value.nameInEnglish).appendTo(bankSelectId);
                    } else if (selectedLocale === 'bn') {
                        $('<option>').val(value.id).text(value.nameInBangla).appendTo(bankSelectId);
                    }
                });
                if (selectedBank !== null) {
                    bankSelectId.val(selectedBank);
                }
            },
            failure: function () {
                log("loading bank failed!!");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('error=' + xhr.responseText);
                console.log('error=' + thrownError);
            }
        });
    } else {
        $.ajax({
            type: "GET",
            url: contextPath + "/getBankList", //DB
            async: false,
            dataType: "json",
            success: function (response) {
                bankSelectId.find('option').remove();
                appendSelectInList(bankSelectId);

                //$('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(bankSelectId);
                $.each(response, function (index, value) {
                    if (selectedLocale === 'en') {
                        $('<option>').val(value.id).text(value.nameInEnglish).appendTo(bankSelectId);
                    } else if (selectedLocale === 'bn') {
                        $('<option>').val(value.id).text(value.nameInBangla).appendTo(bankSelectId);
                    }
                });
                if (selectedBank !== null) {
                    bankSelectId.val(selectedBank);
                }
            },
            failure: function () {
                log("loading bank failed!!");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('error=' + xhr.responseText);
                console.log('error=' + thrownError);
            }
        });
    }
}


function loadAgraniBank(bankSelectId, selectedBank) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getBankList",
        async: false,
        dataType: "json",
        success: function (response) {
            bankSelectId.find('option').remove();
            appendSelectInList(bankSelectId);

            //$('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(bankSelectId);
            $.each(response, function (index, value) {

                if (selectedLocale === 'en' && value.id == 1) {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(bankSelectId);
                } else if (selectedLocale === 'bn' && value.id == 1) {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(bankSelectId);
                }
            });
            if (selectedBank !== null) {
                bankSelectId.val(selectedBank);
            }
        },
        failure: function () {
            log("loading bank failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
}





function loadBranch(bankId, branchSelectId, selectedBranch) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getBranch/" + bankId, //DB
//        url: contextPath + "/getLookupBranch?bankId=" + bankId, //Redis
        async: false,
        dataType: "json",
        success: function (response) {
            branchSelectId.find('option').remove();
            appendSelectInList(branchSelectId);
            // $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(branchSelectId);
            $.each(response, function (index, value) {
                console.log(value.address);
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.address + ", " + value.nameInEnglish).appendTo(branchSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.address + ", " + value.nameInBangla).appendTo(branchSelectId);
                }
            });
            if (selectedBranch !== null) {
                branchSelectId.val(selectedBranch);
            }
        },
        failure: function () {
            log("loading branch failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
}

function loadBranchs(bankId, branchSelectId, selectedBranch, routingId) {
    var rn = 0;
    var redisEnabled = false;
    if (redisEnabled) {
        $.ajax({
            type: "GET",
            url: contextPath + "/getLookupBranch?bankId=" + bankId, //Redis ( need to reset redisEnabled flag true also)
            async: false,
            dataType: "json",
            success: function (response) {

                branchSelectId.find('option').remove();
                appendSelectInList(branchSelectId);
                // $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(branchSelectId);
                $.each(response, function (index, value) {

                    if (selectedLocale === 'en') {
                        $('<option>').val(value.id).text(value.nameInEnglish + " (" + value.routingNumber + "), " + value.address).appendTo(branchSelectId);
                    } else if (selectedLocale === 'bn') {
                        $('<option>').val(value.id).text(value.nameInBangla + " (" + value.routingNumber + "), " + value.address).appendTo(branchSelectId);
                    }

                    if (selectedBranch !== null && selectedBranch == value.id) {
                        rn = value.routingNumber;
                    }
                });

                if (selectedBranch !== null) {
                    branchSelectId.val(selectedBranch);
                }
            },
            failure: function () {
                alert("failed");
                log("loading branch failed!!");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error=" + xhr.responseText);
                alert("error=" + thrownError);
                console.log('error=' + xhr.responseText);
                console.log('error=' + thrownError);
            }
        });
    } else {
        $.ajax({
            type: "GET",
            url: contextPath + "/branchsList/" + bankId, //DB
            async: false,
            dataType: "json",
            success: function (response) {

                branchSelectId.find('option').remove();
                appendSelectInList(branchSelectId);
                // $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(branchSelectId);
                $.each(response, function (index, value) {

                    if (selectedLocale === 'en') {
                        $('<option>').val(value.id).text(value.nameInEnglish).appendTo(branchSelectId).attr("data-routing", value.routingNumber);
                    } else if (selectedLocale === 'bn') {
                        $('<option>').val(value.id).text(value.nameInBangla).appendTo(branchSelectId).attr("data-routing", value.routingNumber);
                    }

                    if (selectedBranch !== null && selectedBranch == value.id) {
                        rn = value.routingNumber;
                    }
                });

                if (selectedBranch !== null) {
                    branchSelectId.val(selectedBranch);
//                 if (selectedLocale === 'en') {
//                     routingId.val(rn);
//                } else if (selectedLocale === 'bn') {
//                     routingId.val(getNumberInBangla(rn));
//                }

                }
            },
            failure: function () {
                alert("failed");
                log("loading branch failed!!");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error=" + xhr.responseText);
                alert("error=" + thrownError);
                console.log('error=' + xhr.responseText);
                console.log('error=' + thrownError);
            }
        });
    }
}


function loadPostOffice(bankId, branchSelectId, selectedBranch, routingId) {
    //alert(bankId+ branchSelectId+ selectedBranch+routingId);
    var rn = 0;
    $.ajax({
        type: "GET",
        url: contextPath + "/postOfficeList/" + bankId,
        async: false,
        dataType: "json",
        success: function (response) {
            //alert(JSON.parse(response));
            branchSelectId.find('option').remove();
            appendSelectInList(branchSelectId);
            // $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(branchSelectId);
            $.each(response, function (index, value) {

                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(branchSelectId).attr("data-routing", value.routingNumber);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(branchSelectId).attr("data-routing", value.routingNumber);
                }

                if (selectedBranch !== null && selectedBranch == value.id) {
                    rn = value.routingNumber;
                }
            });

            if (selectedBranch !== null) {
                branchSelectId.val(selectedBranch);
                // routingId.val(rn);
            }
        },
        failure: function () {
            alert("failed");
            log("loading branch failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("error=" + xhr.responseText);
            alert("error=" + thrownError);
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
}


function loadRoutingNumberForMobileBanking(bankId, routingId) {
    //alert(bankId+ branchSelectId+ selectedBranch+routingId);
    var rn = 0;
    $.ajax({
        type: "GET",
        url: contextPath + "/getMobileBankingProvider/" + bankId,
        async: false,
        dataType: "json",
        success: function (response) {
            var mobileRoutingNumber = JSON.stringify(response.routingNumber);
            var mobileRoutingNumberLength = JSON.stringify(response.routingNumber).length;

            if (mobileRoutingNumberLength != 9) {
                mobileRoutingNumber = "0" + mobileRoutingNumber;
            }

            if (selectedLocale === 'en') {
                routingId.val(mobileRoutingNumber);
            } else if (selectedLocale === 'bn') {
                routingId.val(getNumberInBangla(mobileRoutingNumber));
            }
        },
        failure: function () {
            alert("failed");
            log("loading branch failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("error=" + xhr.responseText);
            alert("error=" + thrownError);
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
}


function loadMobileBankingProvider(mbpSelectId, selectedMobileBakningProvider) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getMobileBankingProviderList",
        async: false,
        dataType: "json",
        success: function (response) {
            mbpSelectId.find('option').remove();
            appendSelectInList(mbpSelectId);
            //  $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(mbpSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(mbpSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(mbpSelectId);
                }
            });
            if (selectedMobileBakningProvider !== null) {
                mbpSelectId.val(selectedMobileBakningProvider);
            }
        },
        failure: function () {
            log("loading Mobile Bakning Provider failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
}




function loadBkashMobileBankingProvider(mbpSelectId, selectedMobileBakningProvider) {
    $.ajax({
        type: "GET",
        url: contextPath + "/getMobileBankingProviderList",
        async: false,
        dataType: "json",
        success: function (response) {
            mbpSelectId.find('option').remove();
            appendSelectInList(mbpSelectId);
            //  $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(mbpSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en' && value.id == 2) {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(mbpSelectId);
                } else if (selectedLocale === 'bn' && value.id == 2) {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(mbpSelectId);
                }
            });
            if (selectedMobileBakningProvider !== null) {
                mbpSelectId.val(selectedMobileBakningProvider);
            }
        },
        failure: function () {
            log("loading Mobile Bakning Provider failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
}




function includeJs(jsFilePath) {

    //alert("jsFilePath:"+jsFilePath);
    var js = document.createElement("script");

    js.type = "text/javascript";
    js.src = jsFilePath;

    document.body.appendChild(js);
}

function getYearDropDown(select, thisYear, yearRange, selectedYear) {
    var minOffset = 0, maxOffset = yearRange; // Change to whatever you want
//    var thisYear = (new Date()).getFullYear();
//    var select = $('<select>');
//    $('<option>', {value: "", text: }).appendTo(select);
//    $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(select);
    for (var i = minOffset; i <= maxOffset; i++) {
        var year = thisYear - i;
        $('<option>', {value: year, text: year}).appendTo(select);
    }
    if (selectedYear !== null) {
        select.val(selectedYear);
    }

    return select;
}

function loadScheme(ministryId, schemeSelectId, selectedScheme) {

    $.ajax({
        type: "GET",
        url: contextPath + "/getScheme/" + ministryId,
        async: false,
        dataType: "json",
        success: function (response) {
            schemeSelectId.find('option').remove();
            $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(schemeSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(schemeSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(schemeSelectId);
                }
            });
            if (selectedScheme !== null) {
                schemeSelectId.val(selectedScheme);
            }
        },
        failure: function () {
            log("loading scheme failed!!");
        }
    });
}

function getDataFromUrl(url) {
    console.log(url);
    $.ajax({
        type: "GET",
        url: url,
        async: true,
//        dataType: "json",
        success: function (response) {
            $(".modal-body").html(response);
            return response;
//            schemeSelectId.find('option').remove();
//            $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(schemeSelectId);
//            $.each(response, function (index, value) {
//                if (selectedLocale === 'en') {
//                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(schemeSelectId);
//                } else if (selectedLocale === 'bn') {
//                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(schemeSelectId);
//                }
//            });
//            if (selectedScheme !== null) {
//                schemeSelectId.val(selectedScheme);
//            }
        },
        failure: function () {
            log("loading scheme failed!!");
            return "error in loading data";
        }
    });
}


function loadPaymentCycle(fiscalYearId, paymentCycleSelectId, isActive) {

    var ajaxUrl = "";
    if (isActive === true) {
        ajaxUrl = contextPath + "/getActivePaymentCycle/" + fiscalYearId;
    } else {
        ajaxUrl = contextPath + "/getAllPaymentCycle/" + fiscalYearId;
    }

    $.ajax({
        type: "GET",
        url: ajaxUrl,
        async: false,
        dataType: "json",
        success: function (response) {
            paymentCycleSelectId.find('option').remove();
            $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(paymentCycleSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(paymentCycleSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(paymentCycleSelectId);
                }
            });
        },
        failure: function () {
            log("loading Payment Cycle failed!!");
        }
    });
}

function loadPaymentCycle2(schemeId, fiscalYearId, paymentCycleSelectId, isActive) {

    var ajaxUrl = "";
    if (isActive === true) {
        ajaxUrl = contextPath + "/getActivePaymentCycle/" + schemeId + "/" + fiscalYearId;
    } else {
        ajaxUrl = contextPath + "/getAllPaymentCycle/" + schemeId + "/" + fiscalYearId;
    }

    $.ajax({
        type: "GET",
        url: ajaxUrl,
        async: false,
        dataType: "json",
        success: function (response) {
            paymentCycleSelectId.find('option').remove();
            $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(paymentCycleSelectId);
            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(paymentCycleSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(paymentCycleSelectId);
                }
            });
        },
        failure: function () {
            log("loading Payment Cycle failed!!");
        }
    });
}


function loadPaymentCycle2(schemeId, fiscalYearId, paymentCycleSelectId, isActive, particalUrl) {

    var ajaxUrl = "";
    if (isActive === true) {
        ajaxUrl = contextPath + particalUrl + "/getActivePaymentCycle/" + schemeId + "/" + fiscalYearId;
    } else {
        ajaxUrl = contextPath + particalUrl + "/getAllPaymentCycle/" + schemeId + "/" + fiscalYearId;
    }

    $.ajax({
        type: "GET",
        url: ajaxUrl,
        async: false,
        dataType: "json",
        success: function (response) {
            paymentCycleSelectId.find('option').remove();
            // $('<option>').val("").text(messageResource.get('label.select', 'messages_' + selectedLocale)).appendTo(paymentCycleSelectId);
            // $('<option>').val("").text(select).appendTo(paymentCycleSelectId);

            appendSelectInList(paymentCycleSelectId);

            $.each(response, function (index, value) {
                if (selectedLocale === 'en') {
                    $('<option>').val(value.id).text(value.nameInEnglish).appendTo(paymentCycleSelectId);
                } else if (selectedLocale === 'bn') {
                    $('<option>').val(value.id).text(value.nameInBangla).appendTo(paymentCycleSelectId);
                }
            });
        },
        failure: function () {
            log("loading Payment Cycle failed!!");
        }
    });
}

function getShortMonthNameInEnglish(d) {
    var objDate = d,
            locale = "en-us",
            month = objDate.toLocaleString(locale, {month: "short"});

    return month;
}

function getShortMonthNameInBangla(d) {
    var objDate = d,
            locale = "bn-BD",
            month = objDate.toLocaleString(locale, {month: "short"});

    return month;
}

function getNumberInBangla(input) {
    if (input == null)
        return null;
    var numbers = {
        '0': '০',
        '1': '১',
        '2': '২',
        '3': '৩',
        '4': '৪',
        '5': '৫',
        '6': '৬',
        '7': '৭',
        '8': '৮',
        '9': '৯'
    };

    var output = [];
    for (var i = 0; i < input.length; ++i) {
        if (numbers.hasOwnProperty(input[i])) {
            output.push(numbers[input[i]]);
        } else {
            output.push(input[i]);
        }
    }
    return output.join('');
}

function getNumberInEnglish(input) {
    if (input == null)
        return null;
    var numbers = {
        '০': '0',
        '১': '1',
        '২': '2',
        '৩': '3',
        '৪': '4',
        '৫': '5',
        '৬': '6',
        '৭': '7',
        '৮': '8',
        '৯': '9'
    };

    var output = [];
    for (var i = 0; i < input.length; ++i) {
        if (numbers.hasOwnProperty(input[i])) {
            output.push(numbers[input[i]]);
        } else {
            output.push(input[i]);
        }
    }
    return output.join('');
}

function localizeBanglaInDatatable(datatableId) {
    $('#' + datatableId + '_info').text(getNumberInBangla($('#' + datatableId + '_info').text()));
    if (document.getElementsByName(datatableId + "_length").length != 0) {
        var options = document.getElementsByName(datatableId + "_length")[0].options;

        for (var i = 0; i < options.length; i++) {
            options[i].text = getNumberInBangla(options[i].text);
        }

        var paginations = $(".paginate_button >a");
        for (var i = 0; i < paginations.length; i++) {
            paginations[i].text = getNumberInBangla(paginations[i].text);
        }
    }
}

function formatCurrency(total) {
    var neg = false;
    if (total < 0) {
        neg = true;
        total = Math.abs(total);
    }
//    return (neg ? "-$" : '$') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
    return parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}

function processAjaxData(response, urlPath, urlTitle) {
    console.log('processAjaxData');
    $("#mainContent").html(response);
//    console.log(response);
//    console.log(response.actionUrl);
//    console.log(response.pageTitle);
    document.title = urlTitle;
    window.history.pushState({"html": response, "asdfasd": "asdfasdf"}, "");
    console.log('after processAjaxData');
}

function submitFormAjax(form, action, nextForm, urlTitle) {

    var serializedData = form.serialize();
    console.log("before ajax submit, serializedData = " + serializedData);
    serializedData += '&action=' + action;

    try {
//alert(JSON.stringify(serializedData) +form.attr('method')+form.attr('action'));
//    setTimeout(function () {
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
//        data: {jsonData: JSON.stringify(serializedData)},
            data: serializedData,
            async: false,
            beforeSend: function () {
//                $(".modal").show();
            },
            complete: function () {
                console.log('complete');
//                $(".modal").hide();
            },
            success: function (response) {
                console.log('success');
                // alert( JSON.stringify( response )) ;
                //alert("r");
                processAjaxData(response, nextForm, urlTitle);
                initIcheck();
                // initDate($("#dateOfBirth"), 'yy-mm-dd', $("#dateOfBirth\\.icon"));
            },
            error: function (xhr) {
                console.log('error = ' + xhr.responseText);
            }
        });

    } catch (err) {
        alert(err);
    }

}

function loadJsp(page) {
    var appId = $("#applicantId").val();
    console.log('appId = ' + appId);
    $("#mainContent").load(contextPath + page + appId + "?regType=offline", function () {
        initIcheck();
    });
}

function loadJspInstitute(page) {
    var appId = $("#instituteIndexId").val();
    console.log('appId = ' + appId);
    $("#mainContent").load(contextPath + page + appId + "?regType=offline", function () {
        initIcheck();
    });
}

function loadJspForBeneficiary(page) {
    var appId = $("#applicantId").val();
    console.log('appId = ' + appId);
    $("#mainContent").load(contextPath + page + appId, function () {
        initIcheck();
    });
}

function loadApplicantTabs(actionType, nextTab) {

    if (actionType === 'create') {
        $('#crumbs li a[href="#' + nextTab + '"]').parent().addClass("selected");
        $('#crumbs li.selected').css('pointer-events', 'none');
        $('#crumbs li').not('.selected').addClass('disabled');
        $('#crumbs li').not('.selected').find('a').removeAttr("data-toggle");
    } else {
        $('#crumbs li a[href="#' + nextTab + '"]').parent().addClass("selected");
    }
}

function showReportInPopup(form) {
    var serializedData = form.serialize();
    console.log("before ajax submit");
    console.log("serializedData =  " + serializedData);
    $.ajax({
        headers: {
            'Accept': 'application/x-pdf'
//            'Content-Type': 'application/json'
        },
        type: form.attr('method'),
        url: form.attr('action'),
        data: serializedData,
        async: false,
        beforeSend: function () {
            // $(".modal").show();
        },
        complete: function () {
            //  $(".modal").hide();
        },
        success: function (response) {
            window.history.pushState({"html": response, "asdfasd": "asdfasdf"}, "");
            window.open("data:application/pdf;base64, " + response, '_blank');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr);
            console.log('error=' + thrownError);
        }
    });
}

function submitFormAjax2(form, action, nextForm, urlTitle) {
    $('form').append("<input name='action' value='next' type='hidden' />");
    var formData = new FormData($('form')[0]);
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: formData,
        cache: false,
        async: false,
        processData: false,
        contentType: false,
        success: function (response) {
            processAjaxData(response, nextForm, urlTitle);
            initIcheck();
        },
        beforeSend: function () {
//            $(".modal").show();
        },
        complete: function () {
//            $(".modal").hide();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }, failure: function () {
            log("submit of " + nextForm + " info failed !!");
        }
    });
}


Number.prototype.pad = function (size) {
    var s = String(this);
    while (s.length < (size || 2)) {
        s = "0" + s;
    }
    return s;
}

function menuSelect(url) {
    var element = $('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
    var parentUl, liToMakeActive;
    if (element) {
        parentUl = element.parent();
        while (parentUl.length > 0 && parentUl[0].className != 'sidebar-menu') {
            liToMakeActive = parentUl.parent();
            liToMakeActive.addClass("active");
            parentUl = liToMakeActive.parent();
        }
    }
}

//$(function () {
//    menuSelect(window.location.pathname);
//});

function populateOnlineApplicationForm() {
    populatePersonalInfoForm();
    populateAddressInfoForm();
    populateSocioEconomicInfoForm();
    populatePaymentInfoForm();

//    $("#fullNameInBangla").val("প্রথম নাম");
////    $("#lastNameInBangla").val("শেষ নাম");
//    $("#fullNameInEnglish").val("First Name");
////    $("#lastNameInEnglish").val("Last Name");
//    $("#fatherName").val("Father Name");
//    $("#motherName").val("Mother Name");
//    $("#spouseName").val("Husband Name");
//    $("#dateOfBirth").val("1995-01-01");
//    $("#birthPlace").prop('selectedIndex', 2);
//    $('#bloodGroup').prop('selectedIndex', 2);
////    $('#educationLevel').prop('selectedIndex', 1);
//    $('#religion').prop('selectedIndex', 1);
//    $('#maritalInfo').prop('selectedIndex', 1);
//    $('#nid').val("1" + Math.floor(Math.random() * 10000000000000000));
//    $('#mobileNo').val("017" + Math.floor(Math.random() * 100000000));
//    submitForm();
//    $("#presentAddressLine1").val(Math.floor(Math.random() * 1000));
//    $("#presentAddressLine2").val("Gulshan");
//    loadDivision($("select#presentDivision"), '');
//    $("#presentDivision").prop('selectedIndex', 1);
//    loadDistrict($("#presentDivision").val(), $('#presentDistrict'));
//    $("#presentDistrict").prop('selectedIndex', 1);
//    loadUpazilla($("#presentDistrict").val(), $('#presentUpazila'));
//    $("#presentUpazila").prop('selectedIndex', 1);
//    loadUnion($("#presentUpazila").val(), $('#presentUnion'));
//    $("#presentUnion").prop('selectedIndex', 1);
//    $("#presentWardNo").val("15");
//    $("#presentPostCode").val("1000");
//    loadPermanentAddressSameAsPresent();
//    submitForm();
//    $("#schemeAttributeValueList0\\.schemeAttributeValue").val("2500");
//    $("#schemeAttributeValueList4\\.schemeAttributeValue").val("21");
//    $('#schemeAttributeValueList1\\.schemeAttributeValue').prop('selectedIndex', 1);
//    $('#schemeAttributeValueList2\\.schemeAttributeValue').prop('selectedIndex', 2);
//    $('#schemeAttributeValueList3\\.schemeAttributeValue').prop('selectedIndex', 2);
//    $('#schemeAttributeValueList6\\.schemeAttributeValue').val("4");
//    $('#schemeAttributeValueList5\\.schemeAttributeValue').prop('selectedIndex', 2);
//    submitForm();
//    $('#paymentType').prop('selectedIndex', 1);
//    loadBankOrProviderList($("#paymentType")[0]);
//    loadBranchList($('#bank')[0]);
//    $('#bank').prop('selectedIndex', 1);
//    loadBranch($("#bank").val(), $('#branch'));
//    $("#branch").prop('selectedIndex', 1);
//    $("#accountType").prop('selectedIndex', 1);
//    $("#accountName").val("accountName");
//    $("#accountNo").val("12444512");
}

function populatePersonalInfoForm() {
    $("#fullNameInBangla").val("প্রথম নাম");
//    $("#lastNameInBangla").val("শেষ নাম");
    $("#fullNameInEnglish").val("First Name");
//    $("#lastNameInEnglish").val("Last Name");
    $("#fatherName").val("Father Name");
    $("#motherName").val("Mother Name");
    $("#spouseName").val("Husband Name");
    $("#dateOfBirth").val("০১-০১-১৯৯৫");
    $("#birthPlace").prop('selectedIndex', Math.floor(Math.random() * 10));
    $('#bloodGroup').prop('selectedIndex', 2);
//    $('#educationLevel').prop('selectedIndex', 1);
    $('#religion').prop('selectedIndex', 1);
    $('#maritalInfo').prop('selectedIndex', 1);
    $('#nid').val("1" + Math.floor(Math.random() * 10000000000000000));
    $('#mobileNo').val("017" + Math.floor(Math.random() * 100000000));
    submitForm();
}

function populateAddressInfoForm() {
    $("#presentAddressLine1").val(Math.floor(Math.random() * 1000));
    $("#presentAddressLine2").val("Gulshan");
    loadDivision($("select#presentDivision"), '');
    $("#presentDivision").prop('selectedIndex', 1);
    loadDistrict($("#presentDivision").val(), $('#presentDistrict'));
    $("#presentDistrict").prop('selectedIndex', 1);
    loadUpazilla($("#presentDistrict").val(), $('#presentUpazila'));
    $("#presentUpazila").prop('selectedIndex', 1);
    loadUnion($("#presentUpazila").val(), $('#presentUnion'));
    $("#presentUnion").prop('selectedIndex', 1);
    $("#presentWardNo").val("15");
    $("#presentPostCode").val("1000");
    loadPermanentAddressSameAsPresent();
    submitForm();
}

function populateSocioEconomicInfoForm() {
    $("#schemeAttributeValueList0\\.schemeAttributeValueInEnglish").val(Math.floor(Math.random() * 1500));
    $('#schemeAttributeValueList1\\.schemeAttributeValueInEnglish').prop('selectedIndex', 1);
    $('#schemeAttributeValueList2\\.schemeAttributeValueInEnglish').prop('selectedIndex', 2);
    $('#schemeAttributeValueList3\\.schemeAttributeValueInEnglish').prop('selectedIndex', 2);
    $('#schemeAttributeValueList6\\.schemeAttributeValueInEnglish').val("4");
    $('#schemeAttributeValueList5\\.schemeAttributeValueInEnglish').prop('selectedIndex', 2);

    $("#schemeAttributeValueList0\\.schemeAttributeValueInBangla").val(Math.floor(Math.random() * 1500));
    $('#schemeAttributeValueList1\\.schemeAttributeValueInBangla').prop('selectedIndex', 1);
    $('#schemeAttributeValueList2\\.schemeAttributeValueInBangla').prop('selectedIndex', 2);
    $('#schemeAttributeValueList3\\.schemeAttributeValueInBangla').prop('selectedIndex', 2);
    $('#schemeAttributeValueList6\\.schemeAttributeValueInBangla').val("4");
    $('#schemeAttributeValueList5\\.schemeAttributeValueInBangla').prop('selectedIndex', 2);
    submitForm();
}

function populateBenSocioEconomicInfoForm() {
    $("#beneficiarySchemeAttributeValueList0\\.schemeAttributeValueInEnglish").val(Math.floor(Math.random() * 1500));
//$("#schemeAttributeValueList4\\.schemeAttributeValue").val("21");
    $('#beneficiarySchemeAttributeValueList1\\.schemeAttributeValueInEnglish').prop('selectedIndex', 1);
    $('#beneficiarySchemeAttributeValueList2\\.schemeAttributeValueInEnglish').prop('selectedIndex', 2);
    $('#beneficiarySchemeAttributeValueList3\\.schemeAttributeValueInEnglish').prop('selectedIndex', 2);
    $('#beneficiarySchemeAttributeValueList6\\.schemeAttributeValueInEnglish').val("4");
    $('#beneficiarySchemeAttributeValueList5\\.schemeAttributeValueInEnglish').prop('selectedIndex', 2);
    submitForm();
}

function populatePaymentInfoForm() {
    $('#paymentType').prop('selectedIndex', 1);
    loadBankOrProviderList($("#paymentType")[0]);
    loadBranchList($('#bank')[0]);
    $('#bank').prop('selectedIndex', 1);
    loadBranch($("#bank").val(), $('#branch'));
    $("#branch").prop('selectedIndex', 1);
    $("#accountType").prop('selectedIndex', 1);
    $("#accountName").val("accountName");
    $("#accountNo").val("12444512");
//    submitForm();
}

function populateBenData() {
    populatePersonalInfoForm();
    populateAddressInfoForm();
    populateBenSocioEconomicInfoForm();
    populatePaymentInfoForm();
}

function showModalDialog() {
    $('[data-toggle="modal"]').click(function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        console.log('in showModalDialog3');
        if (url.indexOf('#') == 0) {
//            alert('open');
            console.log('in showModalDialog4');
            $(url).modal('open');
        } else {
            console.log('in showModalDialog5');
            $.get(url, function (data) {
                console.log('in showModalDialog6');
                $('#myModal .modal-body').html(data);
                $('#myModalLabel').val('test');
                $('#myModal .modal-body').css({height: screen.height * .60});
                $('#myModal').modal('show');
            }).success(function () {
            });
//            console.log(url);
//            $.ajax({
//                type: "GET",
//                url: url,
//                async: false,                
//                success: function (response) {
//                    console.log('success = ' + response);
//                },
//                failure: function () {
//                    log("loading failed!!");
//                },
//                error: function (xhr, ajaxOptions, thrownError) {
//                    console.log('error=' + xhr);
//                    console.log('error=' + thrownError);
//                }
//            });
//            console.log('done');
        }
    });
}

function loadApplicant(id) {
    $.ajax({
        type: "GET",
        url: "viewApplicant/" + id,
        async: true,
        success: function (response) {
            $('#myModal .modal-body').html(response);
            $('#myModalLabel').val('test');
            $('#myModal .modal-body').css({height: screen.height * .60});
            $('#myModal').modal('show');
        },
        failure: function () {
            log("loading scheme failed!!");
            return "error in loading data";
        }
    });
}

function loadComment(id) {
    console.log("okkay");
    $.ajax({
        type: "GET",
        url: "applicant/viewComment/" + id,
        async: true,
        success: function (response) {
            $('#commentModal .modal-body').html(response);
            $('#myModalLabel').val('test');
            $('#commentModal .modal-body').css({height: screen.height * .60});
            $('#commentModal').modal('show');
        },
        failure: function () {
            log("loading scheme failed!!");
            return "error in loading data";
        }
    });
}

function loadBeneficiary(id) {
    var data = getDataFromUrl(contextPath + "/beneficiary/viewBeneficiary/" + id);
    $('#myModal .modal-body').html(data);
    var header = getLocalizedText("label.viewBeneficiaryPageHeader", selectedLocale);
    console.log('title = ' + header);
    $('#myModalLabel').text(header);
    $('#myModal .modal-body').css({height: screen.height * .60});
    $('#myModal').modal('show');
}

function printCard(id) {
    $.ajax({
        type: "GET",
        url: "selection/printCard/" + id,
        async: true,
        success: function (response) {
            console.log(response);
            $('#myPrintModal .modal-body').html(response);
            $('#myPrintModal .modal-content').css({height: screen.height * .35});
            $('#myPrintModal .modal-content').css({width: screen.width * .35});
            $('#myPrintModal').modal('show');
        },
        failure: function () {
            log("loading print card failed!!");
            return "error in loading data";
        }
    });
}

function printData(dvPrint) {
    var divToPrint = document.getElementById(dvPrint);
    var htmlToPrint = '' +
            '<style type="text/css">' +
            'table {border-collapse: collapse; width: 100%}' +
            'table th, table td {' +
            'border:1px solid #000;' +
            'text-align: center;' +
            'padding;0.5em;' +
            '}' +
            '.row:after,.row:before{display:table;content:" "}' +
            '.col-md-6{width:50%}' +
            '.col-md-offset-3{margin-left:25%}' +
            '.form-group{margin-bottom:15px}' +
            '.control-label{padding-top:7px;margin-bottom:0;text-align:right}' +
            '.labelAsValue{padding-top: 7px;}' +
            '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

function initIcheck() {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_flat-blue',
        increaseArea: '20%' // optional
    });
}

function showStepCountInApplicant(currentTab, totalTabs, divId) {
    if (selectedLocale === 'en') {
        $("#" + divId).text("Step " + currentTab + " of " + totalTabs);
    } else if (selectedLocale === 'bn') {
        $("#" + divId).text("ধাপ " + getNumberInBangla('' + currentTab) + "/" + getNumberInBangla('' + totalTabs));
    }
}


/* Additional Validation Methods */

function checkSpecialAllowedCharacters(event) {
    // Allow only delete, backspace,left arrow,right arrow, Tab and numbers
    if (!((event.keyCode === 46 || // delete
            event.keyCode === 8 || // backspace
            event.keyCode === 36 || // home
            event.keyCode === 35 || // end
            event.keyCode === 37 || // left arrow
            event.keyCode === 39 || // right arrow
            event.keyCode === 9)     // tab
            )) {
        return false;
    } else {
        return true;
    }
}

function checkAlphabetWithLength(event, element, maxLength) {
    console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            (element.value.length < maxLength &&
                    ((event.keyCode >= 65 && event.keyCode <= 90) ||
                            event.keyCode === 32 || // space
                            event.keyCode === 190 || // dot
                            event.keyCode === 110 || // dot (numpad)
                            event.keyCode === 188 || // comma
                            event.keyCode === 231 || // bangla (IE/Chrome)
                            event.keyCode === 0 || // bangla (Firefox)
                            event.keyCode === 109 || event.keyCode === 189    // hyphen(numpad) , hyphen(keypad)
                            )
                    )
            )) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkBanglaAlphabetWithLength(event, element, maxLength) {
    event = event || window.event;
    var charCode = event.which || event.keyCode;
    console.log('code=' + charCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            (element.value.length < maxLength &&
                    (event.keyCode === 32 || // space
                            event.keyCode === 190 || // dot
                            event.keyCode === 110 || // dot (numpad)
                            event.keyCode === 188 || // comma
                            event.keyCode === 231 || // bangla (IE/Chrome)
                            event.keyCode === 0 || // bangla (Firefox)
                            event.keyCode === 109 || event.keyCode === 189)    // hyphen(numpad) , hyphen(keypad)
                    )
            )) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkEnglishAlphabetWithLength(event, element, maxLength) {
    //console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            (element.value.length < maxLength &&
                    ((event.keyCode >= 65 && event.keyCode <= 90) ||
                            event.keyCode === 48 || // right bracket
                            event.keyCode === 57  || // left bracket
                            event.keyCode === 32 || // space
                            event.keyCode === 190 || // dot
                            event.keyCode === 110 || // dot (numpad)
                            event.keyCode === 188 || // comma
                            event.keyCode === 109 || event.keyCode === 189)    // hyphen(numpad) , hyphen(keypad)
                    )
            )) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkEnglishAlphabetAccountNameWithLength(event, element, maxLength) {
    //console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            (element.value.length < maxLength &&
                    ((event.keyCode >= 65 && event.keyCode <= 90) ||
                            event.keyCode === 32 || // space
                            event.keyCode === 190 || // dot
                            event.keyCode === 110 || // dot (numpad)
                            event.keyCode === 109)
                    )
            )) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkUserIDValidator(event, element, maxLength) {
    console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
        (element.value.length < maxLength &&
            ((event.keyCode >= 65 && event.keyCode <= 90) ||
                (event.keyCode >= 48 && event.keyCode <= 57) ||
                //event.keyCode === 32 || // space
                //event.keyCode === 190 || // dot
                //event.keyCode === 110 || // dot (numpad)
                //event.keyCode === 188 || // comma
                //event.keyCode === 109 || // hyphen(numpad)
                event.keyCode === 189)   // hyphen(keypad)
        )
    )) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkNumber(event, element) {
    console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length);
    if (!(checkSpecialAllowedCharacters(event) ||
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    //                    ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67) && (event.ctrlKey === true || event.metaKey === true)) || // Ctrl+V options
                            //                    (event.keyCode === 0) || // bangla
                                    (event.keyCode >= 96 && event.keyCode <= 105)))) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkNumberWithLength(event, element, maxLength) {
    console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            element.value.length < maxLength &&
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    //                    ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67) && (event.ctrlKey === true || event.metaKey === true)) || // Ctrl+V options
                            //                    (event.keyCode === 0) || // bangla
                                    (event.keyCode >= 96 && event.keyCode <= 105)))) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkNumberWithLengthEnBn(event, element, maxLength) {
    console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);

    if (!(checkSpecialAllowedCharacters(event)
            ||
            (element.value.length < maxLength)
            &&
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    (event.keyCode >= 96 && event.keyCode <= 105))
            &&
            (!(event.shiftKey))
            )
            ) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkNumberWithLengthWithPasteOption(event, element, maxLength) {
    console.log('code=' + event.keyCode + ' ' + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            element.value.length < maxLength &&
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67) && (event.ctrlKey === true || event.metaKey === true)) || // Ctrl+V options
                    //                    (event.keyCode === 0) || // bangla
                            (event.keyCode >= 96 && event.keyCode <= 105)))) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}

function checkMaxValue(value, element) {
    return this.optional(element) || /^[0-5]+$/.test(value) || /^[০-৫]+$/.test(value);
}

function checkDecimalWithLength(event, element, maxLength) {
    console.log('code=' + event.keyCode + ' ' + 'value=' + element.value + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            element.value.length < maxLength &&
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    event.keyCode === 190 || // dot
                    event.keyCode === 110 || // dot (numpad)
                    //                    ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67) && (event.ctrlKey === true || event.metaKey === true)) || // Ctrl+V options
                            //                    (event.keyCode === 0) || // bangla
                                    (event.keyCode >= 96 && event.keyCode <= 105)))) {
        // Stop the event
        event.preventDefault();
        return false;
    }
}


function checkCGPA(event, element, maxval, maxLength) {

    console.log('code=' + event.keyCode + ' ' + 'value=' + element.value + 'length=' + element.value.length + ' ' + 'maxval=' + maxval);
    keyNext = "";
    valuePrevious = element.value;

    if ((event.keyCode <= 57) && (event.keyCode >= 48)) {
        keyNext = event.keyCode - 48;
    } else if ((event.keyCode <= 105) && (event.keyCode >= 96)) {
        keyNext = event.keyCode - 96;
    }
    valu = element.value + keyNext;


    if (!(checkSpecialAllowedCharacters(event) ||
            element.value.length < maxLength &&
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    //                    ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67) && (event.ctrlKey === true || event.metaKey === true)) || // Ctrl+V options
                            //                    (event.keyCode === 0) || // bangla
                                    (event.keyCode >= 96 && event.keyCode <= 105)

                                    )

                            )
                    && !((valu.match("^\((([0-9]*)(\.([0-9]+))?)\)$")) || (valu.match("^\(((['\u0980-\u09FF']*)(\.(['\u0980-\u09FF']+))?)\)$")))

                    ) {
        // Stop the event
        event.preventDefault();
        return false;
    }

    if (parseFloat(getNumberInEnglish(valu + "")) > parseFloat(maxval)) {

        event.preventDefault();
        return false;

    }

}

function checkDecimalValueLength(event, element, maxLength, maxValue) {
    console.log('code=' + event.keyCode + ' ' + 'value=' + element.value + 'length=' + element.value.length + ' ' + 'max=' + maxLength);
    if (!(checkSpecialAllowedCharacters(event) ||
            element.value.length < maxLength && getNumberInEnglish(element.value) < maxValue &&
            ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    event.keyCode === 190 || // dot
                    event.keyCode === 50 || // dot
                    event.keyCode === 110 || // dot (numpad)
                    //                    ((event.keyCode == 65 || event.keyCode == 86 || event.keyCode == 67) && (event.ctrlKey === true || event.metaKey === true)) || // Ctrl+V options
                            //                    (event.keyCode === 0) || // bangla
                                    (event.keyCode >= 96 && event.keyCode <= 105)))) {
        // Stop the event

        event.preventDefault();
        return false;
    }
}

function checkSpec(element) {
    var tt = new RegExp("^[0-9.]+$");
    if (!tt.test(element.value)) {
        element.value = "";
    }
}


$.validator.addMethod("regex", function (value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
});

$.validator.addMethod("banglaAlphabet", function (value, element) {
    return this.optional(element) || /^['\u0980-\u09FF'.-\s]+$/.test(value);
});

$.validator.addMethod("englishAlphabet", function (value, element) {
    return this.optional(element) || /^[a-zA-Z. \(\)-]+$/.test(value);
});

$.validator.addMethod("accountName", function (value, element) {
    return this.optional(element) || /^[a-zA-Z. ]+$/.test(value);
});

$.validator.addMethod("banglaAlphabetWithSpeChar", function (value, element) {//With Special Character
    return this.optional(element) || /^['\u0980-\u09FF'.-/\s]+$/.test(value);
});

$.validator.addMethod("englishAlphabetWithSpeChar", function (value, element) {//With Special Character
    return this.optional(element) || /^['a-zA-Z'.-/\s]+$/.test(value);
});

$.validator.addMethod("banglaAlphabetWithNumber", function (value, element) {
    return this.optional(element) || /^['\u0980-\u09FF0-9'.-\s]+$/.test(value);
});

$.validator.addMethod("englishAlphabetWithNumber", function (value, element) {
    return this.optional(element) || /^['a-zA-Z0-9'.-\s]+$/.test(value);
});

$.validator.addMethod("alphaNumericSpecialChars", function (value, element) {
    return this.optional(element) || /^['a-zA-Z0-9&()-. '\s]+$/.test(value);
});

$.validator.addMethod("decimalNumber", function (value, element) {
    return this.optional(element) || /[0-9]+\.[0-9]+$/.test(value) || /[০-৯]+\.[০-৯]+$/.test(value);
});

$.validator.addMethod("branchName", function (value, element) {
    console.log("in branchName validator");
    return this.optional(element) || /^[a-zA-Z0-9. &\/\(\)-]+$/.test(value);
});

$.validator.addMethod("checkDateOfBirth", function (value, element, options) {
    if (this.optional(element)) {
        return true;
    }

    var dateOfBirth = '';
    if (options.locale == 'bn')
        dateOfBirth = getNumberInEnglish(value);
    else
        dateOfBirth = value;
    var arr_dateText = dateOfBirth.split("-");

    year = arr_dateText[2];
    month = arr_dateText[1];
    day = arr_dateText[0];

    var mydate = new Date();
    mydate.setFullYear(year, month - 1, day);

    var minAge = options.min;
    var maxAge = options.max;
    var minDate = new Date();
    minDate.setFullYear(minDate.getFullYear() - minAge);

    var maxDate = new Date();
    maxDate.setFullYear(maxDate.getFullYear() - maxAge);
    if ((minDate - mydate) < 0 || (maxDate - mydate) > 0) {
        return false;
    }
    return true;
});

$.validator.addMethod("checkMobileNo", function (value, element) {
    return this.optional(element) || /^01[3456789][0-9]{8}$/.test(value) || /^০১[৩৪৫৬৭৮৯][০-৯]{8}$/.test(value);
});

$.validator.addMethod("checkNumericValue", function (value, element) {
    return this.optional(element) || /^[0-9]+$/.test(value) || /^[০-৯]+$/.test(value);
});

$.validator.addMethod("checkConceptionTerm", function (value, element) {
    value = getNumberInEnglish(value);
    console.log('checkConceptionTerm=' + value);
    return this.optional(element) || value <= 40;
});

$.validator.addMethod("checkNidNumber", function (value, element) {
    if (value.length == 13) {
        return true;
    }
    return this.optional(element)
            || (!/^(\d)\1+$/.test(value) && /^[^0][0-9]{9}$|^[^0][0-9]{16}$/.test(value))
            || (!/^([০-৯])\1+$/.test(value) && /^[^০][০-৯]{9}$|^[^০][০-৯]{16}$/.test(value));
});

$.validator.addMethod("nidNumber13Digits", function (value, element) {
    return value.length != 13;
});

$.validator.addMethod("uniqueNid", function (value, element) {
    var isSuccess = false;
    $.ajax({
        type: "POST",
        url: contextPath + "/checkUniqueNid",
        async: false,
        data: {
            'nid': $("#nid").val(), 'applicantId': $("#id").val()
        },
        success: function (msg) {
            isSuccess = msg === true ? true : false;
        },
        failure: function () {
            log("checking uniqueness of nid failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
    return isSuccess;
});

$.validator.addMethod("checkApplicationDeadline", function (value, element) {
    console.log('calling checkApplicationDeadline');
    var isSuccess = false;
    $.ajax({
        type: "POST",
        url: contextPath + "/checkApplicationDeadline",
        async: false,
        data: {
            'fiscalYearId': $("#fiscalYear\\.id").val(),
            'schemeId': $("#scheme\\.id").val(),
            'upazilaId': $("#permUpazila").val()
        },
        success: function (msg) {
            isSuccess = msg;
        },
        failure: function () {
            log("checking application deadline failed!!");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error=' + xhr.responseText);
            console.log('error=' + thrownError);
        }
    });
    return isSuccess;
});

$.validator.addMethod('checkFileSize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1024)
});

function getLocalizedText(messageResourceLabel, selectedLocale) {
    var text = messageResource.get(messageResourceLabel, 'messages_' + selectedLocale);
    return text;
}

// Not Tested
function localizeText(element) {
    console.log('before localizeText');
    console.log('text = ' + element.value);
    var text = element.value;
    var banglaText = getNumberInBangla(text);
    element.value = banglaText;
    console.log('end localizeText');
}

function alertButton() {
    if ("${message.messageType}" == "SUCCESS") {
//            bootbox.alert("<b>${message.message}</b>");
        bootbox.confirm({
            title: '<spring:message code="label.success" />',
            message: "<b>${message.message}</b>",
            buttons: {
                cancel: {
                    label: "Cancel",
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> <spring:message code="label.ok" />'
                }
            },
            callback: function (result) {

            }
        });
    } else if ("${message.messageType}" == "DANGER") {
//            bootbox.alert("<b>${message.message}</b>");
        bootbox.confirm({
            title: '<spring:message code="label.failure" />',
            message: "<b>${message.message}</b>",

            buttons: {
                cancel: {
                    label: "Cancel",
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> <spring:message code="label.ok" />',

                }
            },
            callback: function (result) {

            }
        });
    }
}


function phoneNumberFix(value) {

    if (/^01[3456789][0-9]{8}$/.test(value) || /^০১[৩৪৫৬৭৮৯][০-৯]{8}$/.test(value)) {
        return value;
    } else if (/^1[3456789][0-9]{8}$/.test(value)) {
        return "0" + value;
    } else if (/^১[৩৪৫৬৭৮৯][০-৯]{8}$/.test(value)) {
        return "০" + value;
    } else if (value == "") {
        return "";
    }
}



//function onLoad(ids) {
//    google.load("elements", "1", {
//        packages: "transliteration"
//    });
//
//    var optionEnToBn = {
//        sourceLanguage: 'en', // or google.elements.transliteration.LanguageCode.ENGLISH,
//        destinationLanguage: ['bn'], // or [google.elements.transliteration.LanguageCode.HINDI],
////            shortcutKey: 'ctrl+g',
//        transliterationEnabled: true
//    };
//    // Create an instance on TransliterationControl with the required
//    // options.
//    var control = new google.elements.transliteration.TransliterationControl(optionEnToBn);
//
//    // Enable transliteration in the textfields with the given ids.        
//    control.makeTransliteratable(ids);
//
//    // Show the transliteration control which can be used to toggle between
//    // English and Bengali.
////        control.showControl('translControl');
//}

function loadDistrictListUtility(divisionId, idsWhenLoaded, idsWhenNotLoaded, selectedDistrict = '') {

    console.log("IN DISTRICT LOAD UTILITY");

    let divId = divisionId === Object(divisionId) ? divisionId.value : divisionId

    if (divId !== '') {
        if (localStorage) {
            loadDistrictFromStorage(divId, $('#districtId'), selectedDistrict);
        } else {
            loadDistrict(divId, $('#districtId'), selectedDistrict);
        }
        resetSelectIds(idsWhenLoaded);
    } else {
        resetSelectIds(idsWhenNotLoaded);
    }
}

function resetSelectIds(ids) {
    for (let id of ids) {
        resetSelect(id);
    }
}
