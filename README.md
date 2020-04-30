# kousatu

## アプリ概要
アニメ、映画、漫画、小説などの**自身の考察**をシェア、意見を交換するアプリです。
ユーザーをフォローしたり、いいねなどができ、お気に入りの考察を探すことができます。

## 作成した経緯
僕自身、小説や映画などが好きで見終わったあとによく考察などを見ます。
ですが、毎回「〜 考察」と検索するのも手間で、またいろんな方の考察を比較しにくいと感じ、できるだけその手間をなくすため「kousatu」を作成しました。

## リンク
http://the-kousatu.com

## 使用画面
| 記事一覧　| 記事詳細  |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/80677075-2a532700-8af3-11ea-8069-3a2948b9c426.png">   | <img src="https://user-images.githubusercontent.com/46510584/80677196-7605d080-8af3-11ea-8b33-547c23efd120.png">   |
<br>

| 記事作成 | ヘッダー画像投稿 |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/80681131-01cf2b00-8afb-11ea-9145-92366bf580cd.png"> | <img src="https://user-images.githubusercontent.com/46510584/80681229-3642e700-8afb-11ea-884a-f4bf92823972.png"> |
<br>

| フォロー | タグ検索 |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/80681683-1c55d400-8afc-11ea-9120-f5869b41ae96.png"> | <img src="https://user-images.githubusercontent.com/46510584/80681883-81112e80-8afc-11ea-9d7e-9e338e999b80.png"> |

| プロフィール詳細 | プロフィール編集 |
| :----: | :----: |
| <img src="https://user-images.githubusercontent.com/46510584/80681397-989be780-8afb-11ea-8a97-3e9c7354ab5c.png"> | <img src="https://user-images.githubusercontent.com/46510584/80681489-c41ed200-8afb-11ea-80d1-fa9f968cdcf0.png"> |
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

- AWS
    - CloudWatch
    - EC2/ALB
    - ECR/ECS
    - RDS
    - Route 53
    - S3
    - VPC

## クラウドアーキテクチャー
![kousatu](https://user-images.githubusercontent.com/46510584/80483318-d7615e80-8990-11ea-8676-d11f3189ed2b.png)
