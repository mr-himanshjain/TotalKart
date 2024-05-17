<?php
include 'config.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$currentfile = '/totalkart/login.php';
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Totalkart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <?php
                    if (isset($_COOKIE['token']) && $_SESSION['user']['priority'] == 1) {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="addproduct.php">Add Product</a></li>
                        <?php
                    }
                    ?>
                    <?php
                    if (!isset($_COOKIE['token'])) {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">LogIn</a></li>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php
                    }
                    ?>
                </ul>
                <form class="d-flex">
                    <div class="dropdown">
                        <input class="form-control me-2" name="searchQuery" autocomplete="off" placeholder="Search"
                            aria-label="Search" data-bs-toggle="dropdown" aria-expanded="false">
                        <ul id="searchResults" class="dropdown-menu" aria-labelledby="dropdownMenuButton"></ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <script>
        const searchQuery = document.querySelector('input[name="searchQuery"]');
        const searchResults = document.getElementById('searchResults');

        searchQuery.addEventListener('input', function () {
            const query = this.value.trim();
            if (query !== '') {
                fetch(`search.php?searchQuery=${query}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Data received:", data);
                        searchResults.innerHTML = '';
                        const limitedData = data.slice(0, 8); // Limit to the first 8 results
                        if (limitedData.length > 0) {
                            searchResults.classList.add('show'); // Show dropdown
                            limitedData.forEach(result => {
                                const option = document.createElement('li');
                                option.classList.add('dropdown-item');
                                option.textContent = result.name; // Adjust based on your database structure
                                searchResults.appendChild(option);
                            });
                        } else {
                            searchResults.classList.remove('show'); // Hide dropdown if no results
                        }
                    })
                    .catch(error => console.error('Error:', error)); // Log any fetch errors
            } else {
                searchResults.classList.remove('show'); // Hide dropdown if query is empty
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const isClickInside = searchQuery.contains(event.target);
            if (!isClickInside) {
                searchResults.classList.remove('show');
            }
        });
    </script>
</body>