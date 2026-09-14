$(document).ready(function () {

    $("#feedbackInvestment").html('');


});

function valida(myForm) {
    // per gli altri browser esistono controlli html5
    return true;
}

// when called this function to required page(argument)
function goToAdminPage(step) {
    target = "adminPageContent";
    var step = step;
    var params = { 
            page: "admin"
        , 	step: step
    };
    ajaxCall(target, params);
}

/*****************************/
/*   Start Blog admin java   */
/*****************************/

// Chiamata per inserimento Evento
function fInsertBlog() {
          
    if (valida(document.getElementById('form_investmentBlog')) == true) {
        var params = {
            CATEGORY: $("#CATEGORY").val(),
            POSTCATEG1: $("#POSTCATEG1").val(),
            POSTCATEG2: $("#POSTCATEG2").val(),
            POSTCATEG3: $("#POSTCATEG3").val(),
            TITLE: $("#TITLE").val(),
            SUBTITLE: $("#SUBTITLE").val(),
            KEYWORDS: $("#KEYWORDS").val(),
            METADESCR: $("#METADESCR").val(),
            AUTHOR : $("#AUTHOR").val(),
            RELPOSTS : $("#RELPOSTS").val(),
            TEXT: $("#TEXT").val(),
            FILENAME: $("#FILENAME").val(),
            LINKIMAGE: $("#LINKIMAGE").val(),
            csrf: window.csrfToken

        };
        //console.log(params);
        $.ajax({
            url: window.applicationURL + "index.php?page=admin&step=insertBlog",
            type: 'POST',
            data: params,
            success: viewFeedbackInsertBlog,
            error: function (request, status, error) {
                alert("ERROR: " + request.responseText);

            }
        });



        //$("#form_investmentBlog").ajaxSubmit(options);

    } else {
        alert('eeeeee');
        $("#feedbackInvestment").html('<div id="msg">LOGIN NEEDED</div>');

    }
    window.location.hash = "adminopt";
}


function fUpdateBlog() {
    if (valida(document.getElementById('form_blogUpdate')) == true) {
        var checkUpdateDate = document.getElementById('UPDATEDATE');
        var updateDate = false;
        if (checkUpdateDate.checked == true) {
            updateDate = true;
        } 
        var params = {
            CATEGORY: $("#CATEGORY").val(),
            TITLE: $("#TITLE").val(),
            POSTCATEG1: $("#POSTCATEG1").val(),
            POSTCATEG2: $("#POSTCATEG2").val(),
            POSTCATEG3: $("#POSTCATEG3").val(),
            SUBTITLE: $("#SUBTITLE").val(),
            KEYWORDS: $("#KEYWORDS").val(),
            FILENAME: $("#FILENAME").val(),
            METADESCR: $("#METADESCR").val(),
            AUTHOR : $("#AUTHOR").val(),
            RELPOSTS : $("#RELPOSTS").val(),
            UPDATEDATE : updateDate,
            TEXT: $("#TEXT").val(),
            IDblog: $("#IDblog").val(),
            LINKIMAGE: $("#LINKIMAGE").val(),
            csrf: window.csrfToken

        };
        //console.log(params);
        //console.log('Updated fine');
        $.ajax({
            url: window.applicationURL + "index.php?page=admin&step=updateBlog",
            type: 'POST',
            data: params,
            success: viewFeedbackBlogUpdate,
            error: function (request, status, error) {
                alert("ERROR: a " + request.responseText);

            }
        });

    } else {
        alert('eeeeee');
        $("#feedbackInvestment").html('<div id="msg">LOGIN NEEDED</div>');

    }
    window.location.hash = "adminopt";
}


function fAddBlogImageGallery() {
    if (valida(document.getElementById('fileUploader')) == true) {
        var params = {
            page: "admin",
            step: "AddBlogImageGallery",
            FILE_INV: $("#FILE_INV").val(),
            csrf: window.csrfToken
        };
        var options = {
            type: 'POST',
            url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
            success: viewFeedbackUpdateBlogGallery
        };

        $("#fileUploader").ajaxSubmit(options);


    } else {
        //alert('eeeeee');
        $("#feedbackInvestment").html('<div id="msg">LOGIN NEEDED</div>');

    }
}

function fDeleteBlogImageGallery(fileName) {

        var params = {
            page: "admin",
            step: "DeleteBlogImageGallery",
            fileName: fileName,
            csrf: window.csrfToken
        };

        var options = {
            type: 'POST',
            url: window.applicationURL + "index.php?" + $.param(params) + "&ajax=true",
            success: viewFeedbackUpdateBlogGallery
        };

        $("#fileUploader").ajaxSubmit(options);

}



function viewFeedbackUpdateBlogGallery(response, status) {
    // alert(''+response);
    $("#blogGallery").html(response);

    var params = {
        page: "admin",
        step: "BlogImageGallery",
        PAGENUMBER: "1"
    };
    ajaxCall("GalleryLibrary", params);
}


function viewFeedbackInsertBlog(response, status) {

    strToSend = ('<div id="msg">' + response + '</div>');
    var params = {
        page: "admin",
        step: "Blog",
        ORDERBY: "ID DESC"

    };
    ajaxCall("adminPageContent", params);
    //alert('RESULT: '+response);
    //$("#adminPageContent").html(response);
    $("#feedBackBlog").html('<div id="msg">AA' + response + '</div>');

}




function viewFeedbackBlogUpdate(response, status) {

    strToSend = ('<div id="msg">' + response + '</div>');
    var params = {
        page: "admin",
        step: "Blog",
        ORDERBY: "ID DESC"

    };
    ajaxCall("adminPageContent", params);
    // alert('RESULT: '+response);
    // $("#adminPageContent").html(response);
    $("#feedBackBlog").html('<div id="msg">AA' + response + '</div>');

}

function viewFeedbackBlogUpdateError() {
    alert('ERROR');
}


/* modal scripts */

// Open modal to tell user an error
function openImageModal(title,text) {
    const modal = document.getElementById("myModal");
    document.getElementById("modalTitle").innerHTML = title;
    document.getElementById("modalText").innerHTML = text;
    modal.style.display = "block";
}

// When the user clicks ok button and closes it
function closeModal() {
    const modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function checkMetadataLenght (textInput,target,minLegth,maxLength) {
    const textLengt = textInput.value.length;
    const dest = document.getElementById(target);
    textLengt > 0 ? dest.innerHTML = " --> Total Chars = " + textLengt: dest.innerHTML = "";
    if (textLengt < minLegth) {
        dest.style.color = 'red' ;
    } else {
        if (textLengt < maxLength + 1) {
            dest.style.color = 'green';  
        } else {
            dest.style.color = '#edba31'; 
        }
    }
}