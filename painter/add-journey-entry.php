<?php include('partials/painterClient.php'); ?>

<?php
    // Get the painting ID from the URL
    $painting_id = $_GET['id'];
?>

<!--painting journey section-->
<section class="painting-journey">
    <div class="banner"></div>
    <h4 class="sub-title">Painting's Journey</h4>
    <br>

    <!-- Form to add journey entry -->
    <form action="<?php echo HOMEURL ?>painter/submit-entry.php" method="POST" enctype="multipart/form-data" class="painting-journey-content">
        <input type="hidden" name="painting_id" value="<?php echo $painting_id; ?>">

        <!-- Add journey entry fields -->
        <div class="add-painting-journey-box">
            <div class="add-painting-journey-image">
                <input type="file" name="journey_image" required>
            </div>
            <div class="add-painting-journey-box-divider"></div>
            <div class="add-painting-journey-info">
                <div class="add-painting-journey-info-title">
                    Title:
                    <br>
                    <input type="text" name="title" placeholder="Enter title..." required>
                </div>
                <div class="add-painting-journey-info-comment">
                    <textarea name="comment" rows="16" placeholder="Add comments..." required></textarea>
                </div>
            </div>
        </div>

        <!-- Submit and Back buttons -->
        <div class="add-painting-journey-add text-center">
            <button type="submit" class="btn">Submit Entry</button>
            <a href="<?php echo HOMEURL ?>painter/paintingJourneyPage.php?id=<?php echo $painting_id ?>" class="btn">Back</a>
        </div>
    </form>
    <br><br>
    <div class="clearfix"></div>
</section>
<!--painting journey section-->

<?php include('partials/painterFooter.php'); ?>
