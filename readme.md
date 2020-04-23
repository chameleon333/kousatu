# kousatu

## アプリ概要
アニメ、映画、漫画、小説などの**自身の考察**をシェア、意見を交換するアプリです。
ユーザーをフォローしたり、いいねなどができ、お気に入りの考察を探すことができます。

## 作成した経緯
僕自身、小説や映画などが好きで見終わったあとによく考察などを見ます。
ですが、毎回「〜 考察」と検索するのも手間で、またいろんな方の考察を比較しにくいと感じ、できるだけその手間をなくすため「kousatu」を作成しました。

## リンク
http://kousatu-load-balancer-880006891.ap-northeast-1.elb.amazonaws.com/

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
    - ECR/ECS
    - EC2/ALB
    - RDS
    - S3
    - VPC
    - CloudWatch