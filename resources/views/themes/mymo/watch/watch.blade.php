@extends('themes.mymo.layout')

@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 hidden-xs">
                    <div class="yoast_breadcrumb">
                        <span>
                            <span>
                                <a href="/">@lang('app.home')</a> » <span>
                                    <a href="{{ route('genre', [$genre->slug]) }}">{{ $genre->name }}</a> »
                                    <span class="breadcrumb_last" aria-current="page">{{ $info->name }}</span>
                                </span>
                            </span>
                        </span>
                    </div>
                </div>

                <div class="col-xs-4 text-right">
                    <a href="javascript:;" id="expand-ajax-filter">@lang('app.filter_movies') <i id="ajax-filter-icon" class="hl-angle-down"></i></a>
                </div>

                <div id="alphabet-filter" style="float: right;display: inline-block;margin-right: 25px;"></div>
            </div>
        </div>
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div><!-- end panel-default -->

    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section id="content">
            <div class="clearfix wrap-content">
                <script>var halim_cfg = {
                        "act": "watch",
                        "post_url": "{{ url()->current() }}",
                        "ajax_url": "",
                        "set_movie_view_url": "{{ route('watch.set_view', [$info->slug]) }}",
                        "player_url": "{{ route('watch.player', [$info->slug, $vid]) }}",
                        "loading_img": "{{ asset('styles/themes/mymo/images/ajax-loader.gif') }}",
                        "eps_slug": "tap",
                        "server_slug": "s",
                        "type_slug": "slug-2",
                        "post_title": "{{ $info->name }}",
                        "post_id": '{{ $info->id }}',
                        "episode_slug": "tap-1",
                        "server": "1",
                        "player_error_detect": "display_modal",
                        "paging_episode": "false",
                        "episode_display": "show_list_eps",
                        "episode_nav_num": 100,
                        "auto_reset_cache": true,
                        "resume_playback": true,
                        "resume_text": "Tự động phát lại phim từ thời điểm bạn xem gần đây nhất tại",
                        "resume_text_2": "Phát lại từ đầu?",
                        "playback": "Phát lại",
                        "continue_watching": "Xem tiếp",
                        "player_reload": "Tải lại trình phát",
                        "jw_error_msg_0": "Chúng tôi không thể tìm thấy video bạn đang tìm kiếm. Có thể có một số lý do cho việc này, ví dụ như nó đã bị xóa bởi chủ sở hữu!",
                        "jw_error_msg_1": "Video lỗi không thể phát được.",
                        "jw_error_msg_2": "Để xem tiếp, vui lòng click vào nút \"Tải lại trình phát\"",
                        "jw_error_msg_3": "hoặc click vào các nút được liệt kê bên dưới",
                        "light_on": "Bật đèn",
                        "light_off": "Tắt đèn",
                        "expand": "Phóng to",
                        "collapse": "Thu nhỏ",
                        "player_loading": "Đang khởi tạo trình phát, vui lòng chờ...",
                        "player_autonext": "Đang tự động chuyển tập, vui lòng chờ...",
                        "is_adult": false,
                        "adult_title": "Adult Content Warning!",
                        "adult_content": "<span style=\"vertical-align: inherit;\"><span style=\"vertical-align: inherit;\">Trang web này chứa nội dung dành cho các cá nhân từ 18\/21 tuổi trở lên được xác định theo luật pháp địa phương và quốc gia của khu vực nơi bạn cư trú. <\/span><span style=\"vertical-align: inherit;\">Nếu bạn chưa đủ 18 tuổi, hãy rời khỏi trang web này ngay lập tức. <\/span><span style=\"vertical-align: inherit;\">Khi vào trang web này, bạn đồng ý rằng bạn từ 18 tuổi trở lên. <\/span><span style=\"vertical-align: inherit;\">Bạn sẽ không phân phối lại tài liệu này cho bất kỳ ai, và bạn cũng sẽ không cho phép bất kỳ trẻ vị thành niên nào xem tài liệu này.<\/span><\/span>",
                        "show_only_once": "Không hiển thị lại",
                        "exit_btn": "THOÁT",
                        "is_18plus": "TÔI ĐỦ 18 TUỔI",
                        "report_lng": {
                            "title": "Tổ Chức Rugal",
                            "alert": "Tên (email) và nội dung là bắt buộc",
                            "msg": "Nội dung",
                            "msg_success": "Cảm ơn bạn đã gửi thông báo lỗi. Chúng tôi sẽ tiến hành sửa lỗi sớm nhất có thể",
                            "loading_img": "http:\/\/xemphimplus.net\/wp-content\/plugins\/halim-movie-report\/loading.gif",
                            "report_btn": "Báo lỗi",
                            "name_or_email": "Tên hoặc Email",
                            "close": "Đóng"
                        }
                    }</script>
                <div class="clearfix"></div>
                <div class="text-center">
                    <div class="textwidget">
                    </div>
                </div>
                <div class="clearfix"></div>

                <div id="halim-player-wrapper" class="ajax-player-loading" data-adult-content="">
                    <div id="halim-player-loader"></div>
                    <div id="ajax-player" class="player"></div>
                </div>

                <div class="clearfix"></div>

                <div class="button-watch">
                    <ul class="halim-social-plugin col-xs-4 hidden-xs">
                        <li class="fb-like" data-href="/to-chuc-rugal/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                    </ul>
                    <ul class="col-xs-12 col-md-8">
                        <div id="autonext" class="btn-cs autonext">
                            <i class="icon-autonext-sm"></i>
                            <span><i class="hl-next"></i> Autoplay next episode: <span id="autonext-status">On</span></span>
                        </div>

                        <div id="explayer" class="hidden-xs">
                            <i class="hl-resize-full"></i>
                            Phóng to
                        </div>

                        <div id="toggle-light"><i class="hl-adjust"></i>
                            Tắt đèn
                        </div>

                        <div id="report" class="halim-switch">
                            <i class="hl-attention"></i> Báo lỗi
                        </div>

                        <div class="luotxem"><i class="hl-eye"></i>
                            <span>249.9K</span> lượt xem
                        </div>

                        <div class="luotxem visible-xs-inline">
                            <a data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Chia sẻ</a>
                        </div>

                    </ul>
                </div>

                <div class="collapse" id="moretool">
                    <ul class="nav nav-pills x-nav-justified">
                        <li class="fb-like" data-href="/to-chuc-rugal/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                        <div class="fb-save" data-uri="/to-chuc-rugal/" data-size="small"></div>
                    </ul>
                </div>

                <div class="clearfix"></div>
                <div class="text-center">			<div class="textwidget"><p style="color: yellow;border: 1px solid;padding: 5px;">Hãy <strong>Đăng Nhập</strong> ẩn hết <strong>&nbsp;Quảng Cáo</strong>!</p>
                    </div>
                </div><div class="text-center">			<div class="textwidget">
                        <style type="text/css">
                            #main-contents{position:relative;}
                            .float-left{position:absolute;left:-130px;top:0;}
                            .float-right{position:absolute;right:-460px;top:0;}
                        </style>

                    </div>
                </div>        <div class="clearfix"></div>

                <div class="title-block watch-page">
                    <a href="javascript:;" data-toggle="tooltip" title="Thêm vào tủ phim">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-post_id="14773" data-thumbnail="/wp-content/uploads/2020/04/to-chuc-rugal-14773-thumbnail.jpg" data-href="/to-chuc-rugal" data-title="Tổ Chức Rugal" data-date="2020-04-04">
                            <!-- <div class="halim-pulse-ring"></div> -->
                        </div>
                    </a>
                    <div class="title-wrapper full">
                        <h1 class="entry-title"><a href="/to-chuc-rugal" title="Xem phim Tổ Chức Rugal Tập 1 Full [Vietsub + Thuyết minh]" class="tl">Xem phim Tổ Chức Rugal Tập 1 Full [Vietsub + Thuyết minh]</a></h1>
                        <span class="plot-collapse" data-toggle="collapse" data-target="#expand-post-content" aria-expanded="false" aria-controls="expand-post-content" data-text="Nội dung phim"><i class="hl-angle-down"></i></span>
                    </div>

                    <div class="ratings_wrapper">
                        <div class="halim_imdbrating taq-score">
                            <span class="score">4.28</span><i>/</i>
                            <span class="max-ratings">5</span>
                            <span class="total_votes">8</span><span class="vote-txt"> đánh giá</span>
                        </div>
                        <div class="rate-this">
                            <div data-rate="85.5" data-id="14773" class="user-rate user-rate-active">
            <span class="user-rate-image post-large-rate stars-large">
                <span style="width: 85.5%"></span>
            </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                    <article id="post-14773" class="item-content post-14773">
                        {!! $info->description !!}
                    </article>
                </div>
                <div class="clearfix"></div>
                <div class="text-center halim-ajax-list-server"><div id="halim-ajax-list-server"><script>var svlists = [];</script></div></div><div id="halim-list-server" class="list-eps-ajax"><div class="halim-server show_all_eps" data-episode-nav=""><span class="halim-server-name"><span class="hl-server"></span> Server HD</span><ul id="listsv-1" class="halim-list-eps"><li class="active halim-episode halim-episode-1-tap-1"><a href="/xem-phim-to-chuc-rugal/tap-1-sv1.html" title="1"><span class="active halim-info-1-tap-1 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-1" data-position="first" data-embed="0">1</span></a></li><li class="halim-episode halim-episode-1-tap-2"><a href="/xem-phim-to-chuc-rugal/tap-2-sv1.html" title="2"><span class="halim-info-1-tap-2 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-2" data-position="" data-embed="0">2</span></a></li><li class="halim-episode halim-episode-1-tap-3"><a href="/xem-phim-to-chuc-rugal/tap-3-sv1.html" title="3"><span class="halim-info-1-tap-3 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-3" data-position="" data-embed="0">3</span></a></li><li class="halim-episode halim-episode-1-tap-4"><a href="/xem-phim-to-chuc-rugal/tap-4-sv1.html" title="4"><span class="halim-info-1-tap-4 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-4" data-position="" data-embed="0">4</span></a></li><li class="halim-episode halim-episode-1-tap-5"><a href="/xem-phim-to-chuc-rugal/tap-5-sv1.html" title="5"><span class="halim-info-1-tap-5 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-5" data-position="" data-embed="0">5</span></a></li><li class="halim-episode halim-episode-1-tap-6"><a href="/xem-phim-to-chuc-rugal/tap-6-sv1.html" title="6"><span class="halim-info-1-tap-6 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-6" data-position="" data-embed="0">6</span></a></li><li class="halim-episode halim-episode-1-tap-7"><a href="/xem-phim-to-chuc-rugal/tap-7-sv1.html" title="7"><span class="halim-info-1-tap-7 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-7" data-position="" data-embed="0">7</span></a></li><li class="halim-episode halim-episode-1-tap-8"><a href="/xem-phim-to-chuc-rugal/tap-8-sv1.html" title="8"><span class="halim-info-1-tap-8 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-8" data-position="" data-embed="0">8</span></a></li><li class="halim-episode halim-episode-1-tap-9"><a href="/xem-phim-to-chuc-rugal/tap-9-sv1.html" title="9"><span class="halim-info-1-tap-9 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-9" data-position="" data-embed="0">9</span></a></li><li class="halim-episode halim-episode-1-tap-10"><a href="/xem-phim-to-chuc-rugal/tap-10-sv1.html" title="10"><span class="halim-info-1-tap-10 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-10" data-position="" data-embed="0">10</span></a></li><li class="halim-episode halim-episode-1-tap-11"><a href="/xem-phim-to-chuc-rugal/tap-11-sv1.html" title="11"><span class="halim-info-1-tap-11 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-11" data-position="" data-embed="0">11</span></a></li><li class="halim-episode halim-episode-1-tap-12"><a href="/xem-phim-to-chuc-rugal/tap-12-sv1.html" title="12"><span class="halim-info-1-tap-12 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-12" data-position="" data-embed="0">12</span></a></li><li class="halim-episode halim-episode-1-tap-13"><a href="/xem-phim-to-chuc-rugal/tap-13-sv1.html" title="13"><span class="halim-info-1-tap-13 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-13" data-position="" data-embed="0">13</span></a></li><li class="halim-episode halim-episode-1-tap-14"><a href="/xem-phim-to-chuc-rugal/tap-14-sv1.html" title="14"><span class="halim-info-1-tap-14 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-14" data-position="" data-embed="0">14</span></a></li><li class="halim-episode halim-episode-1-tap-15"><a href="/xem-phim-to-chuc-rugal/tap-15-sv1.html" title="15"><span class="halim-info-1-tap-15 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-15" data-position="" data-embed="0">15</span></a></li><li class="halim-episode halim-episode-1-tap-16"><a href="/xem-phim-to-chuc-rugal/tap-16-sv1.html" title="16"><span class="halim-info-1-tap-16 box-shadow halim-btn" data-post-id="14773" data-server="1"  data-episode-slug="tap-16" data-position="last" data-embed="0">16</span></a></li></ul><div class="clearfix"></div></div><div id="pagination-1"></div><div class="halim-server show_all_eps" data-episode-nav=""><span class="halim-server-name"><span class="hl-server"></span> Server VIP</span><ul id="listsv-2" class="halim-list-eps"><li class="halim-episode halim-episode-2-tap-1"><span data-href="/xem-phim-to-chuc-rugal/tap-1-sv2.html" class="clickable halim-info-2-tap-1 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-1" data-position="first" data-embed="0">1</span></li><li class="halim-episode halim-episode-2-tap-2"><span data-href="/xem-phim-to-chuc-rugal/tap-2-sv2.html" class="clickable halim-info-2-tap-2 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-2" data-position="" data-embed="0">2</span></li><li class="halim-episode halim-episode-2-tap-3"><span data-href="/xem-phim-to-chuc-rugal/tap-3-sv2.html" class="clickable halim-info-2-tap-3 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-3" data-position="" data-embed="0">3</span></li><li class="halim-episode halim-episode-2-tap-4"><span data-href="/xem-phim-to-chuc-rugal/tap-4-sv2.html" class="clickable halim-info-2-tap-4 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-4" data-position="" data-embed="0">4</span></li><li class="halim-episode halim-episode-2-tap-5"><span data-href="/xem-phim-to-chuc-rugal/tap-5-sv2.html" class="clickable halim-info-2-tap-5 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-5" data-position="" data-embed="0">5</span></li><li class="halim-episode halim-episode-2-tap-6"><span data-href="/xem-phim-to-chuc-rugal/tap-6-sv2.html" class="clickable halim-info-2-tap-6 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-6" data-position="" data-embed="0">6</span></li><li class="halim-episode halim-episode-2-tap-7"><span data-href="/xem-phim-to-chuc-rugal/tap-7-sv2.html" class="clickable halim-info-2-tap-7 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-7" data-position="" data-embed="0">7</span></li><li class="halim-episode halim-episode-2-tap-8"><span data-href="/xem-phim-to-chuc-rugal/tap-8-sv2.html" class="clickable halim-info-2-tap-8 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-8" data-position="" data-embed="0">8</span></li><li class="halim-episode halim-episode-2-tap-9"><span data-href="/xem-phim-to-chuc-rugal/tap-9-sv2.html" class="clickable halim-info-2-tap-9 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-9" data-position="" data-embed="0">9</span></li><li class="halim-episode halim-episode-2-tap-10"><span data-href="/xem-phim-to-chuc-rugal/tap-10-sv2.html" class="clickable halim-info-2-tap-10 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-10" data-position="" data-embed="0">10</span></li><li class="halim-episode halim-episode-2-tap-11"><span data-href="/xem-phim-to-chuc-rugal/tap-11-sv2.html" class="clickable halim-info-2-tap-11 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-11" data-position="" data-embed="0">11</span></li><li class="halim-episode halim-episode-2-tap-12"><span data-href="/xem-phim-to-chuc-rugal/tap-12-sv2.html" class="clickable halim-info-2-tap-12 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-12" data-position="" data-embed="0">12</span></li><li class="halim-episode halim-episode-2-tap-13"><span data-href="/xem-phim-to-chuc-rugal/tap-13-sv2.html" class="clickable halim-info-2-tap-13 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-13" data-position="" data-embed="0">13</span></li><li class="halim-episode halim-episode-2-tap-14"><span data-href="/xem-phim-to-chuc-rugal/tap-14-sv2.html" class="clickable halim-info-2-tap-14 box-shadow halim-btn" data-post-id="14773" data-server="2" data-episode-slug="tap-14" data-position="" data-embed="0">14</span></li></ul><div class="clearfix"></div></div><div id="pagination-2"></div><div class="halim-server show_all_eps" data-episode-nav=""><span class="halim-server-name"><span class="hl-server"></span> Server VIP 2</span><ul id="listsv-3" class="halim-list-eps"><li class="halim-episode halim-episode-3-tap-1"><span data-href="/xem-phim-to-chuc-rugal/tap-1-sv3.html" class="clickable halim-info-3-tap-1 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-1" data-position="first" data-embed="0">1</span></li><li class="halim-episode halim-episode-3-tap-2"><span data-href="/xem-phim-to-chuc-rugal/tap-2-sv3.html" class="clickable halim-info-3-tap-2 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-2" data-position="" data-embed="0">2</span></li><li class="halim-episode halim-episode-3-tap-3"><span data-href="/xem-phim-to-chuc-rugal/tap-3-sv3.html" class="clickable halim-info-3-tap-3 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-3" data-position="" data-embed="0">3</span></li><li class="halim-episode halim-episode-3-tap-4"><span data-href="/xem-phim-to-chuc-rugal/tap-4-sv3.html" class="clickable halim-info-3-tap-4 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-4" data-position="" data-embed="0">4</span></li><li class="halim-episode halim-episode-3-tap-5"><span data-href="/xem-phim-to-chuc-rugal/tap-5-sv3.html" class="clickable halim-info-3-tap-5 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-5" data-position="" data-embed="0">5</span></li><li class="halim-episode halim-episode-3-tap-6"><span data-href="/xem-phim-to-chuc-rugal/tap-6-sv3.html" class="clickable halim-info-3-tap-6 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-6" data-position="" data-embed="0">6</span></li><li class="halim-episode halim-episode-3-tap-7"><span data-href="/xem-phim-to-chuc-rugal/tap-7-sv3.html" class="clickable halim-info-3-tap-7 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-7" data-position="" data-embed="0">7</span></li><li class="halim-episode halim-episode-3-tap-8"><span data-href="/xem-phim-to-chuc-rugal/tap-8-sv3.html" class="clickable halim-info-3-tap-8 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-8" data-position="" data-embed="0">8</span></li><li class="halim-episode halim-episode-3-tap-9"><span data-href="/xem-phim-to-chuc-rugal/tap-9-sv3.html" class="clickable halim-info-3-tap-9 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-9" data-position="" data-embed="0">9</span></li><li class="halim-episode halim-episode-3-tap-10"><span data-href="/xem-phim-to-chuc-rugal/tap-10-sv3.html" class="clickable halim-info-3-tap-10 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-10" data-position="" data-embed="0">10</span></li><li class="halim-episode halim-episode-3-tap-11"><span data-href="/xem-phim-to-chuc-rugal/tap-11-sv3.html" class="clickable halim-info-3-tap-11 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-11" data-position="" data-embed="0">11</span></li><li class="halim-episode halim-episode-3-tap-12"><span data-href="/xem-phim-to-chuc-rugal/tap-12-sv3.html" class="clickable halim-info-3-tap-12 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-12" data-position="" data-embed="0">12</span></li><li class="halim-episode halim-episode-3-tap-14"><span data-href="/xem-phim-to-chuc-rugal/tap-14-sv3.html" class="clickable halim-info-3-tap-14 box-shadow halim-btn" data-post-id="14773" data-server="3" data-episode-slug="tap-14" data-position="" data-embed="0">14</span></li></ul><div class="clearfix"></div></div><div id="pagination-3"></div></div>        <div class="clearfix"></div>
                <div class="htmlwrap clearfix">
                    <div class="fb-comments"  data-href="/to-chuc-rugal/" data-width="100%" data-mobile="true" data-colorscheme="dark" data-numposts="5" data-order-by="reverse_time"></div>
                </div>
                <div id="lightout"></div>

            </div>
        </section>

        <section class="related-movies">

            <div id="halim_related_movies-2xx" class="wrap-slider">
                <div class="section-bar clearfix">
                    <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM?</span></h3>
                </div>
                <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                    @foreach($related_movies as $item)
                        <article class="thumb grid-item post-{{ $item->id }}">
                            @include('themes.mymo.data.relate_item')
                        </article>
                    @endforeach
                </div>
                <script>
                    jQuery(document).ready(function ($) {
                        var owl = $('#halim_related_movies-2');
                        owl.owlCarousel({
                            loop: true,
                            margin: 4,
                            autoplay: true,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            nav: true,
                            navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
                            responsiveClass: true,
                            responsive: {0: {items: 2}, 480: {items: 3}, 600: {items: 4}, 1000: {items: 4}}
                        })
                    });
                </script>
            </div>
        </section>
        <div class="the_tag_list">
            @foreach($tags as $tag)
                <a href="{{ route('tag', [$tag->slug]) }}" title="{{ $tag->name }}" rel="tag">{{ $tag->name }}</a>
            @endforeach
        </div>
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        @include('themes.mymo.data.sidebar')
    </aside>
</div>
@endsection