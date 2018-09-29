$(function() {
    //ページトップへ戻る
    pageTop();

    //ページ内スクロール
    pageScroll();

    //ツールチップ
    $('[data-toggle="tooltip"]').tooltip();
//    $.getJSON(jsonFile, {ts: new Date().getTime()}, function(data) {
//    }).done(function(data, status, xhr) {
//    }).fail(function(xhr, status, error) {
//	});
    //エラーページのみ動作
    if($("#error").length) {
        $("#goBack").on("click", function () {
            window.history.back(-1);
            return false;
        });
    }
    //トップページ(コンテンツあり)のみ動作
    if($("#contentsRow").length) {
        var tootMode = parseInt($("#dataTootMode").attr("data-tootmode"));
        var valArray = [];
        if(tootMode) {
            valArray = ["content_title", "content_body", "content_hashtags", "content_keywords"];
        }
        else {
            valArray = ["content_title", "content_body", "content_keywords"];
        }
        //list.js
        var options = {
            valueNames: valArray
        };
        var keyList = new List("wrapper", options);
    }
    //管理画面ページのみ動作
    if($("#dashboard").length) {
        var radioDateWeek = JSON.parse($("#dataWeekDate").attr("data-weekdate"));
        var dataContents = JSON.parse($("#dataContents").attr("data-contents"));
        var $dashboardTabs = $("#dashboardTabs");
        var tootMode = parseInt($("#dataTootMode").attr("data-tootmode"));
        var valArray = [];
        if(tootMode) {
            valArray = ["content_title", "content_body", "content_hashtags", "content_keywords"];
        }
        else {
            valArray = ["content_title", "content_body", "content_keywords"];
        }
        //タブをクリックしたらactiveを外してクリックした方に付け直す
        $dashboardTabs.find("a").on("click", function() {
            $dashboardTabs.find(".nav-link.active").removeClass("active");
            $(this).addClass("active");
            footerPosition(); //フッタの高さ調整
        });
        //ナビゲーションバーのアカウント設定をクリックしたらタブのアカウント設定を擬似クリックする
        $("#navbarAccount").on("click", function() {
            $("#tabAccount").trigger("click");
        });
        //新規作成モーダル中のコンテンツ更新ボタン押した場合
        $("#contentsNewRequest_button").on("click", function() {
            if(tootMode) {
                if($("input[name=\"contentsNewWeekDate\"]:checked").val() === radioDateWeek["dt"]) {
                    var contentsNewDateYear = $("#contentsNewDateYear").val();
                    var contentsNewDateMonth = $("#contentsNewDateMonth").val();
                    var contentsNewDateDay = $("#contentsNewDateDay").val();
                    if((contentsNewDateYear.length > 0 && (contentsNewDateMonth.length === 0 || contentsNewDateDay.length === 0)) || (contentsNewDateYear.length > 0 && contentsNewDateMonth.length > 0 && contentsNewDateDay.length === 0)) {
                        alert("日付の指定が正しくありません。年・月を指定する場合は必ず日も入力してください。");
                        return false;
                    }
                }
            }
        });
        //コンテンツ更新ボタン押した場合
        $(".contentsUpdate_button").on("click", function() {
            //一旦全削除
            $("#contentsUpdateTitle").attr("value", "");
            $("#contentsUpdateContents").text("");
            if(tootMode) {
                $("#contentsUpdateHashTags").val("");
                $("#contentsUpdateImgPath").val("");
                $("input[name=\"contentsUpdateWeekDate\"]:checked").val() === radioDateWeek["no"];
                $("input[name=\"contentsUpdateWeek[]\"]").prop("checked", false);
                $("#contentsUpdateDateYear").val("");
                $("#contentsUpdateDateMonth").val("");
                $("#contentsUpdateDateDay").val("");
                $("#contentsUpdateTime").val("");
            }
            $("#contentsUpdateKeywords").val("");
            $("#contentsUpdateID").val("");
            var id = parseInt($(this).attr("data-contentid")); //ID取得
            var content;
            $.each(dataContents, function(index, value) {
                if(index === id) {
                    content = value;
                }
            });
            $("#contentsUpdateTitle").val(content.ti);
            $("#contentsUpdateContents").text(content.co);
            if(tootMode) {
                $("#contentsUpdateHashTags").val(content.ht);
                $("#contentsUpdateImgPath").val(content.im);
                $("input[name=\"contentsUpdateWeekDate\"][value=\"" + content.wd + "\"]").prop("checked", true);
                console.log(content.dw);
                var dwArray = content.dw.split(",");
                var week = JSON.parse($("#dataWeek").attr("data-week"));
                if(content.wd === radioDateWeek["we"]) { //曜日指定の場合
                    $.each(dwArray, function(index, value) {
                        $("#contentsUpdateWeek" + value).prop("checked", true); //値が存在すればチェックする
                    });
                }
                else if(content.wd === radioDateWeek["dt"]) { //日付指定の場合
                    $("#contentsUpdateDateYear").val(content.dy);
                    $("#contentsUpdateDateMonth").val(content.dm);
                    $("#contentsUpdateDateDay").val(content.dd);
                }
                $("#contentsUpdateTime").val(content.tm);
                dateDsiabledChange();
            }
            $("#contentsUpdateKeywords").val(content.kw);
            $("#contentsUpdateID").val(id);
        });
        //更新モーダル中のコンテンツ更新ボタン押した場合
        $("#contentsUpdateRequest_button").on("click", function() {
            if(tootMode) {
                if($("input[name=\"contentsUpdateWeekDate\"]:checked").val() === radioDateWeek["dt"]) {
                    var contentsUpdateDateYear = $("#contentsUpdateDateYear").val();
                    var contentsUpdateDateMonth = $("#contentsUpdateDateMonth").val();
                    var contentsUpdateDateDay = $("#contentsUpdateDateDay").val();
                    if((contentsUpdateDateYear.length > 0 && (contentsUpdateDateMonth.length === 0 || contentsUpdateDateDay.length === 0)) || (contentsUpdateDateYear.length > 0 && contentsUpdateDateMonth.length > 0 && contentsUpdateDateDay.length === 0)) {
                        alert("日付の指定が正しくありません。年・月を指定する場合は必ず日も入力してください。");
                        return false;
                    }
                }
            }
        });
        //コンテンツ削除ボタン押した場合
        $(".contentsDelete_button").on("click", function() {
            var id = parseInt($(this).attr("data-contentid")); //ID取得
            var content;
            $.each(dataContents, function(index, value) {
                if(index === id) {
                    content = value;
                }
            });
            $("#contentsDeleteTitle").val(content.ti);
            $("#contentsDeleteID").val(id);
        });
        if(tootMode) {
            $("input[name=\"contentsNewWeekDate\"]").on("change", function() {
                //新規作成の投稿予約日時
                if($("input[name=\"contentsNewWeekDate\"]:checked").val() === radioDateWeek["no"]) {
                    $("input[name=\"contentsNewWeek[]\"]").attr("disabled", "disabled");
                    $("#contentsNewDateYear").attr("disabled", "disabled");
                    $("#contentsNewDateMonth").attr("disabled", "disabled");
                    $("#contentsNewDateDay").attr("disabled", "disabled");
                    $("#contentsNewTime").attr("disabled", "disabled");
                }
                else if($("input[name=\"contentsNewWeekDate\"]:checked").val() === radioDateWeek["we"]) {
                    $("input[name=\"contentsNewWeek[]\"]").removeAttr("disabled");
                    $("#contentsNewTime").removeAttr("disabled");
                    $("#contentsNewDateYear").attr("disabled", "disabled");
                    $("#contentsNewDateMonth").attr("disabled", "disabled");
                    $("#contentsNewDateDay").attr("disabled", "disabled");
                }
                else if($("input[name=\"contentsNewWeekDate\"]:checked").val() === radioDateWeek["dt"]) {
                    $("#contentsNewDateYear").removeAttr("disabled");
                    $("#contentsNewDateMonth").removeAttr("disabled");
                    $("#contentsNewDateDay").removeAttr("disabled");
                    $("#contentsNewTime").removeAttr("disabled");
                    $("input[name=\"contentsNewWeek[]\"]").attr("disabled", "disabled");
                }
            });
            $("input[name=\"contentsUpdateWeekDate\"]").on("change", function() {
                dateDsiabledChange();
            });
            function dateDsiabledChange() {
                //更新の投稿予約日時
                if($("input[name=\"contentsUpdateWeekDate\"]:checked").val() === radioDateWeek["no"]) {
                    $("input[name=\"contentsUpdateWeek[]\"]").attr("disabled", "disabled");
                    $("#contentsUpdateDateYear").attr("disabled", "disabled");
                    $("#contentsUpdateDateMonth").attr("disabled", "disabled");
                    $("#contentsUpdateDateDay").attr("disabled", "disabled");
                    $("#contentsUpdateTime").attr("disabled", "disabled");
                }
                else if($("input[name=\"contentsUpdateWeekDate\"]:checked").val() === radioDateWeek["we"]) {
                    $("input[name=\"contentsUpdateWeek[]\"]").removeAttr("disabled");
                    $("#contentsUpdateTime").removeAttr("disabled");
                    $("#contentsUpdateDateYear").attr("disabled", "disabled");
                    $("#contentsUpdateDateMonth").attr("disabled", "disabled");
                    $("#contentsUpdateDateDay").attr("disabled", "disabled");
                }
                else if($("input[name=\"contentsUpdateWeekDate\"]:checked").val() === radioDateWeek["dt"]) {
                    $("#contentsUpdateDateYear").removeAttr("disabled");
                    $("#contentsUpdateDateMonth").removeAttr("disabled");
                    $("#contentsUpdateDateDay").removeAttr("disabled");
                    $("#contentsUpdateTime").removeAttr("disabled");
                    $("input[name=\"contentsUpdateWeek[]\"]").attr("disabled", "disabled");
                }
            }
        }
        //管理画面(コンテンツあり)のみ動作
        if($("#contentsTable").length) {
            //list.js
            var options = {
                valueNames: valArray
            };
            var keyList = new List("wrapper", options);
        }
    }
});

