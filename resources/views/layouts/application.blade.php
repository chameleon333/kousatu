<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    
    body {
      margin: 0;
      background:#f1f1f1;
      font-family: "Lato", sans-serif;
    }
    textarea {
      width:100%;
    }
    /* Style the header with a grey background and some padding */
    .header {
      overflow: hidden;
      background-color: #4CAF50;
      padding: 20px 25px 20px 20px;
    }

    /* Style the header links */
    .header a {
      float: left;
      color: white;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
      border-radius: 4px;
    }

    /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
    .header a.logo {
      font-size: 25px;
      font-weight: bold;
    }

    /* Change the background color on mouse-over */
    .header a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Style the active/current link*/
    .header a.active {
      background-color: dodgerblue;
      color: white;
    }

    /* Float the link section to the right */
    .header-right {
      float: right;
    }

    .sidebar {
      margin: 0;
      padding: 0;
      width: 130px;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
    }

    .sidebar a {
      display: block;
      color: black;
      font-size: 12px;
      padding: 5px;
      text-decoration: none;
    }

    .sidebar a.active {
      background-color: #4CAF50;
      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }

    div.content {
      margin-left: 150px;
      padding: 0px 16px;
      margin-top:30px;
      height: 1000px;
    }
    
    .post_box a{
/*      text-decoration: none;*/
      color: black;
    }
    
    .post_pic img{
      width:100%;
      border-radius: 10px;
    }
    
    

    /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }

      .header-right {
        float: none;
      }
    }
    
    @media (min-width: 992px) {
      .container{
        max-width:750px !important;
        
      }
      
    }
    
    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .sidebar a {
        float: left;
      }

      div.content {
        margin-left: 0;
      }
    }
    
    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }

  </style>

  <title>@yield('title')</title>
</head>

<body>
  <div class="header">
    <a href="/articles" class="logo">CompanyLogo</a>
    <div class="header-right">
      <a class="active" href="/articles">Home</a>
      <a href="/articles/create">投稿する</a>
      <a href="#about">About</a>
    </div>
  </div>

  <div class="container">
    <div class="sidebar">
      <a class="active" href="/articles">Home</a>
      <a href="#news">News</a>
      <a href="#contact">Contact</a>
      <a href="#about">About</a>
    </div>

    <div class="content">
      <!-- Content here -->
      @yield('content')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
