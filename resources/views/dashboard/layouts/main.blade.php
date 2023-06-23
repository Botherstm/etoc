<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>Alwindi | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    <link href="/css/dashboard.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dashboard.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');
        body {
            font-family: 'Pangolin', sans-serif;
        }
        
/* 
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            z-index: 999;
            padding-top: 60px;
            transition: transform 0.3s ease-in-out;
            font-family: 'Pangolin', sans-serif;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar.closed {
            transform: translateX(-250px);
        }

        .sidebar-header {
            padding: 15px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 500;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            padding: 10px 15px;
        }

        .sidebar-menu li a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .sidebar-menu li:hover {
            background-color: #e9ecef;
        }

        .sidebar-menu li:hover a {
            color: #007bff;
        }

        .toggle-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
        }*/

        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    
    .modals {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    

    //

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    color: #fff;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 99;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.832);
}

.logo a {
    color: #fff;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
}

.nav-links {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin-left: 20px;
}

.nav-links li a {
    color: #fff;
    text-decoration: none;
}

.toggle-sidebar {
    display: none;
    cursor: pointer;
    padding: 10px;
}

.toggle-sidebar .burger {
    width: 25px;
    height: 3px;
    background-color: #fff;
    margin: 5px;
    transition: all 0.3s ease;
}

#sidebar {
    margin-top: 70px;
    position: fixed;
    top: 0;
    left: 0;
    width: 200px;
    height: 100%;
    background-color: #333;
    color: #fff;
    padding: 20px;
    transition: all 0.3s ease;
    z-index: 2;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.832);
}

#sidebar ul {
    list-style: none;
    padding: 0;
}

#sidebar ul li {
    margin-bottom: 10px;
}

#sidebar ul li a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

#sidebar ul li a:hover {
    background-color: #555;
}

.content {
    padding: 20px;
    margin-top: 30px; /* Tambahkan margin top yang lebih besar */
    z-index: 1;
}

/* Animasi Sidebar */
@keyframes slideIn {
    from {
        transform: translateX(-100%);
    }
    to {
        transform: translateX(0);
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}

@media screen and (max-width: 768px) {
    .nav-links {
        display: none;
    }

    .toggle-sidebar {
        display: block;
    }

    .toggle-sidebar.active .burger {
        background-color: transparent;
    }

    .toggle-sidebar.active .burger:before {
        transform: rotate(45deg) translate(6px, 6px);
    }

    .toggle-sidebar.active .burger:after {
        transform: rotate(-45deg) translate(6px, -6px);
    }

    #sidebar {
        animation: slideOut 0.3s ease;
        left: -100%;
    }

    #sidebar.active {
        animation: slideIn 0.3s ease;
        left: 0;
    }
}


    </style>
</head>
<body>

    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="#">ETOC Dashboard</a>
            </div>
            <div class="toggle-sidebar" onclick="toggleSidebar()">
                <div class="burger"></div>
                <div class="burger"></div>
                <div class="burger"></div>
            </div>
            @include('dashboard.layouts.header')
            
        </div>
        @include('dashboard.layouts.sidebar')

    </nav>


    {{-- @include('dashboard.layouts.header')
    @include('dashboard.layouts.sidebar')
        <div class="toggle-btn" onclick="toggleSidebar()">
            <span class="navbar-toggler-icon"></span>
        </div> --}}
        <div class="content col-md-10 ms-sm-auto pt-5 col-lg-10 px-lg-3 bg-light">
            @yield('container')
        </div>
    </div>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var toggleSidebar = document.querySelector(".toggle-sidebar");
            sidebar.classList.toggle("active");
            toggleSidebar.classList.toggle("active");
        }
          // Tambahkan kode JavaScript berikut untuk menandai sidebar aktif
        document.addEventListener("DOMContentLoaded", function() {
            var currentUrl = window.location.href;
            var menuItems = document.querySelectorAll("#sidebar li a");

            menuItems.forEach(function(item) {
                if (item.href === currentUrl) {
                    item.parentElement.classList.add("active");
                }
            });
        });
    </script>
</body>

</html>
