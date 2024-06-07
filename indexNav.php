<?php
include 'config.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (isset($_POST['searchQuery'])) {
    $query = $_POST['searchQuery'];
    header('Location: searchProductByName.php?query=' . urlencode($query));
    exit();
}
?>

<head>
    <style>
        .dropbtn {
            color: white;
            padding: 10px;
            font-size: 19px;
            border: none;
        }

        .category-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 13432;
        }

        .dropdown-content a {
            width: 200px;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .category-dropdown:hover .dropdown-content {
            display: block;
        }

        .category-dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        #customDropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
        }

        #searchInput:hover+#customDropdown,
        #searchInput:focus+#customDropdown {
            display: block;
        }

        .dropdown-header {
            font-size: 15px;
            color: #ff0000;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color:#797EF6">
        <div class="container-fluid d-flex ">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="index.php">
                    <span style="font-weight:400; letter-spacing:0px; font-size: 22px; color:white">TOTAL </span>
                    <span style="font-weight:800; letter-spacing:1px; font-size: 22px; color:#2D2D38;">KART</span>
                </a>
            </div>
            <div style="width:80%">
                <form class="d-flex justify-content-center" method="post">
                    <div class="dropdown" style="width:50%">
                        <input id="searchInput" class="form-control search-input bg-white " name="searchQuery"
                            autocomplete="off" placeholder="Search" aria-label="Search" data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktc2VhcmNoIiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGQ9Ik0xMS43NDIgMTAuMzQ0YTYuNSA2LjUgMCAxIDAtMS4zOTcgMS4zOThoLS4wMDFxLjA0NC4wNi4wOTguMTE1bDMuODUgMy44NWExIDEgMCAwIDAgMS40MTUtMS40MTRsLTMuODUtMy44NWExIDEgMCAwIDAtLjExNS0uMXpNMTIgNi41YTUuNSA1LjUgMCAxIDEtMTEgMCA1LjUgNS41IDAgMCAxIDExIDAiLz4KPC9zdmc+') no-repeat; background-position: 10px center; background-size: 16px 16px; padding-left: 35px;">
                        <ul id="searchResults" class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            style="width:150%; left:-25%;"></ul>
                        <div id="customDropdown" class="dropdown-menu" style="width:210%; display:none; left:-50%;">
                            <!-- Custom content here -->
                            <li>
                                <div class="container">
                                    <div class="row flex-nowrap justify-content-center ">
                                        <?php
                                        $sql = " SELECT category, subCategory FROM products WHERE subCategory IS NOT NULL AND subCategory != '' GROUP BY category, subCategory ORDER BY category, subCategory";

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            $currentCategory = null;
                                            while ($row = $result->fetch_assoc()) {
                                                if ($currentCategory != $row['category']) {
                                                    // Close the previous category div
                                                    if ($currentCategory !== null) {
                                                        echo "</ul></div>";
                                                    }
                                                    $currentCategory = $row['category'];
                                                    // Start a new category div
                                                    echo "<div class='col-2 text-center'>";
                                                    echo "<h3 class='dropdown-header text-center'>" . ucfirst($currentCategory) . "</h3>";
                                                    // echo "<ul class='list-unstyled text-center'>";
                                                }
                                                // Display the subcategory
                                                $categoryUrl = urlencode(htmlspecialchars($currentCategory));
                                                $subCategoryUrl = urlencode($row['subCategory']);
                                                echo "<a class='dropdown-item' href='category.php?category=" . $categoryUrl . "&subCategory=" . $subCategoryUrl . "'>" . ucfirst(htmlspecialchars($row['subCategory'])) . "</a>";
                                            }
                                            // Close the last category div
                                            echo "</ul></div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <ul class="navbar-nav m-4 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <?php
                    if (isset($_COOKIE['token']) && $_SESSION['user']['priority'] == 1) {
                        ?>
                        <li class="nav-item"><a class="nav-link text-white" href="addproduct.php">Add Product</a></li>
                        <?php
                    }
                    ?>
                    <?php
                    if (!isset($_COOKIE['token'])) {
                        ?>
                        <li class="nav-item"><a class="nav-link text-white" href="login.php"><img
                                    src="./img/person-circle.png" style="width:25px; height:20px;" class="px-1" /> LogIn</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item"><a class="nav-link text-white" href="logout.php"><img
                                    src="./img/person-circle.png" style="width:25px; height:20px;" class="px-1" />
                                Logout</a></li>
                        <?php
                    }
                    ?>
                </ul>
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
                        searchResults.innerHTML = '';
                        const limitedData = data.slice(0, 8); // Limit to the first 8 results
                        if (limitedData.length > 0) {
                            searchResults.classList.add('show'); // Show dropdown
                            limitedData.forEach(result => {
                                const option = document.createElement('li');
                                option.classList.add('dropdown-item');
                                const link = document.createElement('a');
                                link.href = `searchProducts.php?id=${result.id}`;
                                link.textContent = result.name;
                                link.classList.add('dropdown-item');
                                option.appendChild(link);
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
        document.addEventListener('DOMContentLoaded', function () {
            var searchInput = document.getElementById('searchInput');
            var customDropdown = document.getElementById('customDropdown');
            var searchResults = document.getElementById('searchResults');

            searchInput.addEventListener('input', function () {
                // Show custom dropdown if input is empty, otherwise show search results
                if (searchInput.value === '') {
                    customDropdown.style.display = 'block';
                    searchResults.style.display = 'none';
                } else {
                    customDropdown.style.display = 'none';
                    searchResults.style.display = 'block';
                }
            });

            searchInput.addEventListener('focus', function () {
                // Show the custom dropdown when the input is focused and empty
                if (searchInput.value === '') {
                    customDropdown.style.display = 'block';
                    searchResults.style.display = 'none';
                } else {
                    customDropdown.style.display = 'none';
                    searchResults.style.display = 'none';
                }
            });

            searchInput.addEventListener('blur', function () {
                // Optionally hide the custom dropdown on blur if needed
                setTimeout(function () {
                    customDropdown.style.display = 'none';
                    searchResults.style.display = 'none';
                }, 500);
            });
        });


    </script>


</body>