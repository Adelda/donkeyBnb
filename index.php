<?php include('header.php'); ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<section class="section_index_sortie">
    <div class="row row-cols-1 row-cols-md-4 g-1">
        <?php
        include('link.php');

        $properties = !empty($searchResults) ? $searchResults :
        $pdo->query("SELECT p.property_id, p.image_url, p.price_per_night, p.city, p.availability_status, p.title, p.rating 
                     FROM properties p
                     ORDER BY p.property_id")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($properties as $property) : ?>
            <div style="padding: 20px;">
                <div class="col">
                    <div class="card">
                        <a href="property.php?property_id=<?php echo $property['property_id']; ?>">
                            <img src="<?php echo $property['image_url']; ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $property['title']; ?></h5>
                            <p class="card-text">Prix : <?php echo $property['price_per_night']; ?>$</p>
                            <p class="card-text">Ville : <?php echo $property['city']; ?></p>
                            <p class="card-text">Disponibilité : <?php echo $property['availability_status']; ?></p>
                            <?php
                            if (isset($property['rating'])) {
                                echo "<p class='card-text'>Note : {$property['rating']}</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<br>
<?php include('footer.php'); ?>