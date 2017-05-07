<?php
$this->import("/admin/layout/header");
?>

    <style>
        body {
            background: url(<?php echo \Main\Helper\URL::absolute("/public/images/admin/bg_login.jpg")?>);
        }

        .jumbotron {
            text-align: center;
            width: 30rem;
            border-radius: 0.5rem;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            position: absolute;
            margin: 4rem auto;
            background-color: #fff;
            padding: 2rem;
            height: 430px;
        }

        .container .glyphicon-list-alt {
            font-size: 10rem;
            margin-top: 3rem;
            color: #f96145;
        }

        input {
            width: 100%;
            margin-bottom: 1.4rem;
            padding: 1rem;
            background-color: #ecf2f4;
            border-radius: 0.2rem;
            border: none;
        }

        h2 {
            margin-bottom: 3rem;
            font-weight: bold;
            color: #ababab;
        }

        .btn {
            border-radius: 0.2rem;
        }

        .btn .glyphicon {
            font-size: 3rem;
            color: #fff;
        }

        .full-width {
            background-color: #8eb5e2;
            width: 100%;
            -webkit-border-top-right-radius: 0;
            -webkit-border-bottom-right-radius: 0;
            -moz-border-radius-topright: 0;
            -moz-border-radius-bottomright: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .box {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-bottom: 3rem;
            margin-left: 3rem;
            margin-right: 3rem;
        }
    </style>
    <div class="jumbotron">
        <div class="container">
            <span class="glyphicon glyphicon-list-alt"></span>

            <h2>Login</h2>

            <div class="boxxx">
                <form data-toggle="validator" role="form" name="loginForm" id="loginForm">
                    <input type="text" placeholder="username" required name="username">
                    <input type="password" placeholder="password" required name="password">
                    <button class="btn btn-primary full-width"><span class="glyphicon glyphicon-ok"></span></button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#loginForm").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: '<?php echo \Main\Helper\URL::absolute('/admin/login'); ?>',
                    type: "POST",
                    crossDomain: true,
                    dataType: 'json',
                    data: $("#loginForm").serialize(),
                    success: function (data) {
                      if(data.error) {
                        alert(data.error.message);
                        return;
                      }
                      $(location).attr('href', '<?php echo \Main\Helper\URL::absolute("/admin")?>');
                    },
                    error: function (result) {
                        console.log(result);
                        swal({title: "Something went wrong!", text: "Server Error !", timer: 2000, type: "error"});
                    }
                });
            });
        });
    </script>
<?php
$this->import("/admin/layout/footer");
