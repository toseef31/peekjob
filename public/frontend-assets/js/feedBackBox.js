
; (function ($) {
    $.fn.extend({
        feedBackBox: function (options) {

            // default options
            this.defaultOptions = {
                title: 'Feedback',
                titleMessage: 'Send us your Feedback.',
                userName: '',
                isUsernameEnabled: true,
                message: '',
                ajaxUrl: 'feedback',
                successMessage: 'Thank your for your feedback.',
                errorMessage: 'Thank your for your feedback.'
            };

            var settings = $.extend(true, {}, this.defaultOptions, options);

            return this.each(function () {
                var $this = $(this);
                var thisSettings = $.extend({}, settings);

                var diableUsername;
                if (!thisSettings.isUsernameEnabled) {
                    diableUsername = 'disabled="disabled"';
                }

                // add feedback box
                $this.html('<div id="fpi_feedback">' +
                            '<div id="fpi_title" class="rotate">' +
                                '<h2>' + thisSettings.title + '</h2>' +
                            '</div>' +
                            '<div id="fpi_content"><div id="fpi_header_message">' + thisSettings.titleMessage + '</div>' +
                            '<form method="POST">' +
                                '<div class="form-group"> ' +
                                    '<input type="email" placeholder="enter your email" class="form-control" name="email" style="margin-bottom:10px">'+
                                    '<select class="form-control" name="type" id="sel1"> ' +
                                        '<option>Select Type</option> ' +
                                        '<option>Bug Report</option> ' +
                                        '<option>Feature Report</option> ' +
                                        '<option>Feedback</option> ' +
                                        '<option>Testimonial</option> ' +
                                    '</select> ' +
                                '</div>' +
                                '<div id="fpi_submit_message" class="form-group">' +
                                    '<textarea name="message" class="form-control" placeholder="Details"></textarea>' +
                                '</div>'+
                                '<div id="fpi_submit_loading"></div>' +
                                '<div id="fpi_submit_submit">' +
                                    '<button type="submit" onmouseover="appendtoken()" id="feed" class="btn btn-primary btn-block">SUBMIT</button>'+
                                '</div>' +
                            '</form>' +
                            '<div id="fpi_ajax_message">' +
                                '<h2></h2>' +
                            '</div>' +
                            '</div>' +
                            '</div>');

                // remove error indication on text change
                $('#fpi_submit_username input').change(function () {
                    if ($(this).val() != '') {
                        $(this).removeClass('error');
                    }
                });
                $('#fpi_submit_message textarea').change(function () {
                    if ($(this).val() != '') {
                        $(this).removeClass('error');
                    }
                });

                // submit action
                $this.find('form').submit(function () {

                    // validate input fields
                    var haveErrors = false;
                    if ($('#fpi_submit_username input').val() == '' && typeof diableUsername == 'undefined') {
                        haveErrors = true;
                        $('#fpi_submit_username input').addClass('error');
                    }
                    if ($('#fpi_submit_message textarea').val() == '') {
                        haveErrors = true;
                        $('#fpi_submit_message textarea').addClass('error');
                    } 

                    // send ajax call
                    if (!haveErrors) {
                        // serialize all input fields
                        var disabled = $(this).find(':input:disabled').removeAttr('disabled');
                        var serialized = $(this).serialize();
                        disabled.attr('disabled', 'disabled');

                        // disable submit button
                        $('#fpi_submit_submit input').attr('disabled', 'disabled');

                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: thisSettings.ajaxUrl,
                            data: serialized,
                            beforeSend: function () {
                                $('#fpi_submit_loading').show();
                            },
                            error: function (data) {
                                $('#fpi_content form').hide();
                                $('#fpi_content #fpi_ajax_message h2').html(thisSettings.errorMessage);
                            },
                            success: function () {
                                $('#fpi_content form').hide();
                                $('#fpi_content form input').val('');
                                $('#fpi_content form select').val('');
                                $('#fpi_content form textarea').val('');
                                $('#fpi_content #fpi_ajax_message h2').html(thisSettings.successMessage);
                            }
                        });
                    }

                    return false;
                });

                // open and close animation
                var isOpen = false;
                $('#fpi_title').click(function () {
                    if (isOpen) {
                        $('#fpi_feedback').animate({ "width": "+=5px" }, "fast")
                        .animate({ "width": "55px" }, "slow")
                        .animate({ "width": "60px" }, "fast");
                        isOpen = !isOpen;
                    } else {
                        $('#fpi_feedback').animate({ "width": "-=5px" }, "fast")
                        .animate({ "width": "365px" }, "slow")
                        .animate({ "width": "335px" }, "fast");

                        // reset properties
                        $('#fpi_submit_loading').hide();
                        $('#fpi_content form').show()
                        $('#fpi_content form .error').removeClass("error");
                        $('#fpi_submit_submit input').removeAttr('disabled');
                        isOpen = !isOpen;
                    }
                });

            });
        }
    });
})(jQuery);
