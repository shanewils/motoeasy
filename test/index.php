<?php 

$databaseConnection = mysqli_connect('localhost', 'User', 'Password', 'test');

if(!$databaseConnection){
    echo 'Connection error: ' . mysqli_connect_error();
}

$sql = 'SELECT DISTINCT category, title, MAX(date) as date
FROM test 
GROUP BY category 
ORDER BY MAX(date) DESC, category LIMIT 10';

$result = mysqli_query($databaseConnection, $sql);

$articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($databaseConnection);

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php') ?>

    <h4 class="center grey-text"> Results</h4>
    <div class="container">
        <div class="row">
            <?php foreach($articles as $article): ?>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($article['category']); ?></h5>
                            <h6><?php echo htmlspecialchars($article['title']); ?></h6>
                            <h6><?php echo htmlspecialchars($article['date']); ?></h6> 
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include('templates/footer.php') ?>

</html>
