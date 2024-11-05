<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX CRUD Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1>AJAX CRUD OPERATION</h1>

    <form method="get">
        <input type="text" id="search" name="keyword" placeholder="Search by Id" />
        <input type="submit" value="Search" id="searchButton" />
    </form>

    <form method="post" id="userform">
        <input type="hidden" id="userId" name="id">
        <input type="text" id="name" name="name" placeholder="Enter your Full Name">
        <input type="text" id="address" name="address" placeholder="Enter your Address">
        <button type="submit">Submit</button>
    </form>
    <div id="table"></div>

    <script>
        $(document).ready(function() {
            loadData();

            function loadData() {
                $.ajax({
                    url: 'save.php',
                    type: 'GET',
                    success: function(response) {
                        $('#table').html(response);
                    }
                })
            }

            $('#userform').on('submit', function(e) {
                e.preventDefault();
                var id = $('#userId').val();
                var name = $('#name').val();
                var address = $('#address').val();

                $.ajax({
                    url: 'save_user.php',
                    type: 'POST',
                    data: {
                        id: id,
                        name: name,
                        address: address
                    },
                    success: function(response) {
                        loadData();
                        $('#userform')[0].reset();
                        location.reload();
                    }
                })
            })

            $('#searchButton').on('click', function(e) {
                e.preventDefault(); 
                var searchQuery = $('#search').val();

                $.ajax({
                    url: 'save.php',
                    type: 'GET',
                    data: {
                        search: searchQuery 
                    },
                    success: function(response) {
                        $('#table').html(response); 
                    }
                });
            });


            $(document).on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'edit.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var user = JSON.parse(response);
                        $('#userId').val(user.id);
                        $('#name').val(user.name);
                        $('#address').val(user.address);
                    }
                });
            });

            $(document).on('click', '.delete', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        loadData();
                    }
                })
            })
        });
    </script>
</body>

</html>