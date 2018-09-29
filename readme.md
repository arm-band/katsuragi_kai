# KATSURAGI KAI

## 概要

PHPで1ファイルの簡易CMSができないかという試み。

1ファイルなので一言。一言といえば一言主神、ということで葛城山を名前にしました。

## 更新履歴

- 2018/09/29 v_0.2.0
    - Mastodon連携部分作りこみ、一通り完了
        - 日時指定投稿に曜日を追加
        - 曜日、日付のどちらかで指定できるように
            - 日付は最低限「日」と時間があれば良し
        - 日時指定ない場合は「指定なし」を追加
- 2018/09/27 v_0.1.5
    - Mastodon連携部分作りこみ
        - データ同期処理実装
        - `tootbot.php`があるなしで諸々の条件を分岐
        - バックアップに`tootbot.php`も追加
- 2018/09/27 v_0.1.4
    - リアルタイム検索のために[list.js](http://listjs.com)をCDN読み込みし、検索できるように改修
- 2018/09/27 v_0.1.3
    - 最終更新日付降順で記事をソートするように改修
- 2018/09/24 v_0.1.2
    - ライセンス追記
- 2018/09/24 v_0.1.1
    - 初期設定時のサイトURLの取得方法をクエリを含まないように改修
- 2018/09/24 v_0.1.0
    - 一通り機能を揃えた