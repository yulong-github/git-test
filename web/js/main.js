jQuery(document).ready(function () {
    // highlight.js
    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });

    // back-to-top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });
    $('.back-to-top').click(function (e) {
        e.preventDefault();
        $('html,body').animate({scrollTop: 0}, 'slow');
    });

    // popover
    $(document).on('mouseenter', '[rel=author]', function () {
        var _this = this;
        setTimeout(function () {
            if ($(_this).is(':hover')) {
                $(_this).popover({
                    boundary: 'window',
                    html: true,
                    placement: 'auto',
                    content: '<i class="fas fa-4x fa-spinner fa-pulse"></i>'
                }).popover('show');
                $('.popover-body').load($(_this).attr('href'));
                $('.popover').on('mouseleave', function () {
                    $(_this).popover('dispose');
                });
            }
        }, 500);
    }).on('mouseleave', '[rel=author]', function () {
        var _this = this;
        setTimeout(function () {
            if ($('.popover').length && !$('.popover').is(':hover')) {
                $(_this).popover('dispose');
            }
        }, 100);
    });

    // ajax
    $.ajaxSetup({
        dataType: 'json',
        data: {_csrf: $('meta[name="csrf-token"]').attr('content')}
    });

    // registration
    $('.btn-registration').click(function () {
        var a = $(this);
        $.post('/registration', function (data) {
            if (data.status == -1) {
                $.modalLogin();
            } else if (data.status == 1) {
                a.html('<i class="fas fa-calendar-check"></i> 今日已签到<br />' + data.message).removeClass('btn-registration').addClass('disabled');
            } else {
                alert(data.message);
            }
        });
    });

    // follow
    $(document).on('click', '.follow', function () {
        var a = $(this);
        $.post('/follow', {id: a.attr('data-id')}, function (data) {
            if (data.status == -1) {
                $.modalLogin();
            } else if (data.status > 0) {
                if (a.hasClass('btn')) {
                    a.html('<i class="fas fa-check"></i> ' + data.message).addClass('disabled');
                } else {
                    a.replaceWith('<i class="fas fa-check"></i> ' + data.message);
                }
            } else {
                alert(data.message);
            }
        });
    });

    // group
    $(document).on('click', '.group', function () {
        var a = $(this);
        $.post('/join', {id: a.attr('data-id')}, function (data) {
            if (data.status == -1) {
                $.modalLogin();
            } else if (data.status > 0) {
                if (a.hasClass('btn')) {
                    a.html('<i class="fas fa-check"></i> ' + data.message).addClass('disabled');
                } else {
                    a.replaceWith('<i class="fas fa-check"></i> ' + data.message);
                }
            } else {
                alert(data.message);
            }
        });
    });

    // activity
    $('.activity').on('click', function () {
        var a = $(this);
        $.post('/activity', {id: a.attr('data-id')}, function (data) {
            if (data.status == -1) {
                $.modalLogin();
            } else if (data.status > 0) {
                a.html('<i class="fas fa-check"></i> ' + data.message).addClass('disabled');
            } else {
                alert(data.message);
            }
        });
    });

    // favorite
    $('.favorite').on('click', function () {
        var a = $(this);
        $.post('/favorite', {type: a.attr('data-type'), id: a.attr('data-id')}, function (data) {
            if (data.status == -1) {
                $.modalLogin();
            } else if (data.status == 1) {
                a.addClass('active').attr('data-original-title', data.message).tooltip('show').attr('data-original-title', '取消收藏').html('<i class="fas fa-star"></i> ' + data.count);
            } else if (data.status == 2) {
                if (typeof(a.attr('data-toggle')) == 'undefined') {
                    a.replaceWith('<i class="fas fa-check"></i> ' + '已取消');
                } else {
                    a.removeClass('active').attr('data-original-title', data.message).tooltip('show').attr('data-original-title', '收藏').html('<i class="far fa-star"></i> ' + data.count);
                }
            } else {
                alert(data.message);
            }
        });
    });

    // evaluate
    $(document).on('click', '.evaluate', function () {
        var a = $(this);
        var action = a.hasClass('up') ? 'up' : (a.hasClass('down') ? 'down' : null);
        if (!a.hasClass('active') && action) {
            $.post('/evaluate', {action: action, type: a.attr('data-type'), id: a.attr('data-id')}, function (data) {
                if (data.status == -1) {
                    $.modalLogin();
                } else if (data.status == 1) {
                    a.siblings().removeClass('active');
                    var action = a.addClass('active').attr('data-original-title');
                    var u = a.parent().find('.up');
                    var d = a.parent().find('.down');
                    u.attr('data-original-title', '顶').html('<i class="' + (action == '顶' ? 'fas' : 'far') + ' fa-thumbs-up"></i> ' + data.up);
                    if (d.length > 0) {
                        d.attr('data-original-title', '踩').html('<i class="' + (action == '踩' ? 'fas' : 'far') + ' fa-thumbs-down"></i> ' + data.down);
                    }
                    a.attr('data-original-title', data.message).tooltip('show');
                } else {
                    alert(data.message);
                }
            });
        }
    });

    // reply
    $(document).on('click', '.reply', function () {
        $('.reply-form').removeAttr('hidden');
        $('.reply-form').appendTo($(this).parents('li > .media-body'));
        $('.reply-form').find('.parent_id').val($(this).parents('li').attr('data-key'));
        $('.reply-form').find('.group_id').val($(this).parents('.media-footer').find('.group').attr('data-key'));
        if ($(this).parents('div.media').length > 0) {
            $('.reply-form').find('textarea').val('@' + $(this).closest('.media-body').find('[rel=author]').first().html() + ' ');
        } else {
            $('.reply-form').find('textarea').val('');
        }
    });

    // feed-reply
    $('.feed-reply').click(function () {
        $('#feed-content').val('@' + $(this).closest('.media-body').find('[rel=author]').first().html() + ' ');
        $('html,body').animate({scrollTop: $('#replies').offset().top}, 'slow');
    });

    // modal
    jQuery.extend({
        modalLogin: function () {
            $('.modal-content').load('/login');
            $('.modal').modal();
        },
        modalLoad: function (url, data, callback) {
            $('.modal-content').load(url, data, callback);
            $('.modal').modal();
        },
        modalAlert: function (content) {
            $('.modal-title, .modal-body p, .modal-footer').remove();
            $('.modal-header').prepend('<h2 class="modal-title">温馨提示</h2>');
            $('.modal-body').html('<p>' + content + '</p>');
            $('.modal-content').append('<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">确定</button></div>');
            $('.modal').modal();
        },
        modalConfirm: function (object) {
            $('.modal-title, .modal-body p, .modal-footer').remove();
            $('.modal-header').prepend('<h2 class="modal-title">请您确认</h2>');
            $('.modal-body').html('<p>' + object.attr('data-confirm') + '</p>');
            $('.modal-content').append('<div class="modal-footer"><a class="btn btn-primary" href="' + object.attr('href') + '" data-method="post">确定</a><button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button></div>');
            $('.modal').modal();
        }
    });
    window.alert = $.modalAlert;
    $("[data-confirm]").click(function () {
        $.modalConfirm($(this));
        return false;
    });
    $(".modal").on("hidden.bs.modal", function () {
        $(this).removeData("bs.modal");
    });

    // gallery
    if (typeof blueimp == 'object') {
        $('body').append('<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>');
        $('p img').each(function () {
            var img_src = $(this).attr('src');
            var img_alt = $(this).attr('alt');
            var reg = /^\/uploads\/images\/\w/;
            if (reg.test(img_src)) {
                img_src = img_src.replace('_thumb.', '.');
            }
            $(this).wrap('<a href="' + img_src + '" title="' + img_alt + '" data-gallery></a>');
        });
        $('#blueimp-gallery').on('closed', function (event) {
            $('body').removeAttr('style');
        });
    }

    // emojify and atwho
    $("textarea").atwho({
        at: "@",
        callbacks: {
            remoteFilter: function(query, callback) {
                $.getJSON("/suggest-users", {query: query}, function(data) {
                    callback(data);
                });
            }
        }
    }).atwho({
        at: ":",
        displayTpl: "<li><img class=\"emojione\" title=\"${name}\" src=\"/emoji/png/32/${id}.png\" /> ${name} </li>",
        insertTpl: "${name}",
        callbacks: {
            remoteFilter: function(query, callback) {
                $.getJSON("/suggest-emoji", {query: query}, function(data) {
                    callback(data);
                });
            }
        }
    });
});