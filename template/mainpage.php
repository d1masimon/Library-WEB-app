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
    <style>
    .avatar {
    background: #467fcf no-repeat center/cover;
    color: #ffffff;
  }
  .no-sort::after { display: none!important; }

.no-sort { pointer-events: none!important; cursor: default!important; }
</style>
  </head>
  <body class="">
    <div class="page">
      <div class="flex-fill">

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">	
              <h1 class="page-title">
                Библиотека
              </h1>
			  
			  <a href="/books/add/" class="btn btn-primary page-options"><i class="fe fe-plus"></i> Добавить книгу</a>
            </div>
            <div class="card">
              <table class="table card-table" id="books">
                <tr>
                  <th></th>
                  <th>Автор</th>
                  <th>Название книги</th>
                  <th>Год</th>
				  <th></th>
                </tr>			
              </table>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Тестовое задание для АртВизио. WEB приложение "Библиотека" 
            </div>
          </div>
        </div>
      </footer>
    </div>
	<script type="text/javascript" language="javascript">
	$.getJSON('/api/books/list/', function(data) {
        $.each(data, function(index) {
			$("#books").append('<tr><td>' + data[index].id + '</td><td>' + data[index].author + '</td><td>' + data[index].name + '</td><td>' + data[index].year + '</td><td><a href="/books/' + data[index].id + '/edit/" class="icon"><i class="fe fe-edit"></i></a></td></tr>');
        });
    });
	</script>
  </body>
</html>