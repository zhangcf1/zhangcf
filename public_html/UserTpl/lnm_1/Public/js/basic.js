$(function () {
    //下拉菜单
    $('.navlist').find('.key').click(function () {
        $(this).parents('.navlist').siblings().find('.navul').slideUp();
        $(this).parents('.navlist').siblings().removeClass('click');
        $(this).parents('.navlist').toggleClass('click');
        $(this).next('.navul').slideToggle();
    });
    //导航标题
    var pattern = /^.*&gt;/;
    if ($('.core_title_con').html()) {
        $('.core_title_con').prepend('&nbsp;<i class="icon iconfont">&#xe609</i>&nbsp;');
    }
    //股票界面
    $('#holder').parent('div').width(750);
    //界面高度
    var rn = $('.left-nav');
    var rc = $('.content');
    var dc = $(window);
    resz();
    $(window).resize(function () {
        resz();
    });
    function resz() {
        if (rn.height() < (dc.height()-120)) {
            if (dc.height()-120 < rc.height()) {
                rn.css('min-height',rc.height() + 20);
            }
            else {
                rn.css('min-height',dc.height()-120);
            }
        }
    }
});