//ロード時とリサイズ時にイベント発生
$(window).on("load resize", function() {
    //フッタの位置をコンテンツの高さに応じて変化させる
    footerPosition();
});

//ページトップへ戻る
function pageTop() {
    var returnPageTop = $(".returnPageTop");

    $(window).on("scroll", function(){
        //スクロール距離が400pxより大きければページトップへ戻るボタンを表示
        var currentPos = $(this).scrollTop();
        if (currentPos > 400) {
            returnPageTop.fadeIn();
        } else {
            returnPageTop.fadeOut();
        }
    });

    //ページトップへスクロールして戻る
    returnPageTop.on("click", function () {
        $("body, html").animate({ scrollTop: 0 }, 1000, "easeInOutCirc");
        return false;
    });
}

//ページ内スクロール
function pageScroll() {
    if($("#index").length) { //トップページの場合のみ動作
        var navbarHeight = parseInt($("#index").attr("data-offset"));
        var $navbar = $("#navbar");
        $navbar.find("a:not(.dropdown-toggle)").on("click", function() {
            var speed = 1000;
            var href = $(this).attr("href");
            var targetID = "";
            if(/^(\.\/|\/)$|^(#)?$/.test(href)) { //hrefの値が「/」「./」「#」「」の場合
                targetID = "html";
            }
            else if(/^(\.\/|\/)#.+/.test(href)) { //hrefの値が「/#HOGE」「./#HOGE」「#HOGE」の場合
                targetID = href.slice(RegExp.$1.length); //正規表現の後方参照により"(\.\/|\/)"をRegExp.$1に格納、その文字列の長さを削除し、「#HOGE」だけの状態にして渡す
            }
            else {
                targetID = href;
            }
            var target = $(targetID);
            var position = target.offset().top - navbarHeight;
            $("body, html").animate({ scrollTop:position }, speed, "easeInOutCirc");
            $navbar.find(".navbar-toggle[data-target=\"#navbarList\"]").click(); //移動したらハンバーガーを折りたたむ
            return false;
        });
    }
}

//フッタの位置をコンテンツの高さに応じて変化させる
function footerPosition() {
    var $footer = $(".footer");
    var footerHeight = $footer.height();
    var $wrapper = $("#wrapper");
    var wrapperHeight = $wrapper.height() + $(".header").height() + $footer.height();
    if(wrapperHeight <= window.innerHeight) {
       $footer.addClass("footerAbsolute");
    }
    else {
        $footer.removeClass("footerAbsolute");
    }
}