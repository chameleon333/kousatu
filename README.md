# kousatu

## アプリ概要
アニメ、映画、漫画、小説などの**自身の考察**をシェア、意見を交換するアプリです。
ユーザーをフォローしたり、いいねなどができ、お気に入りの考察を探すことができます。
<br>
<br>

## 作成した経緯
僕自身、小説や映画などが好きで見終わったあとによく考察などを見ます。
ですが、毎回「〜 考察」と検索するのも手間で、またいろんな方の考察を比較しにくいと感じ、できるだけその手間をなくすため「kousatu」を作成しました。
「kousatu」は投稿者のブランディング、読者の考察を見ることを手助けします。
<br>
<br>

## リンク
https://the-kousatu.com
<br>
<br>

## 機能一覧
- ユーザー関係
    - 新規登録、ログイン、ログアウト
    - プロフィール、登録情報編集
    - フォロー、フォロワー一覧表示
    - ユーザー一覧、人気ユーザー一覧

- 記事関係
    - 一覧表示(無限スクロール)、投稿(本番・下書き)、詳細表示、編集、削除
    - ヘッダー画像アップロード
    - MarkDown記法
    - 画像切り抜き
    - コメント
    - ソート(時系列・人気順)
    - Twitterに記事をシェア
    - いいね
    - 記事タイトル検索
    - タグ登録、タグ紐付け、人気のタグ一覧

## 使用画面

| 記事一覧　| 記事詳細  |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/85223459-55c10680-b3fe-11ea-97a9-8042acc72bdd.png">   | <img src="https://user-images.githubusercontent.com/46510584/85223911-69ba3780-b401-11ea-8310-ab3df265d048.png">   |
<br>

| 記事作成 | ヘッダー画像投稿 |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/80681131-01cf2b00-8afb-11ea-9145-92366bf580cd.png"> | <img src="https://user-images.githubusercontent.com/46510584/85223470-75582f00-b3fe-11ea-8d87-b7521655a12d.png"> |
<br>

| フォロー | タグ検索 |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/80681683-1c55d400-8afc-11ea-9120-f5869b41ae96.png"> | <img src="https://user-images.githubusercontent.com/46510584/85223478-8a34c280-b3fe-11ea-8b8b-f4f11cc3b441.png"> |

| プロフィール詳細 | プロフィール編集 |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/85223495-a3d60a00-b3fe-11ea-8f04-40c0c7556c21.png"> | <img src="https://user-images.githubusercontent.com/46510584/85223507-b7817080-b3fe-11ea-9206-e3428da6202b.png"> |
<br>
<br>

## 使用技術

### フロントエンド
- JavaScript
- Jquery 3.4.1
- Vue 2.6.11

### バックエンド
- PHP 7.3.13
- Laravel 6.11.0
- PhpUnit 8.5.2

### インフラストラクチャー
- Mysql 5.7.28
- nginx 1.17.8
- Docker 19.03.5
- docker-compose 1.24.1
- CircleCI
- Terrafrom

- AWS
    - ACM
    - CloudWatch
    - EC2/ALB
    - ECR/ECS
    - RDS
    - Route 53
    - S3
    - VPC

<br>
<br>

## クラウドアーキテクチャー
![kousatu](https://user-images.githubusercontent.com/46510584/80483318-d7615e80-8990-11ea-8676-d11f3189ed2b.png)
