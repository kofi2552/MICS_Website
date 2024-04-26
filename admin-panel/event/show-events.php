<?php require "../layouts/header.php"; ?>
<?php require "../includes/config.php"; ?>

<?php

if (!isset($_SESSION['email'])) {
    header("location: ../admins/login-admins.php");
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$showAll = isset($_GET['show_all']) && $_GET['show_all'] == '1';

// Fetch events and paginate if necessary
$query = "SELECT * FROM events";

if (!empty($search)) {
    $query .= " WHERE event_title LIKE '%$search%' OR event_description LIKE '%$search%' ";
}

if (!$showAll) {
    $offset = ($page - 1) * $limit;
    $query .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";
}

$eventsQuery = $conn->query($query);
$events = $eventsQuery->fetchAll(PDO::FETCH_OBJ);

// Count total number of events
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM events");
$total = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($total / $limit);
?>

<style>
    /* Custom styles */
    .image-thumbnail {
        max-width: 100px;
        max-height: 100px;
    }

    .content-limit {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="container">
    <h1 class="mb-4">Event Management</h1>

    <form action="" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" value="<?php echo htmlentities($search); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>

        <div class="form-inline mt-2 mb-3">
            <div class="form-group mr-3">
                <label for="limit">Show:</label>
                <select class="form-control form-control-sm" name="limit" id="limit">
                    <option value="10" <?php echo $limit == 10 ? 'selected' : ''; ?>>10</option>
                    <option value="25" <?php echo $limit == 25 ? 'selected' : ''; ?>>25</option>
                    <option value="50" <?php echo $limit == 50 ? 'selected' : ''; ?>>50</option>
                </select>
            </div>
            <div class="form-group mr-3">
                <label for="show_all">Show all records:</label>
                <select class="form-control form-control-sm" name="show_all" id="show_all">
                    <option value="0" <?php echo !$showAll ? 'selected' : ''; ?>>Paginated</option>
                    <option value="1" <?php echo $showAll ? 'selected' : ''; ?>>All</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Apply</button>
        </div>

        <a href="create-events.php" class="btn btn-primary mb-2 text-center float-right">Add New Events</a>
        <a href="../<?php
            if($_SESSION['roles'] == "director") {
                echo "supa.php";
            } elseif($_SESSION['roles'] == "admin") {
                echo "index.php";
            } else {
                echo "unauthorized.php";
            }
        ?>" class="btn btn-primary mb-4 text-center float-left padding 2">Home</a>

    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Event Date</th>
                    <th>Event Title</th>
                    <th>Event Description</th>
                    <th>Event Color</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event) : ?>
                    <tr>
                        <td><?php echo $event->event_date; ?></td>
                        <td><?php echo $event->event_title; ?></td>
                        <td>
                            <div class="content-limit"><?php echo $event->event_description; ?></div>
                        </td>
                        <td><?php echo $event->event_color; ?></td>
                        <td>
                            <a href='edit-events.php?id=<?php echo $event->id; ?>' class="btn btn-primary btn-sm">Edit</a>
                            <a href='delete-events.php?id=<?php echo $event->id; ?>' class="btn btn-danger btn-sm" onclick='return confirm("Are you sure you want to delete this event?")'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!$showAll && $totalPages > 1) : ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>&search=<?php echo htmlentities($search); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
