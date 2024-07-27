<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- Existing head content -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100&family=Oswald:wght@200..700&display=swap" rel="stylesheet">


    <style>
        /* Styles for Sidebar */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #fff;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar .nav-item {
            margin-bottom: 1px;
        }

        .sidebar .nav-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar .nav-link .collapse {
            display: none;
        }

        .sidebar .nav-link.active .collapse {
            display: block;
        }

        .sidebar .nav-link .collapse a {
            padding-left: 20px;
        }

        .content {
            margin-left: 250px;
            padding: 15px;
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                z-index: 1000; /* Ensure it appears above other content */
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }
        }

        /* .table {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            transition: box-shadow 0.3s ease-in-out;
        }

        .table:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        } */
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <button class="btn btn-primary ml-auto d-lg-none" id="sidebarToggle">☰</button>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul id="menu-list" class="nav flex-column"></ul>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
        @yield('content')

        <!-- Scripts de jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

        @stack('scripts')
    </div>

    <script>
        $(document).ready(function() {
            $.getJSON('/menu/menu.json', function(data) {
                var menuList = $('#menu-list');
                $.each(data, function(index, item) {
                    if (item.children && item.children.length > 0) {
                        var collapsibleMenu = '<li class="nav-item">' +
                            '<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse' + index + '">' +
                            item.title +
                            '<span class="navbar-toggler-icon"></span>' +
                            '</a>' +
                            '<div id="collapse' + index + '" class="collapse">';
                        
                        $.each(item.children, function(childIndex, childItem) {
                            collapsibleMenu += '<a class="nav-link" href="' + childItem.url + '">' + childItem.title + '</a>';
                        });

                        collapsibleMenu += '</div></li>';
                        menuList.append(collapsibleMenu);
                    } else {
                        menuList.append('<li class="nav-item"><a class="nav-link" href="' + item.url + '">' + item.title + '</a></li>');
                    }
                });
            });

            // Toggle Sidebar for small screens
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('show');
                $('#content').toggleClass('shifted');
            });
        });
    </script>
</body>
</html>
