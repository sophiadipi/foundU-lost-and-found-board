<!--****************************************************************************
 * COMP 3541 Final Project
 * Sophia DiPietro (T00714296)
 * March 17, 2026
 * 
 * FoundU - View Listing
 * 
 * viewListing.php
 * 
 * This file acts as the view for the View Listing page of the FoundU 
 * application. 
 * 
 ****************************************************************************-->

<?php 
    $bodyClass = 'authPage';
    include('../view/header.php'); 
?>

<div class="fullListingDetails">
    <div class="imgDiv">
        <?php if (!empty($listing->getImagePath())): ?>
            <img src="<?php echo htmlspecialchars($listing->getImagePath()); ?>"
                 alt="<?php echo htmlspecialchars($listing->getItemName()); ?>">
        <?php else: ?>
            <img src="/FoundUApp/images/listingImages/listingPlaceholder.png"
                 alt="<?php echo htmlspecialchars($listing->getItemName()); ?>">
        <?php endif; ?>
    </div>
    
    <div class="details">
        <h2><?php echo htmlspecialchars($listing->getItemName()); ?></h2>
        <p id="listingDate">Listed <?php echo htmlspecialchars(DateFormat::timeAgoFull($listing->getDatePosted())); ?> 
            at <?php $university = UniversityDB::getUniversityByID($listing->getUniversityID());
                     echo htmlspecialchars($university->getFullName()); ?>
        </p>
        <p><b>Listing type:</b> <?php echo htmlspecialchars(ucfirst($listing->getListingType())); ?></p>
        <p><b>Date <?php echo htmlspecialchars(ucfirst($listing->getListingType())); ?>:</b>
            <?php echo htmlspecialchars(DateFormat::formatDateTime($listing->getDateLostOrFound())); ?>
        </p>
        <p><b>Item Category:</b> 
            <?php $category = ItemCategoryDB::getCategoryByID($listing->getCategoryID());
                  echo htmlspecialchars($category->getCategoryName()); ?>
        </p>
    </div>
    
    <div class="description">
        <p><b>Description:</b></p>
        <?php echo htmlspecialchars($listing->getItemDescription()); ?></p>
    </div>
    
    <div class="submitDiv">
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="submitClaim">
            <input type="hidden" name="listingID" 
                value="<?php echo htmlspecialchars($listing->getID()); ?>">
        
            <?php if ($listing->getListingType() == 'lost'): ?>
            <p>Think you found this item?</p>
            <input type="submit" value="Submit a Found Form">
        
            <?php else: ?>
            <p>Think this item belongs to you?</p>
            <input type="submit" value="Submit a Claim Request">
        
            <?php endif; ?>
        </form>
    </div>
</div>


    
    
    

