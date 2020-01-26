<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="/template/assets/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="/template/assets/favicon.ico" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>Библиотека</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="/template/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '/template/'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="/template/assets/css/dashboard.css" rel="stylesheet" />
    <script src="/template/assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="/template/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="/template/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="/template/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="/template/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="/template/assets/plugins/input-mask/plugin.js"></script>
    <!-- Datatables Plugin -->
    <script src="/template/assets/plugins/datatables/plugin.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="flex-fill">

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">	
              <h1 class="page-title">
                Добавить книгу
              </h1>
            </div>
            <form class="card" method="POST" action="/api/books/add/">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">Автор</label>
                          <input type="text" name="author" class="form-control" placeholder="Автор">
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">Год</label>
                          <input type="text" name="year" class="form-control" data-mask="0000" data-mask-clearifnotmatch="true" placeholder="0000" />
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-label">Название книги</label>
                          <input type="text" name="name" class="form-control" placeholder="Название">
                        </div>
                      </div>
                      
                      

                  </div>
                  <div class="text-right">
				  <a class="btn btn-primary text-white" href="/">Назад</a>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </div>
	<script>
                require(['input-mask']);
              </script>
  </body>
</html>