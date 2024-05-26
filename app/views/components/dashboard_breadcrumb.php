<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php
            $uri = $_SERVER['REQUEST_URI'];
            $uriSegments = explode('/', $uri);

            foreach ($uriSegments as $key => $segment) {
                if (!empty($segment)) {
                    if ($key == count($uriSegments) - 1 && is_numeric($segment)) {
                        continue;
                    }

                    $capitalizedSegment = ucfirst($segment);
                    if ($key == count($uriSegments) - 2) { // Check the second last segment
                        echo "<li class='breadcrumb-item active'>$capitalizedSegment</li>";
                    } else {
                        echo "<li class='breadcrumb-item'><a href='/$segment'>$capitalizedSegment</a></li>";
                    }
                }
            }
            ?>
        </ol>
    </nav>
</div>