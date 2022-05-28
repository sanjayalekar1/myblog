var baseurl = "/century-admin-panel/";
var email_val = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var phone_val = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
var numeric_val = /^\d+$/;
var alphanumeric_val = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
var alphanumericspace_val = /^[a-z\d\-_\s]+$/i;
var date_val = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
var regExp = /[A-Za-z0-9_~\-!@#\$%\^&\*\(\)]+$/i;
var regExpnumbers = "/[0-9]/g;";
var whitespaces_val = /^\s+$/;
var website_val = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;

$(document).ready(function() {
    $("form").attr("autocomplete", "off");

	$("input, select, textarea").on("keydown", function() {
        $(".hideformspan span").css("display", "none");
    });

    $(".datatable").DataTable();

    $("input, select, textarea").addClass("form-control");

	$(".sortable").sortable({
		stop: function( event, ui ) {
			$(".sortable > tr, .attribute_block").each(function( index ) {
				$(this).attr("data-order", index + 1);
			});
		}
	});

	$(".sortable").disableSelection();

    $("#edit_meta_data").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-meta-data-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_banner").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-banner-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_home_page_slider").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-home-page-slider-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_home_page_slider")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_home_page_slider").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-home-page-slider-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_home_page_sliders").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-home-page-sliders-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#edit_home_page_about").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-home-page-about-us-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_frontend_script").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-frontend-script-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_home_page_video").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-home-page-video-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_project_budget").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-budget-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_project_budget")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project_budget").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-budget-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_project_location").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-location-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_project_location")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project_location").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-location-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_project_zone").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-zone-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_project_zone")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project_zone").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-zone-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_project_status").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-status-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_project_status")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project_status").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-status-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_project_type").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-type-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_project_type")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project_type").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-type-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_project_category").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-category-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_project_category")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project_category").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-category-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".delete_project_slider_image").on("click", function() {
        var confirm_box = confirm("Are you sure?");

        if(confirm_box === false) {
            return false;
        }

        $(this).parent().parent().remove();
    });

    $(".add_project_video_block").on("click", function() {
        var video_html = $(".reserved_video_html").html();

        $(".project_video_blocks").append(video_html);

        delete_block_jq();
    });

    $(".add_project_slider_block").on("click", function() {
        var slider_html = $(".reserved_slider_html").html();

        $(".project_slider_blocks").append(slider_html);

        delete_block_jq();
    });

    delete_block_jq();

    function delete_block_jq() {
        $(".delete_block").on("click", function() {
            $(this).parent().parent().remove();
        });
    }

    $(".add_project_highlighted_amenity_block").on("click", function() {
        $(".reserved_highlighted_amenity_html .basic_editor_holder").addClass("basic_editor");

        var highlighted_amenity_html = $(".reserved_highlighted_amenity_html").html();

        $(".project_highlighted_amenities_blocks").append(highlighted_amenity_html);

        $(".reserved_highlighted_amenity_html .basic_editor_holder").removeClass("basic_editor");

        delete_block_jq();

        basic_editor_tiny();
    });

    $(".add_project_gallery_block").on("click", function() {
        var gallery_html = $(".reserved_gallery_html").html();

        $(".project_gallery_blocks").append(gallery_html);

        delete_block_jq();
    });

    $(".add_project_plan_block").on("click", function() {
        var plan_html = $(".reserved_plan_html").html();

        $(".project_plan_blocks").append(plan_html);

        delete_block_jq();
    });

    $(".add_project_amenity_block").on("click", function() {
        var amenity_html = $(".reserved_amenity_html").html();

        $(".project_amenities_blocks").append(amenity_html);

        delete_block_jq();
    });

    $(".add_project_landmark_block").on("click", function() {
        var landmark_html = $(".reserved_landmark_html").html();

        $(".project_landmark_blocks").append(landmark_html);

        delete_block_jq();
    });

    $(".add_project_faq_block").on("click", function() {
        $(".reserved_faq_html .basic_editor_holder").addClass("basic_editor");

        var faq_html = $(".reserved_faq_html").html();

        $(".project_faq_blocks").append(faq_html);

        $(".reserved_faq_html .basic_editor_holder").removeClass("basic_editor");

        basic_editor_tiny();

        delete_block_jq();
    });

    $(".add_project_configuration_block").on("click", function() {
        var configuration_html = $(".reserved_configuration_html").html();

        $(".project_configuration_blocks").append(configuration_html);

        delete_block_jq();
    });

    $(".project_template_id").on("change", function() {
        var project_template_id = $(this).val();

        if(project_template_id == 1) {
            $(".amenity_illustration_image").fadeOut();
            $(".with_template_data").fadeIn();
        } else if(project_template_id == 2) {
            $(".amenity_illustration_image").fadeIn();
            $(".with_template_data").fadeIn();
        } else if(project_template_id == 3) {
            $(".with_template_data").fadeOut();
        }
    });

    $("#add_project").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert(result.display_message);
                window.location.reload();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_commercial_project").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-project-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert(result.display_message);
                window.location.reload();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_project").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-project-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert(result.display_message);
                window.location.reload();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_commercial_project").on("submit", function(e) {
        e.preventDefault();
        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "update-commercial-project-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert(result.display_message);
                window.location.reload();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });


    $(".save_sorting_projects").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-projects-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#add_timeline").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-timeline-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_timeline")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_timeline").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-timeline-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_management").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-management-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_management")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_management").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-management-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_management").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-management-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#add_why_us").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-why-us-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_why_us")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_why_us").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-why-us-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_why_us").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-why-us-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#add_social_responsibility").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-social-responsibility-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_social_responsibility")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_social_responsibility").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-social-responsibility-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_social_responsibilities").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-social-responsibilities-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#add_social_project").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-social-project-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_social_project")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_social_project").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-social-project-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_social_projects").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-social-projects-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#add_gallery").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-gallery-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_gallery")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_gallery").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-gallery-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_galleries").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-galleries-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $(".add_press_block").on("click", function() {
        var press_html = $(".reserved_press_html").html();

        $(".press_blocks").append(press_html);

         press_add_delete();
         delete_block_jq();
    });

    press_add_delete();

    function press_add_delete() {
        $(".press_link_attachment").on("change", function() {
            var press_link_attachment = $(this).val();

            if(press_link_attachment == 1) {
                $(this).parent().parent().find(".press_link").slideDown();
                $(this).parent().parent().find(".press_attachment").slideUp();
            } else {
                $(this).parent().parent().find(".press_attachment").slideDown();
                $(this).parent().parent().find(".press_link").slideUp();
            }
        });
    }

    $("#add_press").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-press-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_press")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_press").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-press-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_media").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-media-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_media")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_media").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-media-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_report").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-report-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_report")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_report").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-report-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_media_kit").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-media-kit-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_video").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-video-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_video")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_video").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-video-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#add_testimonial").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-testimonial-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_testimonial")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_testimonial").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-testimonial-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_testimonials").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-testimonials-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    $("#testimonial_layout_id").on("change", function() {
        var testimonial_layout_id = $(this).val();

        if(testimonial_layout_id == 1) {
            $(".youtube_video_block").slideDown();
            $(".thumbnail_block").slideDown();
        } else if(testimonial_layout_id == 2) {
            $(".youtube_video_block").slideUp();
            $(".thumbnail_block").slideDown();
        } else if(testimonial_layout_id == 3) {
            $(".youtube_video_block").slideUp();
            $(".thumbnail_block").slideUp();
        }
    });

    $("#add_award").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "add-award-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
                $("#add_award")[0].reset();
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $("#edit_award").on("submit", function(e) {
        e.preventDefault();

        $(".hideformspan span").css("display", "none");
        $("#resultmessage").html("");

        var data = new FormData(this);

        $.ajax({
            url: baseurl + "edit-award-details",
            data: data,
            dataType: "JSON",
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                $("#resultmessage").html(result.display_message);
                scrolltodiv("resultmessage");
            },
            error: function(result) {
                $("body").toggleClass("loader");
                validation_error(result);
            }
        });
    });

    $(".save_sorting_awards").on("click", function() {
        var data_order = [];
        var data_id = [];

        $(".sortable > tr").each(function(i) {
            data_order[i] = $(this).attr('data-order');
            data_id[i] = $(this).attr('data-id');
        });

        var data = {data_order:data_order,data_id:data_id};

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: baseurl + "update-awards-sorting",
            data: data,
            dataType: "JSON",
            type: "POST",
            beforeSend: function() {
                $("body").toggleClass("loader");
            },
            success: function(result) {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            },
            error: function() {
                $("body").toggleClass("loader");
                alert("Successfully Updated Sorting");
            }
        });
    });

    basic_editor_tiny();

    function basic_editor_tiny() {
        tinymce.init({
            selector: '.basic_editor',
            height: 50,
            theme: 'modern',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            fontsize_formats: "4pt 6pt 8pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt",
            plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help jbimages'
            ],
            theme_advanced_buttons3_add : "tablecontrols",
            toolbar1: 'undo redo | styleselect | bold italic | link forecolor | fontsizeselect sizeselect | alignleft aligncenter alignright alignjustify | bullist outdent indent code',
            menubar: false,
            relative_urls : false,
            image_caption: true,
        });
    }

    tinymce.init({
        selector: '#blog_content',
        height: 500,
        theme: 'modern',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        },
        fontsize_formats: "4pt 6pt 8pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt",
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help jbimages'
        ],
        theme_advanced_buttons3_add : "tablecontrols",
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | print preview media | forecolor backcolor emoticons code',
        toolbar2: 'sizeselect | fontselect |  fontsizeselect ',
        toolbar3: 'table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
        menubar: false,
        relative_urls : false
    });
});

function validation_error(result) {
    $.each(result.responseJSON.errors, function(k, v) {
        k = k.replace('.', '_');

        $("#" + k + "_err").html(v);
        $("#" + k + "_err").fadeIn();
        $("#" + k).focus();
        return false;
    });
}

function scrolltodiv(idtoscroll) {
    $('html,body').animate({scrollTop: $("#" + idtoscroll).offset().top},'slow');
}

function validatestring(stringtext) {
    if(stringtext == "" || whitespaces_val.test(stringtext) || numeric_val.test(stringtext) || alphanumeric_val.test(stringtext)) {
        return false;
    } else {
        return true;
    }
}

function validateblanktext(stringtext) {
    if(stringtext == "" || whitespaces_val.test(stringtext)) {
        return false;
    } else {
        return true;
    }
}