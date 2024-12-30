<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard.Team</title>
    <link rel="stylesheet" href="<?= base_url('css/manager-dashboard.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <style>
        .hidden-column {
            display: none;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .filter-container select {
            padding: 5px;
            font-size: 14px;
        }

        #responseMessage {
            display: none;
            margin-top: 20px;
            text-align: left;
        }

        #responseMessage p {
            font-size: 18px;
            color: #333;
        }

        #proceedButton {
            padding: 10px 20px;
            font-size: 16px;
            color: green;
            background-color: white;
            border: 1px solid green;
            border-radius: 5px;
            cursor: pointer;
        }

        #proceedButton:hover {
            border: 1px solid green;
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="title">
            <span>Manager Dashboard</span>
        </div>
        <div class="header-icons">
            <div class="account">
                <h4><?= session('email'); ?></h4>
            </div>
        </div>
    </header>

    <div class="container">
        <nav>
            <div class="side_navbar">
                <a href="<?php echo site_url('managerHome'); ?>">Home</a>
                <a href="<?php echo site_url('managerProfile'); ?>">Manage Profile</a>
                <a href="<?php echo site_url('enlistProfessionals'); ?>">Enlist Professionals</a>
                <a href="<?php echo site_url('enlistServices'); ?>">Enlist Services</a>
                <a href="<?php echo site_url('managerEngagements'); ?>">View Team</a>
                <a class="active" href="<?php echo site_url('professionalReviews'); ?>">Past Professional Reviews</a>
                <a href="<?php echo site_url('providerReviews'); ?>">Past Provider Reviews</a>
                <a class="log-out-button" href="<?php echo site_url('logout'); ?>" onclick="return confirmLogout()">Logout</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Reviews</h2>
            <div class="promo_card">
                <h2>Profile: <?= session('name'); ?></h2>
                <br>
                <h3>Past reviews: Professionals</h3>

                <div class="filter-container">
                    <label for="dateFilter">Filter by Date: </label>
                    <select id="dateFilter">
                        <option value="all">All</option>
                        <option value="today">Today</option>
                        <option value="pastMonth">Past Month</option>
                        <option value="pastYear">Past Year</option>
                    </select>
                </div>

                <div id="responseMessage">
                    <p id="messageText"></p>
                    <button id="proceedButton" onclick="showTable()">Proceed</button>
                </div>

                <table id="reviewsTable">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th class="hidden-column">professional_rating_id</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Review</th>
                            <th>Classification</th>
                            <th>Reviewed on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reviews)) : ?>
                            <?php foreach ($reviews as $index => $review) : ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td class="hidden-column"><?= $review['professional_rating_id']; ?></td>
                                    <td><?= esc($review['professional_name']); ?></td>
                                    <td><?= esc($review['profession_name']); ?></td>
                                    <td><?= esc($review['review_text']); ?></td>
                                    <td><?= $review['review_sentiment'] ? 'Positive' : 'Negative'; ?></td>
                                    <td><?= esc($review['reviewed_on']); ?></td>
                                    <td>
                                        <button class="enlist-button" onclick="appealReview('<?= $review['professional_rating_id']; ?>')">Appeal</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">No reviews found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form id="appealForm" action="<?php echo base_url('professionalSelect') ?>" method="post" style="display:none;">
        <input type="hidden" name="professional_rating_id" id="reviewToAppeal" value="">
    </form>

    <script>
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }

        function appealReview(professional_rating_id) {
            document.getElementById('reviewToAppeal').value = professional_rating_id;

            const form = document.getElementById('appealForm');
            const formData = new FormData(form);

            fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('reviewsTable').style.display = 'none';
                        document.getElementById('messageText').textContent = data.message;
                        document.getElementById('responseMessage').style.display = 'block';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your appeal.');
                });
        }

        function showTable() {
            document.getElementById('responseMessage').style.display = 'none';
            document.getElementById('reviewsTable').style.display = '';
        }

        document.getElementById('dateFilter').addEventListener('change', function() {
            const filter = this.value;
            const rows = document.querySelectorAll('#reviewsTable tbody tr');
            const today = new Date();

            rows.forEach(row => {
                const reviewedOnText = row.cells[6].textContent.trim();
                const reviewedOnDate = new Date(reviewedOnText);
                let showRow = false;

                if (filter === 'all') {
                    showRow = true;
                } else if (filter === 'today') {
                    showRow = today.toDateString() === reviewedOnDate.toDateString();
                } else if (filter === 'pastMonth') {
                    const pastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
                    showRow = reviewedOnDate >= pastMonth && reviewedOnDate <= today;
                } else if (filter === 'pastYear') {
                    const pastYear = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
                    showRow = reviewedOnDate >= pastYear && reviewedOnDate <= today;
                }

                row.style.display = showRow ? '' : 'none';
            });
        });
    </script>
</body>

</html>