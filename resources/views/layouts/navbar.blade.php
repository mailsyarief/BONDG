
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sunting Profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
    <style>
        /* width */
        ::-webkit-scrollbar {
            display: none;
        }
    </style> 
</head>
<body class="hold-transition lockscreen">
    <nav class="navbar navbar-expand bg-white navbar-light border-bottom navbar-static-top">
        <!-- Left navbar links -->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-user mr-2"></i>{{Auth::user()->name}}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    @if (Auth::user()->role == 0)
                        <a href="../home" class="dropdown-item">
                            <i class="fa fa-circle mr-2"></i>Home
                        </a>
                    @elseif (Auth::user()->role == 1)
                        <a href="../dashboard" class="dropdown-item">
                            <i class="fa fa-circle mr-2"></i>Dashboard
                        </a>
                    @else
                        <a href="../laporan" class="dropdown-item">
                            <i class="fa fa-circle mr-2"></i>Laporan
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                    <a href="../profile" class="dropdown-item">
                        <i class="fa fa-circle mr-2"></i>Sunting Profil
                    </a>
                   
                    <div class="dropdown-divider"></div>                       
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out mr-2"></i> Log Out
                        </a>
                    </form>    
                </div>         
            </li>
            
        </ul>
    </nav>
    <!-- Automatic element centering -->

    @yield('content')


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
    <script>
        $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
        });
    </script>
</body>
</html>
