<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>RecipeNest</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet" />
    <link href="styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <header class="p-3 " style="background-color: var(--header-color)">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo fw-bold fs-4 text-center" style="color: var(--bg-color);">
                <i class="bi bi-journal-album fs-1 --bg-color"> </i>
                RecipeNest
            </div>
            <nav class="d-flex gap-3">
                <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#myModal">
                    SignUp
                </button>
                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"> Sign Up </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="registrationForm" method="POST" action="controller2.php">
                                    <input type="hidden" name="page" value="LandingPage">
                                    <input type="hidden" name="command" value="SignUp">
                                    <div class="mb-3">
                                        <label for="name" class="form-label"> Username </label>
                                        <input type="text" class="form-control" name="username" placeholder="Enter a username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label"> Email </label>
                                        <input type="email" class="form-control" name="email" placeholder="name@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="terms">
                                        <label class="form-check-label" for="terms">Accept Terms and Conditions</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="submit-signup" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="button-signin" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#logInModal">
                    LogIn
                </button>


            </nav>

            <!-- The Log in Modal -->
            <div class="modal" id="logInModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title"> Log In </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action='controller2.php' method='POST'>
                                <input type='hidden' name='page' value='LandingPage'>
                                <input type='hidden' name='command' value='SignIn'>
                                <div class="mb-3">
                                    <label for='signin-username' class="form-label">Username</label>
                                    <input type='text' class="form-control" name='username' placeholder="Enter your username">
                                </div>
                                <div class='mb-3'>
                                    <label for='signin-password' class="form-label">Password</label>
                                    <input type='password' class="form-control" name='password' placeholder="Enter your password">
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" id="submit-login" class="btn btn-success" data-bs-dismiss="modal">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </header>

    <section class="hero text-white text-center py-5 mb-4" style="background-color: var(--text-color);">
        <p>
        <h2 style="color: var(--bg-color)">
            Bringing you into the creative and diverse world of cooking
        </h2>
        </p>
    </section>

    <section class="features py-5">
        <div class="container">
            <h2 class="text-center mb-4" style="color: var(--header-color);">Our Features</h2>
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-people fs-1 text-success"></i>
                            <h5 class="card-title mt-3" style="color: var(--header-color);">Community Engagement</h5>
                            <p class="card-text" style="color: var(--text-color);">
                                Connect with other food enthusiasts and share your favorite recipes.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-search fs-1 text-warning"></i>
                            <h5 class="card-title mt-3" style="color: var(--header-color);">Recipe Search</h5>
                            <p class="card-text" style="color: var(--text-color);">
                                Find recipes by ingredient, category, or popularity with ease.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-journal-plus fs-1 text-danger"></i>
                            <h5 class="card-title mt-3" style="color: var(--header-color);">Add Your Recipes</h5>
                            <p class="card-text" style="color: var(--text-color);">
                                Share your culinary creations and inspire others to try them.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer
        class="text-white text-center py-3"
        style="background-color: var(--text-color)">
        <p>&copy; 2024 RecipeNest. All rights reserved.</p>
    </footer>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">

    </script>

    <script>
        function show_signin_modal_window() {
            $('#logInModal').modal('show');

        }

        <?php

        if (!empty($display_modal_window) && $display_modal_window == 'none');
        else if (!empty($display_modal_window) && $display_modal_window == 'signin')
            echo 'show_signin_modal_window();';
        else;

        ?>
    </script>
</body>

</html>